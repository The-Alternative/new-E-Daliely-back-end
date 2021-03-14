<?php


namespace App\Service\MedicalDevice;

use App\Http\Requests\MedicalDevice\MedicalDeviceRequest;
use App\Models\medicalDevice\medicalDevice;
use App\Traits\GeneralTrait;

class MedicalDeviceService
{

    private $MedicalDeviceModel;
    use GeneralTrait;


    public function __construct(medicalDevice $MedicalDevice)
    {

        $this->MedicalDeviceModel=$MedicalDevice;
    }
    public function get()
    {

        $MedicalDevice=$this->MedicalDeviceModel::all()->where('is_active',1);
        return $this->returnData(' MedicalDevice', $MedicalDevice,'done');

    }

    public function getById($id)
    {

        $MedicalDevice= $this->MedicalDeviceModel::find($id);
        return $this->returnData(' MedicalDevice', $MedicalDevice,'done');

    }

    public function getTrashed()
    {
        $MedicalDevice= $this->MedicalDeviceModel::all()->where('is_active',0);
        return $this -> returnData(' MedicalDevice', $MedicalDevice,'done');
    }

    public function create( MedicalDeviceRequest $request )
    {
         $MedicalDevice=new medicalDevice();

         $MedicalDevice->name            =$request->name;
         $MedicalDevice->hospital_id     =$request->hospital_id;
         $MedicalDevice->doctor_id       =$request->doctor_id;
         $MedicalDevice->is_active       =$request->is_active;
         $MedicalDevice->is_approved     =$request->is_approved;


        $result= $MedicalDevice->save();
        if ($result)
        {
            return $this->returnData(' MedicalDevice',  $MedicalDevice,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }

    }

    public function update(MedicalDeviceRequest $request,$id)
    {

         $MedicalDevice= $this->MedicalDeviceModel::find($id);

        $MedicalDevice->name            =$request->name;
        $MedicalDevice->hospital_id     =$request->hospital_id;
        $MedicalDevice->doctor_id       =$request->doctor_id;
        $MedicalDevice->is_active       =$request->is_active;
        $MedicalDevice->is_approved     =$request->is_approved;


        $result= $MedicalDevice->save();
        if ($result)
        {
            return $this->returnData(' MedicalDevice',  $MedicalDevice,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }

    }

    public function search($name)
    {
        $MedicalDevice = DB::table('medical_devices')
            ->where("name","like","%".$name."%")
            ->get();
        if (! $MedicalDevice)
        {
            return $this->returnError('400', 'not found this medicalDevice');
        }
        else
        {
            return $this->returnData(' MedicalDevice',  $MedicalDevice,'done');

        }
    }

    public function trash( $id)
    {
        $MedicalDevice= $this->MedicalDeviceModel::find($id);
        $MedicalDevice->is_active=false;
        $MedicalDevice->save();

        return $this->returnData(' MedicalDevice',  $MedicalDevice,'This MedicalDevice is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $MedicalDevice=medicalDevice::find($id);
        $MedicalDevice->is_active=true;
        $MedicalDevice->save();

        return $this->returnData('MedicalDevice',  $MedicalDevice,'This MedicalDevice is trashed Now');
    }

    public function delete($id)
    {
        $MedicalDevice = medicalDevice::find($id);
        $MedicalDevice->is_active = false;
        $MedicalDevice->save();
        return $this->returnData('MedicalDevice',  $MedicalDevice, 'This MedicalDevice is deleted Now');

    }
}
