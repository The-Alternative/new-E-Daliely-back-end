<?php


namespace App\Service\Stores;

use App\Models\Brands\Brands;
use App\Models\Stores\Stores;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Requests\Store\StoreRequest;
use Illuminate\Support\Facades\DB;

class StoreService
{
    use GeneralTrait;
    private $StoresModel;
    public function __construct(Stores $store)
    {
        $this-> StoresModel=$store;

    }
    public function get()
    {
        $store = $this->StoresModel::all()->where('is_active','=',1);
        return $this->returnData('store',$store,'done');
    }

    public function getById($id)
    {
        $store=$this->StoresModel::find($id);

        return $this->returnData('Store',$store,'done');
    }

    public function create(StoreRequest $request)
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

        $result=$store->save();
        if ($result)
        {
            return $this->returnData('store', $store,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }

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

        $result=$store->save();
        if ($result)
        {
            return $this->returnData('store', $store,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }



    }

    public function delete(StoreRequest $request ,$id)
    {
        $store=Stores::find($id);

        $store->is_active           =$request->is_active;

        $store->save();
        return $this->returnData('store', $store,'This store Is deleted Now');
    }



    public function getTrashed()
    {
        $store=$this->StoresModel::all()->where('is_active',0);
        return $this -> returnData('Store',$store,'done');
    }


    public function restoreTrashed( $id)
    {
        $store=$this->StoresModel::find($id);
        $store->is_active=true;
        $store->save();
        return $this->returnData('Store', $store,'This Store Is trashed Now');
    }

    public function trash( $id)
    {
        $store= $this->StoresModel::find($id);
        $store->is_active=false;
        $store->save();
        return $this->returnData('Store', $store,'This Store Is trashed Now');
    }

    public function search($title)
    {
        $store = DB::table('stores')
            ->where("name","like","%".$title."%")
            ->get();
        if (!$store)
        {
            return $this->returnError('400', 'not found this store');

        }
        else
        {
            return $this->returnData('store', $store,'done');

        }
    }

}
