<?php


namespace App\Service\Stores;

use App\Models\Stores\Store;
use App\Models\Products\Product;
use App\Models\Stores\StoreProduct;
use App\Models\Stores\StoreTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use LaravelLocalization;

class StoresProductsService
{
    use GeneralTrait;

    private $StoresProductsService;
    private $storeProductModel;

    public function __construct(StoreProduct $storeProduct)
    {
        $this->storeProductModel=$storeProduct;
    }
    public function viewStoresHasProduct($id)
    {
         $product = Product::with('Store')->find($id);
//        $product = Product::with('Store')->where('products.id',$id)->get();
//        return $product->store();
        return $response= $this->returnData('Product in Store',$product,'done');
    }
    public function viewProductsInStore($id)
    {
        $product = Store::with('Product')->find($id);
//        $product = Product::with('Store')->where('products.id',$id)->get();
//        return $product->store();
        return $response= $this->returnData('Product in Store',$product,'done');
    }

    public function rangeOfPrice($id)
    {
        $products = StoreProduct::where('product_id',$id)->get();
//       if (isset($products)){
//           return $this->returnError('400', 'not found this Product');
//
//       }

           foreach($products as $product) {
               $collection1[] =
                   $product['price'];
           }
              $collection = collect($collection1)->all();
               $collectionq1 = array_values($collection);
               $max = collect($collectionq1)->max();
               $min = collect($collectionq1)->min();

               return $response = $this->returnData('range Of Price in all Store', ['max', $max, 'min', $min], 'done');
           }
    public function insertProductToStore(Request $request)
    {
        $request->is_active?$is_active=true:$is_active=false;
        $request->is_appear?$is_appear=true:$is_appear=false;
            $Products=collect($request->Product)->all();
            $store = Store::find($request->store_id);
            $storeProduct=new StoreProduct();
            $storeProduct->store_id =$request->store_id;
            $storeProduct->Product_id =$request->Product_id;
            $storeProduct->price = $request->price;
            $storeProduct->quantity =$request->quantity;
            $storeProduct->is_active =$request->is_active;
            $storeProduct->is_appear =$request->is_appear;
            $storeProduct->save();
        return $response= $this->returnData('Product in Store',[$store,$storeProduct],'done');
    }
//{
//"store_id": 2,
//"Product_id": 1,
//"price": "651",
//"quantity": "5450"
//}
    public function updateProductInStore(Request $request,$id)
    {
        $Products=collect($request->Product)->all();
//        $store = Store::where('store_id',$id)->find($id);
        $storeProduct=StoreProduct::where('Product_id',$id)->update([
            'store_id'=>$request->Product_id,
            'Product_id' =>$request->Product_id,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
        ]);
        return $response= $this->returnData('Product in Store',$storeProduct,'done');
    }
    public function hiddenProductByQuantity( $id)
    {  $product=StoreProduct::find($id);
        if ($product->quantity==0)
        {
            $product=StoreProduct::where('product_id',$id)->Update([
                'is_appear'=>$product['is_appear']=0
            ]);
         return $this->returnData('product', $product,'This Product Is empty Now');
        }
            else {
                return $this->returnData('product', $product,'This Product Is available Now');
            }
        }


}




