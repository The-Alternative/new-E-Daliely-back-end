<?php
namespace App\Service\Products;

// use App\Models\brand;
// use App\Models\category;
use App\Traits\GeneralTrait;
use App\Models\Custom_Fildes\Custom_Field;
use App\Http\Requests\ProductRequest;
use App\Models\Products\Product;
// use App\Store;

// use App\product_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;

class ProductService
{
    use GeneralTrait;
    private $productModel;
// private $custom;
// private $pimage;
// private $category;
    /**
     * ProductService constructor.
     */
    public function __construct(Product $product/*,category $category,custom_field  $custom,product_image $pimage*/)
    {
        $this->productModel=$product;
        //$this->product=$product;
        // $this->custom=$custom;
        // $this->category=$category;
        // $this->pimage=$pimage;
    }
    
    
    public function get($id=null)
    {

        $response= $id?Product::find($id):Product::all();
          return $this -> returnData('Product',$response,'done')
          ->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', '*');
    }
    
    
    public function create(ProductRequest $request)
    {

        if ($request->is_active)
        {
            $is_active=true;
        }
        else
        {
            $is_active=false;
        }
        if ($request->is_appear){
            $is_appear=true;
        }else{
            $is_appear=false;
        }
        $validated = $request->ProductRequest::rules()->with(ProductRequest::message());
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
    
    
    public function update(Request $request)
    {
        $product=Product::find($request->$id);
        $product->title= $request->title;
        $product->barcode= $request->barcode;
        $product->is_active= $is_active;
        $product->meta= $brand_id->brand_id;
        $product->is_appear= $is_appear;
        $product->meta= $request->meta;
        $product->description= $request->description;
        $product->meta= $request->meta;
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


    public function destroy($id)
    {
       $product=Product::find($request->$id);
       $product->is_active=false;    
           
    }


    public function search($name)
    {
        $result= Product::where("name","like","%".$name."%")->get();
        if ($result==null)
        {
            return $this->returnError('400', 'not found this Product');
        }

            return $this->returnData('Product', $result,'done');

    }

}
