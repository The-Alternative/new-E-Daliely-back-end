<?php
namespace App\Service\Categories;


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
    /**
     * ProductService constructor.
     */

    public function __construct(Category $category)
    {
        $this->CategoryModel=$category;
    }

    /****Get All Active Products Or By ID  ****/

    public function get()
    {   
        $category= Category::all();
            return $this->returnData('Category',$category,'done'); 
    }
    public function getById($id )
    {
       // $response=DB::table('products')->where('id','=',$id)->where('is_active','=',1)->get();

        $category= Category::find($id);
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

        /****  Create Products   ****/

    public function create(CategoryRequest $request)
    {
        $request->is_active?$is_active=true:$is_active=false;
        $validated = $request->validated();
        $category= new Category;
        $category->name= $request->name;
        $category->slug= $request->slug;
        $category->parent_id=$request->parent_id;
        $category->is_active= $is_active;
        $category->image=$request->image;
        $result=$category->save();
        // if ($result)
        //     {
                return $this->returnData('Category', $category,'done');
            // }
            // else
            //     {
            //         return $this->returnError('400', 'saving failed');

            //     }
    }

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
