<?php
namespace App\Service\Products;

use App\Traits\GeneralTrait;
use App\Models\Custom_Fildes\Custom_Field;
use App\Http\Requests\ProductRequest;
use App\Models\Products\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use App\Exceptions\GeneralHandler;
use Exception;
use LaravelLocalization;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class ProductService
{
    use GeneralTrait;
    private $productModel;

    /**
     * ProductService constructor.
     * @param Product $product
     */

    public function __construct(Product $product)
    {
        $this->productModel=$product;
    }
    /*__________________________________________________________________*/
    /****Get All Active Products  ****/
    public function get()
    {
        try
        {
        $default_lang=get_default_languages();
        $product= Product::where('trans_lang', $default_lang)->selection();
        return $this->returnData('Product',$product,'done');
    }
    catch(\Exception $ex)
        {
            return $this->returnError('400', 'nothing to get');
        }

    }
        /*__________________________________________________________________*/
    /****Get Active Product By ID  ***
     * @param $id
     * @return JsonResponse
     */
    public function getById(/*Request $request,*/ $id)
    {
       // $response=DB::table('products')->where('id','=',$id)->where('is_active','=',1)->get();

       $product= Product::selectActiveValue()->find($id);
        return $this->returnData('Product',$product,'done');
    }
        /*__________________________________________________________________*/
        /****ــــــThis Functions For Trashed Productsــــــ  ****/
    /****Get All Trashed Products Or By ID  ****/
    public function getTrashed()
    {
        $product= Product::selectNotActiveValue();
          return $this -> returnData('Product',$product,'done');
    }

        /*__________________________________________________________________*/
    /****Restore Products Fore Active status  ***
     * @param $id
     * @return JsonResponse
     */
    public function restoreTrashed( $id)
    {
        $product=Product::find($id);
            $product->is_active=true;
            $product->save();
            return $this->returnData('Product', $product,'This Product Is trashed Now');
    }

        /*__________________________________________________________________*/
    /****   Product's Soft Delete   ***
     * @param $id
     * @return JsonResponse
     */
    public function trash( $id)
    {
        $product= Product::find($id);
            $product->is_active=false;
            $product->save();
            return $this->returnData('Product', $product,'This Product Is trashed Now');
    }

        /*__________________________________________________________________*/

    /****  Create Products   ***
     * @param ProductRequest $request
     * @return JsonResponse
     */

    public function create(ProductRequest $request)
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

    /*__________________________________________________________________*/
    /****  Update Product   ***
     * @param ProductRequest $request
     * @param $pro_id
     * @return JsonResponse
     */
    public function update(ProductRequest $request,$pro_id)
    {
        // return $request;
        $validated = $request->validated();
        try{

            $product= Product::with('Products')->selection()->find($pro_id);
            if(!$product)
                return $this->returnError('400', 'not found this Product');
            $default_product = array_values( $request->product ) [0];
            if (!($request->has('product.0.is_active')))
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

            $new_pro=Product::where('id',$pro_id)->update([
                'title'=>$default_product['title'],
                'is_active'=>$default_product['is_active'],
                // 'image'=>$fileBath,
                'image' => $request['image'],
                'slug' => $default_product['slug'],
                'meta' => $default_product['meta'],
                'short_des' => $default_product['short_des'],
                'description' => $default_product['description'],
                'brand_id' => $request->brand_id,
                'barcode' => $request['barcode'],
                'is_appear'=> $request['is_appear']
            ]);
            return $this->returnData('product', $default_product,'done');

            // $product->update($request->except(['__token']));
            // return $this->returnData('product', $product,'done');
        }
        catch(\Exception $ex){
            return $ex;
            return $this->returnError('400', 'saving failed');
        }
    }

        /*__________________________________________________________________*/
    public function search($title)
    {

        $product= Product::searchTitle();
        if (!$product)
        {
            return $this->returnError('400', 'not found this Product');
        }
          else
            {
                return $this->returnData('products', $product,'done');
            }
    }

            /*__________________________________________________________________*/
    /****  Delete Product   ***
     * @param $id
     * @return JsonResponse
     */
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
