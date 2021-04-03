<?php


namespace App\Service\Stores;

use App\Models\Stores\Store;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Requests\Store\StoreRequest;
use Illuminate\Support\Facades\DB;

use App\Models\Products\Product;
use App\Models\Stores\StoreProduct;
use App\Models\Stores\StoreTranslation;
use App\Scopes\StoreScope;

use Exception;
use LaravelLocalization;
use Symfony\Component\Console\Input\Input;


class StoreService
{
    use GeneralTrait;

    private $StoreModel;
    public function __construct(Store $store)
    {
        $this-> StoreModel=$store;

    }
//    public function get()
//    {
//        $store = $this->StoreModel::all()->where('is_active','=',1);
//        return $this->returnData('store',$store,'done');
//    }

    public function getById($id)
    {
        $store = $this->StoreModel::find($id);

        return $this->returnData('Store', $store, 'done');

//    private $StoreService;
//    private $storeModel;


        /**
         * Category Service constructor.
         * @param Store $store
         */

//    public function __construct(Store $store)
//    {
//        $this->storeModel=$store;
//    }

        /****Get All Active category Or By ID  ****/
    }
    public function get()
    {
        $store = Store::with(['StoreTranslation'=>function($q){
            $q->where('local',get_current_local());
        },'Product'])->get();

        return $response= $this->returnData('Store',$store,'done');

    }
//    public function getById($id)
//    {
//        $store = Store::with(['StoreTranslation' => function ($q) {
//            $q->where('local', get_current_local());
//        }, 'Product'])->find($id);
//    }

//    public function create(StoreRequest $request): \Illuminate\Http\JsonResponse
//    {
////        $validated = $request->validated();
////        $store=Store::create($request->all());
//        $store=new Store();
//
//       $store->title             =$request ->title;
//       $store->user_id           =$request ->user_id;
//       $store->is_active         =$request ->is_active;
//       $store->is_approved       =$request ->is_approved;
//       $store->default_language  =$request ->default_language;
//       $store->phone_number      =$request ->phone_number;
//       $store->business_email    =$request ->business_email;
//       $store->logo              =$request ->logo;
//       $store->address           =$request ->address;
//       $store->location          =$request ->location;
//       $store->working_hours     =$request ->working_hours;
//       $store->working_days      =$request ->working_days;
//
//        $result=$store->save();
//        if ($result)
//        {
//            return $this->returnData('store', $store,'done');
//        }
//        else
//        {
//            return $this->returnError('400','saving failed');
//        }
//
////
////        return $response= $this->returnData('Store',$store,'done');
//    }
    /****ــــــThis Functions For Trashed category  ****/
    /****Get All Trashed Products Or By ID  ****/

    public function getTrashed()
    {
        $store = Store::trans()->where('is_active',0)->get();
        return $this -> returnData('Store',$store,'done');
    }
    /****Restore category Fore Active status  ****/
    public function restoreTrashed( $id)
    {
        $store=Store::find($id);
        $store->is_active=true;
        $store->save();
        return $this->returnData('Store', $store,'This Store Is trashed Now');
    }
    /****   category's Soft Delete   ****/


    public function trash( $id)
    {
        $store=Store::find($id);
        $store->is_active=false;
        $store->save();
        return $this->returnData('Store', $store,'This Store Is trashed Now');
    }


//    public function update(Request $request,$id)

    /*ــــــــــــــــــــــــ  ـــــــــــــــــــــــ*/

    /****  Create category   ***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    /*___________________________________________________________________________*/
    public function create(Request $request)

    {
        try {
//
//
//        $store= Store::find($id);
//
//        $store->title             =$request ->title;
//        $store->user_id           =$request ->user_id;
//        $store->is_active         =$request ->is_active;
//        $store->is_approved       =$request ->is_approved;
//        $store->default_language  =$request ->default_language;
//        $store->phone_number      =$request ->phone_number;
//        $store->business_email    =$request ->business_email;
//        $store->logo              =$request ->logo;
//        $store->address           =$request ->address;
//        $store->location          =$request ->location;
//        $store->working_hours     =$request ->working_hours;
//        $store->working_days      =$request ->working_days;
//
//        $result=$store->save();
//        if ($result)
//        {
//            return $this->returnData('store', $store,'done');
//        }
//        else
//        {
//            return $this->returnError('400', 'saving failed');
//        }


//        validated = $request->validated();
        $request->is_active ? $is_active = true : $is_active = false;
        $request->is_appear ? $is_appear = true : $is_appear = false;
        //transformation to collection
        $stores = collect($request->store)->all();


        ///select folder to save the image
        // $fileBath = "" ;
        //     if($request->has('image'))
        //     {
        //         $fileBath=uploadImage('images/products',$request->image);
        //     }
//        DB::beginTransaction();
        // //create the default language's product
        $unTransStore_id = Store::insertGetId([
            //                'section_id' =>$request['section_id'],
            'loc_id' => $request['loc_id'],
            'country_id' => $request['country_id'],
            'gov_id' => $request['gov_id'],
            'city_id' => $request['city_id'],
            'street_id' => $request['street_id'],
            'offer_id' => $request['offer_id'],
            'socialMedia_id' => $request['socialMedia_id'],
            'followers_id' => $request['followers_id'],
            'is_active' => $request['is_active'],
            'is_approved' => $request['is_approved'],
            'delivery' => $request['delivery'],
            'edalilyPoint' => $request['edalilyPoint'],
            'rating' => $request['rating'],
            'workingHours' => $request['workingHours'],
            'logo' => $request['logo']
        ]);
        //check the category and request
        if (isset($stores) && count($stores)) {
            //insert other traslations for products
            foreach ($stores as $store) {
                $transstore_arr[] = [
                    'local' => $store['local'],
                    'title' => $store['title'],
                    'store_id' => $unTransStore_id
                ];
            }
            StoreTranslation::insert($transstore_arr);
        }
        DB::commit();
        return $this->returnData('Store', [$unTransStore_id, $transstore_arr], 'done');
    }
        catch(\Exception $ex)
            {
                DB::rollback();
                return $this->returnError('store','faild');
            }
    }

//
//    public function delete(StoreRequest $request ,$id)
//    {
//        $store=Store::find($id);

