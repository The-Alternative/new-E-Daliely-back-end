<?php
namespace App\Service\Categories;


use App\Models\Categories\CategoryTranslation;
use App\Traits\GeneralTrait;
use App\Models\Custom_Fildes\Custom_Field;
use App\Http\Requests\CategoryRequest;
use App\Models\Products\Product;
use App\Models\Categories\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use App\Exceptions\GeneralHandler;
use Exception;

class CategoryService
{
    use GeneralTrait;
    private $CategoryService;
    private $categoryModel;
    private $categoryTranslateModel;
    /**
     * ProductService constructor.
     */

    public function __construct(Category $category,CategoryTranslation $categoryTranslation)
    {
        $this->categoryModel=$category;
        $this->categoryTranslateModel=$categoryTranslation;
    }

    /****Get All Active Products Or By ID  ****/

    public function get()
    {
//        $category= Category::with('language','CategoryTranslation')->where('lang_id','1')->get();
//            return $this->returnData('Category',$category,'done');
    }
    public function getById($id )
    {
       // $response=DB::table('products')->where('id','=',$id)->where('is_active','=',1)->get();

//        $category= Category::with('CategoryTranslation')->joinWhere('')->find($id);
//        $category = Category::where('id', $id)
//            ->Join('Categories', 'CategoryTranslation.locale', '=', 'en')->get();
        $category = Category::where('id', $id)
            ->leftJoin('Categories', 'categoryTranslation.id', '=', 'Categories.id')
            ->select('Categories.id','categoryTranslation.name')->where('categoryTranslation.locale','en')->get();


        return $this->returnData('Category',$category,'done');
    }
        /****ــــــThis Functions For Trashed Productsــــــ  ****/

    /****Get All Trashed Products Or By ID  ****/

    public function getTrashed()
    {
        $category= Category::all()->where('is_active',0);
          return $this -> returnData('Category',$category,'done');
    }
    /****Restore Products Fore Active status  ****/

    public function restoreTrashed( $id)
    {
        $category=$this->Category::find($id);
            $category->is_active=true;
            $category->save();
            return $this->returnData('Category', $category,'This Product Is trashed Now');
    }
        /****   Product's Soft Delete   ****/

    public function trash( $id)
    {
        $category=$this->Category::find($id);
            $category->is_active=false;
            $category->save();
            return $this->returnData('Category', $category,'This Product Is trashed Now');
    }

    /*ـــــــــــــــــــــــــــــــــــــــــــــــ*/

    /****  Create Products   ***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

//    public function create(CategoryRequest $request)
        public function create(Request $request)
        {
            try
            {
                $validated = $request->validated();
                $request->is_active?$is_active=true:$is_active=false;
                $request->is_appear?$is_appear=true:$is_appear=false;
                //transformation to collection
                $allProducts = collect($request->product);
                $filter = $allProducts->filter(
                    function($value , $key)
                    {
                        return $value['abbr'] == get_default_languages();
                    }
                );
                //transformation to array
                $default_product = array_values($filter->all()) [0];
                //select folder to save the image
                // $fileBath = "" ;
                //     if($request->has('image'))
                //     {
                //         $fileBath=uploadImage('images/products',$request->image);
                //     }
                DB::beginTransaction();
                // //create the default language's product
                $default_product_id=Product::insertGetId([
                    'trans_lang' => $default_product ['abbr'],
                    'trans_of' =>  0 ,
                    'title' => $default_product['title'],
                    'slug' => $default_product['slug'],
                    'meta' => $default_product['meta'],
                    'short_des' => $default_product['short_des'],
                    'description' => $default_product['description'],
                    'brand_id' => $request->brand_id,
                    'barcode' => $request['barcode'],
                    'is_active' => $request['is_active'],
                    'is_appear'=> $request['is_appear'],
                    'image' => $request['image']
//                        'image'=>$fileBath
                ]);
                $product = $allProducts->filter(
                    function($value , $key)
                    {
                        return $value['abbr'] != get_default_languages();
                    }
                );
                //check the product and request
                if(isset($product) && $product->count())
                {
                    $products_arr=[];
                    //insert other traslations for products
                    foreach ($product as $product)
                    {
                        $products_arr[]=[
                            'trans_lang' => $product['abbr'],
                            'trans_of' => $default_product_id,
                            'title' => $product['title'],
                            'slug' => $product['slug'],
                            'meta' => $product['meta'],
                            'short_des' => $product['short_des'],
                            'description' => $product['description'],
                            'brand_id' => $request->brand_id,
                            'barcode' => $request['barcode'],
                            'is_active' => $request['is_active'],
                            'is_appear'=> $request['is_appear'],
                            'image' => $request['image']
                        ];
                    }
                    Product::insert($products_arr);
                }
                DB::commit();
                return $this->returnData('product', $allProducts,'done');
            }
            catch(\Exception $ex)
            {
                DB::rollback();
//                    dd($ex.getCode());
                return $this->returnError('400', $ex.getMessage());
            }
        }
//    {
//        $request->is_active?$is_active=true:$is_active=false;
//        $validated = $request->validated();
//        $category= new Category;
//        $category->name= $request->name;
//        $category->slug= $request->slug;
//        $category->parent_id=$request->parent_id;
//        $category->is_active= $is_active;
//        $category->image=$request->image;
//        $result=$category->save();
//        // if ($result)
//        //     {
//                return $this->returnData('Category', $category,'done');
//            // }
//            // else
//            //     {
//            //         return $this->returnError('400', 'saving failed');
//
//            //     }
//    }

            /****  Update Product   ****/

    public function update(CategoryRequest $request)
    {
        $category=$this->Category::find($request->id);
        $validated = $request->validated();
        $category->name= $request->name;
        $category->slug= $request->slug;
        // $category->is_active= $is_active;
        $category->parent_id=$request->parent_id;
        $category->image=$request->image;
        $result=$category->save();
        if ($result)
            {
               return $this->returnData('Category', $category,'done');
            }
            else
                {
                    return $this->returnError('400', 'updating failed');
                }
    }
                /****  ٍsearch for Product   ****/

    public function search($name)
    {
        $category = DB::table('categories')
                ->where("name","like","%".$name."%")
                ->get();
        if (!$category)
        {
            return $this->returnError('400', 'not found this Product');

        }
          else
            {
                return $this->returnData('Category', $category,'done');
            }
    }
                /****  Delete Product   ****/

    public function delete($id)
    {
        $category=$this->Category::find($id);
        if ($procategoryduct->$is_active=0)
            {
                $category=Category::destroy($id);
                 return $this->returnData('Category', $category,'This Product Is deleted Now');
            }
    }


}
