<?php
namespace App\Service\Categories;

use App\Models\Categories\CategoryTranslation;
use App\Models\Custom_Fildes\Custom_Field;
use App\Models\Products\Product;
use App\Models\Categories\Category;
use App\Http\Requests\CategoryRequest;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use App\Exceptions\GeneralHandler;
use Exception;
use LaravelLocalization;

class CategoryService
{
    use GeneralTrait;
    private $CategoryService;
    private $categoryModel;


    /**
     * Category Service constructor.
     * @param Category $category
     * @param CategoryTranslation $categoryTranslation
     */

    public function __construct(Category $category)
    {
        $this->categoryModel=$category;
    }

    /****Get All Active category Or By ID  ****/

    public function get()
    {
        $category = Category::withTrans()->get();
        return $response= $this->returnData('Category',$category,'done');
    }
    public function getById($id )
    {
        $category = Category::withTrans()->find($id);
        return $response= $this->returnData('Category',$category,'done');
    }
        /****ــــــThis Functions For Trashed category  ****/
    /****Get All Trashed Products Or By ID  ****/

    public function getTrashed()
    {
        $category = Category::withTrans()->where('is_active',0)->get();
          return $this -> returnData('Category',$category,'done');
    }
    /****Restore category Fore Active status  ****/

    public function restoreTrashed( $id)
    {
        $category=Category::find($id);
            $category->is_active=true;
            $category->save();
            return $this->returnData('Category', $category,'This Category Is trashed Now');
    }
        /****   category's Soft Delete   ****/

    public function trash( $id)
    {
        $category=Category::find($id);
            $category->is_active=false;
            $category->save();
            return $this->returnData('Category', $category,'This Category Is trashed Now');
    }

    /*ــــــــــــــــــــــــ  ـــــــــــــــــــــــ*/

    /****  Create category   ***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    /*___________________________________________________________________________*/
        public function create(CategoryRequest $request)
        {
            try
            {
                $validated = $request->validated();
                $request->is_active?$is_active=true:$is_active=false;
                $request->is_appear?$is_appear=true:$is_appear=false;
                //transformation to collection
                $allcategories = collect($request->category)->all();


                ///select folder to save the image
                // $fileBath = "" ;
                //     if($request->has('image'))
                //     {
                //         $fileBath=uploadImage('images/products',$request->image);
                //     }
                DB::beginTransaction();
                // //create the default language's product
                $unTransCategory_id=Category::insertGetId([
                    'image' =>$request['image'],
                    'lang_id' =>$request['lang_id'],
                    'is_active' =>$request['is_active'],
                    'parent_id'=>$request['parent_id']
                ]);
                //check the category and request
                if(isset($allcategories) && count($allcategories))
                {
                    //insert other traslations for products
                    foreach ($allcategories as $allcategorie)
                    {
                        $transCategory_arr[]=[
                            'name' => $allcategorie ['name'],
                            'slug' => $allcategorie['slug'],
                            'locale' => $allcategorie['locale'],
                            'category_id' => $unTransCategory_id,
                            'language_id' => $allcategorie['language_id']
                        ];
                    }
                    $transCategory_arr;

                  CategoryTranslation::insert($transCategory_arr);
                }
                DB::commit();
                return $this->returnData('category', [$unTransCategory_id,$transCategory_arr],'done');
            }
            catch(\Exception $ex)
            {
                DB::rollback();
                return $this->returnError('category','faild');
            }
        }

    /*___________________________________________________________________________*/

    /****  Update category   ****/

    public function update(CategoryRequest $request,$id)
    {
        $validated = $request->validated();
        try{
            $category= Category::find($id);
            if(!$category)
                return $this->returnError('400', 'not found this Category');
           $allcategories = collect($request->category)->all();
            if (!($request->has('category.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);
            //save image
            // if($request->has('image')) {
            //     $filePath = uploadImage('products', $request->photo);
            //     Product::where('id', $pro_id)
            //         ->update([
            //             'image' => $filePath,
            //         ]);
            // }

           $ncategory=Category::where('id',$id)
               ->update([
                'image' => $request['image'],
                'lang_id' => $request['lang_id'],
                'is_active' => $request['is_active'],
                'parent_id'=>$request['parent_id']
            ]);
            $ss=CategoryTranslation::where('category_id',$id);
            $collection1 = collect($allcategories);
            $allcategorieslength=$collection1->count();
            $collection2 = collect($ss);

              $db_category= array_values(CategoryTranslation::where('category_id',$id)
                  ->get()
                  ->all());
              $dbdcategory = array_values($db_category);
              $request_category = array_values($request->category);
                foreach($dbdcategory as $dbdcategor){
                    foreach($request_category as $request_categor){
                        $values= CategoryTranslation::where('category_id',$id)
                            ->where('locale',$request_categor['locale'])
                            ->update([
                            'name'=>$request_categor['name'],
                            'slug'=>$request_categor['slug'],
                            'locale'=>$request_categor['locale'],
                            'language_id'=>$request_categor['language_id'],
                            'category_id'=>$id
                        ]);
                    }
                }
            return $this->returnData('Category', $dbdcategory,'done');
            DB::commit();
        }
        catch(\Exception $ex){
            return $ex;
            return $this->returnError('400', 'saving failed');
        }
    }
    /*___________________________________________________________________________*/
                /****  ٍsearch for Product   ****/

    public function search($name)
    {
        $category = DB::table('categories')
                ->where("name","like","%".$name."%")
                ->get();
        if (!$category)
        {
            return $this->returnError('400', 'not found this Category');

        }
          else
            {
                return $this->returnData('Category', $category,'done');
            }
    }
    /*___________________________________________________________________________*/

    /****  Delete Product   ****/

    public function delete($id)
    {
        $category=$this->Category::find($id);
        if ($category->is_active=0)
            {
                $category=Category::destroy($id);
                 return $this->returnData('Category', $category,'This Category Is deleted Now');
            }
    }


}