    /*___________________________________________________________________________*/

    /****__________________  Update category   ___________________***
     * @param Request $request
     * @param $id
     * @return Exception|\Illuminate\Http\JsonResponse
     */

    public function update(Request $request,$id)
    {
        try{
            //$validated = $request->validated();
            $category= Store::find($id);
            if(!$category)
                return $this->returnError('400', 'not found this Store');
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
            DB::beginTransaction();


            $nStore=Store::where('id',$id)
                ->update([
//                    'section_id' => $request['section_id'],
                    'loc_id' => $request['loc_id'],
                    'country_id' => $request['country_id'],
                    'gov_id' => $request['gov_id'],
                    'city_id'=>$request['city_id'],
                    'street_id'=>$request['street_id'],
                    'offer_id'=>$request['offer_id'],
                    'socialMedia_id'=>$request['socialMedia_id'],
                    'followers_id'=>$request['followers_id'],
                    'is_active'=>$request['is_active'],
                    'is_approved'=>$request['is_approved'],
                    'delivery'=>$request['delivery'],
                    'edalilyPoint'=>$request['edalilyPoint'],
                    'rating'=>$request['rating'],
                    'workingHours'=>$request['workingHours'],
                    'logo'=>$request['logo'],
                ]);
        $stores = collect($request->store)->all();
            $dbdstores=StoreTranslation::where('Store_id',$id)->get();
            foreach($dbdstores as $dbdstore){
                foreach($stores as $store){
                    $values= StoreTranslation::where('store_id',$id)
                        ->where('local',$store['local'])
                        ->update([
                            'title'=>$store['title'],
                            'local'=>$store['local'],
                            'store_id'=>$id
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Store', [$id,$dbdstores,$nStore],'Updated Done');
        }
        catch(\Exception $ex){
            DB::rollback();
            return $this->returnError('400', 'Updating failed');
        }
    }

    /*___________________________________________________________________________*/
    /****________________  ٍsearch for Product _________________***
     * @param $title
     * @return \Illuminate\Http\JsonResponse
     */


//        $store->save();
//        return $this->returnData('store', $store,'This store Is deleted Now');
//    }



//    public function getTrashed()
//    {
//        $store=$this->StoreModel::all()->where('is_active',0);
//        return $this -> returnData('Store',$store,'done');
//    }
//
//
//    public function restoreTrashed( $id)
//    {
//        $store = $this->StoreModel::find($id);
//        $store->is_active = true;
//        $store->save();
//        return $this->returnData('Store', $store, 'This Store Is trashed Now');
//    }
    public function search($title)
    {
        $store = DB::table('Store')
            ->where("name","like","%".$title."%")
            ->get();
        if (!$store)
        {
            return $this->returnError('400', 'not found this Store');
        }
        else
        {
            return $this->returnData('Store', $store,'done');
        }

    }
    /*___________________________________________________________________________*/


//    public function trash( $id)
//    {
//        $store= $this->StoreModel::find($id);
//        $store->is_active=false;
//        $store->save();
//        return $this->returnData('Store', $store,'This Store Is trashed Now');
//    }
//
//    public function search($title)
//    {
//        $store = DB::table('stores')
//            ->where("name", "like", "%" . $title . "%")
//            ->get();
//        if (!$store) {
//            return $this->returnError('400', 'not found this store');
//
//        } else {
//            return $this->returnData('store', $store, 'done');
//
//        }
//    }

    /****_______________  Delete Product   ________________***
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function delete($id)
    {
        $store =Store::find($id);
        if ($store->is_active=0)
        {
            $store=Store::destroy($id);
            return $this->returnData('Category', $store,'This Store Is deleted Now');

        }
    }

}
