<?php


namespace App\Service\Stores;

use App\Models\Brands\Brands;
use App\Models\Stores\Stores;
use Illuminate\Http\Request;

class StoreService
{
    private $StoresModel;
    public function __construct(Stores $store)
    {
        $this-> StoresModel=$store;

    }
    public function getAllStore()
    {
        $store = $this->StoresModel::all();


        return response()->json($store);
    }

    public function getStoreById($id)
    {
        $store= Stores::find($id);

        return response()->json($store);
    }

    public function createNewStores(Request $request)
    {
        $store=new Stores();

       $store->title             =$request ->title;
       $store->user_id           =$request ->user_id;
       $store->is_active         =$request ->is_active;
       $store->is_approved       =$request ->is_approved;
       $store->default_language  =$request ->default_language;
       $store->phone_number      =$request ->phone_number;
       $store->business_email    =$request ->business_email;
       $store->logo              =$request ->logo;
       $store->address           =$request ->address;
       $store->location          =$request ->location;
       $store->working_hours     =$request ->working_hours;
       $store->working_days      =$request ->working_days;

       $store->save();
       return request()->json($store);

    }

    public function updateStore(Request $request,$id)
    {

        $store= Stores::find($id);

        $store->title             =$request ->title;
        $store->user_id           =$request ->user_id;
        $store->is_active         =$request ->is_active;
        $store->is_approved       =$request ->is_approved;
        $store->default_language  =$request ->default_language;
        $store->phone_number      =$request ->phone_number;
        $store->business_email    =$request ->business_email;
        $store->logo              =$request ->logo;
        $store->address           =$request ->address;
        $store->location          =$request ->location;
        $store->working_hours     =$request ->working_hours;
        $store->working_days      =$request ->working_days;

        $store->save();
        return request()->json($store);

    }

    public function deleteStore(Request $request ,$id)
    {
        $store=Stores::find($id);

        $store->is_active           =$request->is_active;

        $store->save();
        return response()->json($store);
    }



}
