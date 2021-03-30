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
    public function viewStoresHasProduct($id){

         $product = Product::with('Store')->find($id);
        return $response= $this->returnData('Product in Store',$product,'done');

//        $allProducts=StoreProduct::where('store_id',$id)->get();
//         return $product_details=Store::with(['Product' => function ($q)
//         {
//              $q->join('products', 'products.id', '=', 'stores_products.product_id')
////                 ->where('stores_products.product_id', 'products.id')
//                 ->select(['products.*']);}])->get();

//         where('store_id',$id)->join('products', 'products.id', '=', 'stores_products.product_id')
//            ->where('stores_products.product_id','products.id')
//            ->select(['products.*','stores_products.*'])->get();


//       $collection1= $allProducts->collect($allProducts)->all();
//        $allProducts->where();
    }

    public function insertProductToStore(Request $request){
        $Products=collect($request->Product)->all();
        $store = Store::find($request->store_id);
        $storeProduct=new StoreProduct();
        $storeProduct->store_id =$request->store_id;
        $storeProduct->Product_id =$request->Product_id;
        $storeProduct->price = $request->price;
        $storeProduct->quantity =$request->quantity;
        $storeProduct->save();
        return $response= $this->returnData('Product in Store',[$store,$storeProduct],'done');
    }
//{
//"store_id": 2,
//"Product_id": 1,
//"price": "651",
//"quantity": "5450"
//}
    public function updateProductInStore(Request $request){
        $Products=collect($request->Product)->all();
        $store = Store::find($request->store_id);
        $storeProduct=new StoreProduct();
        $storeProduct->store_id =$request->store_id;
        $storeProduct->Product_id =$request->Product_id;
        $storeProduct->price = $request->price;
        $storeProduct->quantity =$request->quantity;
        $storeProduct->save();
        return $response= $this->returnData('Product in Store',[$store,$storeProduct],'done');
    }




}




