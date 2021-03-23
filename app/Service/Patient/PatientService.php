<?php


namespace App\Service\Patient;

use App\Http\Requests\Patient\PatientRequest;
use App\Models\Patient\Patient;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class PatientService
{

    private $PatientModel;
    use GeneralTrait;


    public function __construct(Patient $patient)
    {
        $this->PatientModel=$patient;
    }
    public function get()
    {
        $patient= $this->PatientModel::IsActive();
        return $this->returnData('Patient',$patient,'done');
    }

    public function getById($id)
    {
        $patient= $this->PatientModel::find($id);
        return $this->returnData('Patient',$patient,'done');
    }

    public function getTrashed()
    {
        $patient= $this->PatientModel::IsActive();
        return $this -> returnData('Paitent',$patient,'done');
    }

    public function create( PatientRequest $request )
    {
        $patient=new Patient();

        $patient->medical_file_number      =$request->medical_file_number;
        $patient->first_name               =$request->first_name;
        $patient->father_name              =$request->father_name;
        $patient->last_name                =$request->last_name;
        $patient->nationality              =$request->nationality;
        $patient->place_of_birth           =$request->place_of_birth;
        $patient->date_of_birth            =$request->date_of_birth;
        $patient->address                  =$request->address;
        $patient->phone_number             =$request->phone_number;
        $patient->social_status            =$request->social_status;
        $patient->gender                   =$request->gender;
        $patient->blood_type               =$request->blood_type;
        $patient->note                     =$request->note;
        $patient->is_active                =$request->is_active;
        $patient->is_approved              =$request->is_approved;

        $result=$patient->save();
        if ($result)
        {
            return $this->returnData('patient', $patient,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function update(PatientRequest $request,$id)
    {
        $patient= $this->PatientModel::find($id);

        $patient->medical_file_number      =$request->medical_file_number;
        $patient->first_name               =$request->first_name;
        $patient->father_name              =$request->father_name;
        $patient->last_name                =$request->last_name;
        $patient->nationality              =$request->nationality;
        $patient->place_of_birth           =$request->place_of_birth;
        $patient->date_of_birth            =$request->date_of_birth;
        $patient->address                  =$request->address;
        $patient->phone_number             =$request->phone_number;
        $patient->social_status            =$request->social_status;
        $patient->gender                   =$request->gender;
        $patient->blood_type               =$request->blood_type;
        $patient->note                     =$request->note;
        $patient->is_active                =$request->is_active;
        $patient->is_approved              =$request->is_approved;

        $result=$patient->save();
        if ($result)
        {
            return $this->returnData('patient', $patient,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }
    }

    public function search($name)
    {
        $patient = DB::table('Patients')
            ->where("first_name","like","%".$name."%")
            ->get();
        if (!$patient)
        {
            return $this->returnError('400', 'not found this patient');
        }
        else
        {
            return $this->returnData('patient', $patient,'done');
        }
    }

    public function trash( $id)
    {
        $patient= $this->PatientModel::find($id);
        $patient->is_active=false;
        $patient->save();
        return $this->returnData('patient', $patient,'This patient is trashed Now');
    }

    public function restoreTrashed( $id)
    {
        $patient=Patient::find($id);
        $patient->is_active=true;
        $patient->save();
        return $this->returnData('patient', $patient,'This patient is trashed Now');
    }

    public function delete($id)
    {
       $patient = Patient::find($id);
       $patient->is_active = false;
       $patient->save();
        return $this->returnData('patient', $patient, 'This patient is deleted Now');
    }

}
