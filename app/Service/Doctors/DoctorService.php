<?php


namespace App\Service\Doctors;

use App\Models\Doctors\doctor;
use App\Traits\GeneralTrait;
use App\Http\Requests\Doctors\DoctorRequest;
use Illuminate\Support\Facades\DB;

class DoctorService
{
    private $doctorModel;
    use GeneralTrait;


    public function __construct(doctor $doctor)
    {
        $this->doctorModel=$doctor;
    }
    public function get()
    {
        $doctor= $this->doctorModel::all()->where('is_active','=',1);
        return $this->returnData('doctor',$doctor,'done');
    }

    public function getById($id)
    {
        $doctor= $this->doctorModel::find($id);
        return $this->returnData('doctor',$doctor,'done');
    }

    public function getTrashed()
    {
        $doctor= $this->doctorModel::all()->where('is_active',0);
        return $this -> returnData('doctor',$doctor,'done');
    }

    public function create( DoctorRequest $request )
    {
        $doctor=new doctor();

        $doctor->name                 =$request->name;
        $doctor->description          =$request->description;
        $doctor->image                =$request->image;
        $doctor->social_media_id      =$request->social_media_id ;
        $doctor->specialty_id         =$request->specialty_id;
        $doctor->work_place_id        =$request->work_place_id;
        $doctor->hospital_id          =$request->hospital_id;
        $doctor->is_active            =$request->is_active ;
        $doctor->is_approved          =$request->is_approved;

        $result=$doctor->save();
        if ($result)
        {
            return $this->returnData('doctor', $doctor,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function update(DoctorRequest $request,$id)
    {
        $doctor= $this->doctorModel::find($id);

        $doctor->name                 =$request->name;
        $doctor->description          =$request->description;
        $doctor->image                =$request->image;
        $doctor->social_media_id      =$request->social_media_id ;
        $doctor->specialty_id         =$request->specialty_id;
        $doctor->work_place_id        =$request->work_place_id;
        $doctor->hospital_id          =$request->hospital_id;
        $doctor->is_active            =$request->is_active ;
        $doctor->is_approved          =$request->is_approved;

        $result=$doctor->save();
        if ($result)
        {
            return $this->returnData('doctor', $doctor,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }
    }

    public function search($name)
    {
        $doctor = DB::table('doctors')
            ->where("name","like","%".$name."%")
            ->get();
        if (!$doctor)
        {
            return $this->returnError('400', 'not found this doctor');
        }
        else
        {
            return $this->returnData('doctor', $doctor,'done');
        }
    }

    public function trash( $id)
    {
        $doctor= $this->doctorModel::find($id);
        $doctor->is_active=false;
        $doctor->save();
        return $this->returnData('doctor', $doctor,'This doctor is trashed Now');
    }

    public function restoreTrashed( $id)
    {
        $doctor=doctor::find($id);
        $doctor->is_active=true;
        $doctor->save();
        return $this->returnData('doctor', $doctor,'This doctor is trashed Now');
    }

    public function delete($id)
    {
        $doctor = doctor::find($id);
        $doctor->is_active = false;
        $doctor->save();
        return $this->returnData('doctor', $doctor, 'This doctor is deleted Now');
    }

    //get all doctor's social media by doctor's name
    public function SocialMedia($doctor_name)
    {
        return doctor::with('socialMedia')
                     ->where("name","like","%".$doctor_name."%")
                     ->get();
    }

    //get  doctor's work place by doctor's name
    public function workplace($doctor_name)
    {
        return doctor::with('workPlace')
                     ->where("name","like","%".$doctor_name."%")
                     ->get();
    }

    //get  doctor's medical devices by doctor's name
    public function doctormedicaldevice($doctor_name)
    {
        return doctor::with('medicalDevice')
                     ->where("name","like","%".$doctor_name."%")
                     ->get();
    }
    public function hospital($doctor_name)
    {
        return doctor::with('hospital')
            ->where("name","like","%".$doctor_name."%")
            ->get();
    }

    //get all doctor's details by doctor's name
    public function getalldetails($doctor_name)
    {
        return  doctor::with('medicalDevice','socialMedia','workPlace','hospital')
                      ->where("name","like","%".$doctor_name."%")
                      ->get();
    }
}
