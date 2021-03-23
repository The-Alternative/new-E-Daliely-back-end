<?php
namespace App\Service\Products;

use App\Models\Products\ProductTranslation;
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
//        try
//        {
          $products = Product::withTrans()->get();
            return $this->returnData('Product',$products,'done');
//        }
//            catch(\Exception $ex)
//        {
//            return $this->returnError('400', 'nothing to get');
//        }

    }
        /*__________________________________________________________________*/
    /****Get Active Product By ID  ***
     * @param $id
     * @return JsonResponse
     */
    public function getById(/*Request $request,*/ $id)
    {
       // $response=DB::table('products')->where('id','=',$id)->where('is_active','=',1)->get();

        $product = Product::withTrans()->find($id);
        return $this->returnData('Product',$product,'done');
    }
        /*__________________________________________________________________*/
        /****ــــــThis Functions For Trashed Productsــــــ  ****/
    /****Get All Trashed Products Or By ID  ****/
    public function getTrashed()
    {
        $product= Product::withTrans()->selectNotActiveValue();
          return $this -> returnData('Product',$product,'done');
    }

        /*__________________________________________________________________*/
    /****Restore Products Fore Active status  ***
     * @param $id
     * @return JsonResponse
     */
    public function restoreTrashed( $id)
    {
        $product=Product::withTrans()->find($id);
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
        $product= Product::withTrans()->find($id);
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
//                validated = $request->validated();
                $request->is_active?$is_active=true:$is_active=false;
                $request->is_appear?$is_appear=true:$is_appear=false;
                //transformation to collection
                $allproducts = collect($request->product)->all();


                ///select folder to save the image
                // $fileBath = "" ;
                //     if($request->has('image'))
                //     {
                //         $fileBath=uploadImage('images/products',$request->image);
                //     }
                DB::beginTransaction();
                // //create the default language's product
                $unTransProduct_id=Product::insertGetId([
                    'slug' =>$request['slug'],
                    'image' =>$request['image'],
                    'barcode' =>$request['barcode'],
                    'is_active' =>$request['is_active'],
                    'is_appear' =>$request['is_appear'],
                    'custom_feild_id' =>$request['custom_feild_id'],
                    'rating_id' =>$request['rating_id'],
                    'brand_id' =>$request['brand_id'],
                    'offer_id' =>$request['offer_id'],
                    'category_id'=>$request['category_id']
                ]);
                //check the category and request
                if(isset($allproducts) && count($allproducts))
                {
                    //insert other traslations for products
                    foreach ($allproducts as $allproduct)
                    {
                        $transProduct_arr[]=[
                            'name' => $allproduct ['name'],
                            'short_des' => $allproduct['short_des'],
                            'locale' => $allproduct['locale'],
                            'long_des' => $allproduct['long_des'],
                            'meta' => $allproduct['meta'],
                            'product_id' => $unTransProduct_id
                        ];
                    }
                    ProductTranslation::insert($transProduct_arr);
                }
                DB::commit();
                return $this->returnData('Product', [$unTransProduct_id,$transProduct_arr],'done');
            }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Product','faild');
        }
    }

    /*___________________________________________________________________________*/


    /*__________________________________________________________________*/
    /****  Update Product   ***
     * @param ProductRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request,$id)
    {
        // return $request;
        $validated = $request->validated();
        try{
            $product= Product::find($id);
            if(!$product)
                return $this->returnError('400', 'not found this Category');
            $allproducts = collect($request->product)->all();
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

            $unTransProduct=Product::where('id',$id)
                ->update([
                    'slug' =>$request['slug'],
                    'image' =>$request['image'],
                    'barcode' =>$request['barcode'],
                    'is_active' =>$request['is_active'],
                    'is_appear' =>$request['is_appear'],
                    'custom_feild_id' =>$request['custom_feild_id'],
                    'rating_id' =>$request['rating_id'],
                    'brand_id' =>$request['brand_id'],
                    'offer_id' =>$request['offer_id'],
                    'category_id'=>$request['category_id']
                ]);
            $ss=ProductTranslation::where('product_id',$id);
            $collection1 = collect($allproducts);
            $allcategorieslength=$collection1->count();
            $collection2 = collect($ss);

            $db_product= array_values(ProductTranslation::where('product_id',$id)
                ->get()
                ->all());
            $dbdproducts = array_values($db_product);
            $request_products = array_values($request->product);
            foreach($dbdproducts as $dbdproduct){
                foreach($request_products as $request_product){
                    $values= ProductTranslation::where('product_id',$id)
                        ->where('locale',$request_product['locale'])
                        ->update([
                            'name' => $request_product ['name'],
                            'short_des' => $request_product['short_des'],
                            'locale' => $request_product['locale'],
                            'long_des' => $request_product['long_des'],
                            'meta' => $request_product['meta'],
                            'product_id' => $id
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Category', $dbdproducts,'done');
        }
        catch(\Exception $ex){
            DB::rollback();
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
