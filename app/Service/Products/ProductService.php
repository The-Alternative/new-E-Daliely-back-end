<?php
namespace App\Service\Products;


use App\Traits\GeneralTrait;
use App\Models\Custom_Fildes\Custom_Field;
use App\Http\Requests\ProductRequest;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use App\Exceptions\GeneralHandler;
use Exception;

class ProductService
{
    use GeneralTrait;
    private $productModel;
    /**
     * ProductService constructor.
     */

    public function __construct(Product $product)
    {
        $this->productModel=$product;
    }

    /****Get All Active Products Or By ID  ****/

    public function get()
    {   
        $response= Product::all()->where('is_active',true);
            return $this->returnData('Product',$response,'done'); 
    //     try{
    //     $response= ($id?Product::find($id)->firstOrFail()->where('is_active',true):Product::all()->where('is_active',true));
    //         return $this->returnData('Product',$response,'done');
    // }
    // catch (\Exception $exception){
    //     throw new QueryException();
    // }
    // catch (\Exception $exception){
    //     throw new BadMethodCallException();
    // }

    }
    public function getById($id )
    {
        $response= Product::find($id)->where('is_active', '=', 1)->firstOrFail();
        return $this->returnData('Product',$response,'done'); 
    }


        /****ــــــThis Functions For Trashed Productsــــــ  ****/
        
    /****Get All Trashed Products Or By ID  ****/

    public function showTrashed($id=null)
    {
        $product=($id?Product::find($id):Product::all())->where('is_active',false);
          return $this -> returnData('Product',$product,'done');
    }
    /****Restore Products Fore Active status  ****/

    public function restoreTrashed( $id)
    {
        $product=Product::find($id);
            $product->is_active=true; 
            $product->save(); 
            return $this->returnData('Product', $product,'This Product Is trashed Now');
    }
        /****   Product's Soft Delete   ****/

    public function trash( $id)
    {
        $product= Product::find($id);
            $product->is_active=false; 
            $product->save(); 
            return $this->returnData('Product', $product,'This Product Is trashed Now');
    }

    /*ـــــــــــــــــــــــــــــــــــــــــــــــ*/

        /****  Create Products   ****/

    public function create(ProductRequest $request)
    {
        $request->is_active?$is_active=true:$is_active=false;
        $request->is_appear?$is_appear=true:$is_appear=false;
        $validated = $request->validated();
        $product= new Product;
        $product->title= $request->title;
        $product->slug= $request->slug;
        $product->barcode= $request->barcode;
        $product->is_active= $is_active;
        $product->is_appear= $is_appear;
        $product->brand_id= $request->brand_id;
        $product->meta= $request->meta;
        $product->short_des= $request->short_des;
        $product->description= $request->description;
        $result=$product->save();
        if ($result)
            {
                return $this->returnData('product', $product,'done');
            }
            else
                {
                    return $this->returnError('400', 'saving failed');
                }
    }

            /****  Update Product   ****/

    public function update(Request $request,$id)
    {
        $product=Product::find($request->id);
        $product->title= $request->title;
        $product->slug= $request->slug;
        $product->barcode= $request->barcode;
        $product->brand_id= $request->brand_id;
        $product->meta= $request->meta;
        $product->short_des= $request->short_des;
        $product->description= $request->description;
        $result=$product->save();
        if ($result)
            {
               return $this->returnData('Product', $product,'done');
            }
            else
                {
                    return $this->returnError('400', 'updating failed');
                }
    }
                /****  ٍsearch for Product   ****/

    public function search($title)
    {
        $product = DB::table('products')
                ->where("title","like","%".$title."%")
                ->get();
        if (!$product)
        {
            return $this->returnError('400', 'not found this Product');

        }
          else 
            {
                return $this->returnData('products', $product,'done');

            }
    }
                /****  Delete Product   ****/

    public function delete( $id)
    {
        $product=Product::find($id);
        if ($product->$is_active=0)
            {
                $product=Product::destroy($id);
                 return $this->returnData('Product', $product,'This Product Is deleted Now');
            }
    }


}
