<?php


namespace App\Service\Clinic;


use App\Http\Requests\Clinic\ClinicRequest;
use App\Models\Clinic\Clinic;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class ClinicService
{
    private $ClinicModel;
    use GeneralTrait;


    public function __construct(Clinic $clinic)
    {
        $this->ClinicModel=$clinic;
    }
    public function get()
    {
        $clinic= $this->ClinicModel::IsActive();
        return $this->returnData('clinic',$clinic,'done');
    }

    public function getById($id)
    {
        $clinic= $this->ClinicModel::find($id);
        return $this->returnData('clinic',$clinic,'done');
    }

    public function getTrashed()
    {
        $clinic= $this->ClinicModel::all()->where('is_active',0);
        return $this -> returnData('clinic',$clinic,'done');
    }

    public function create( ClinicRequest $request )
    {
        $clinic=new Clinic();

        $clinic->name                 =$request->name;
        $clinic->doctor_id            =$request->doctor_id ;
        $clinic->location_id          =$request->location_id  ;
        $clinic->phone_number         =$request->phone_number;
        $clinic->is_active            =$request->is_active ;
        $clinic->is_approved          =$request->is_approved;

        $result=$clinic->save();
        if ($result)
        {
            return $this->returnData('clinic', $clinic,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function update(ClinicRequest $request,$id)
    {
        $clinic= $this->ClinicModel::find($id);

        $clinic->name                 =$request->name;
        $clinic->doctor_id            =$request->doctor_id ;
        $clinic->location_id          =$request->location_id  ;
        $clinic->phone_number         =$request->phone_number;
        $clinic->is_active            =$request->is_active ;
        $clinic->is_approved          =$request->is_approved;

        $result=$clinic->save();
        if ($result)
        {
            return $this->returnData('clinic', $clinic,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }
    }

    public function search($name)
    {
        $clinic = DB::table('clinics')
            ->where("name","like","%".$name."%")
            ->get();
        if (!$clinic)
        {
            return $this->returnError('400', 'not found this doctor');
        }
        else
        {
            return $this->returnData('clinic', $clinic,'done');
        }
    }

    public function trash( $id)
    {
        $clinic= $this->ClinicModel::find($id);
        $clinic->is_active=false;
        $clinic->save();
        return $this->returnData('clinic', $clinic,'This clinic is trashed Now');
    }

    public function restoreTrashed( $id)
    {
       $clinic=Clinic::find($id);
       $clinic->is_active=true;
       $clinic->save();
        return $this->returnData('clinic', $clinic,'This clinic is trashed Now');
    }

    public function delete($id)
    {
        $clinic = Clinic::find($id);
        $clinic->is_active = false;
        $clinic->save();
        return $this->returnData('clinic', $clinic, 'This clinic is deleted Now');
    }

}
