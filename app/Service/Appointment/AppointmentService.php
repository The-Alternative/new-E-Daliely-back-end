<?php


namespace App\Service\Appointment;


use App\Http\Requests\Appointment\AppointmentRequest;
use App\Models\Appointment\Appointment;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class AppointmentService
{
    private $AppointmentModel;
    use GeneralTrait;


    public function __construct(Appointment $appointment)
    {
        $this->AppointmentModel=$appointment;
    }
    public function get()
    {
        $appointment= $this->AppointmentModel::IsActive();
        return $this->returnData('Appointment',$appointment,'done');
    }

    public function getById($id)
    {
        $appointment= $this->AppointmentModel::find($id);
        return $this->returnData('Appointment',$appointment,'done');
    }

    public function getTrashed()
    {
        $appointment= $this->AppointmentModel::IsActive();
        return $this -> returnData('Appointment',$appointment,'done');
    }

    public function create( AppointmentRequest $request )
    {
        $appointment=new Appointment();

        $appointment->doctors_id                =$request->doctors_id;
        $appointment->patients_id               =$request->patients_id;
        $appointment->date_time_appointment     =$request->date_time_appointment;
        $appointment->is_approved               =$request->is_approved;
        $appointment->is_active                 =$request->is_active;


        $result=$appointment->save();
        if ($result)
        {
            return $this->returnData('Appointment', $appointment,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function update(AppointmentRequest $request,$id)
    {
        $appointment= $this->AppointmentModel::find($id);

        $appointment->doctors_id                =$request->doctors_id;
        $appointment->patients_id               =$request->patients_id;
        $appointment->date_time_appointment     =$request->date_time_appointment;
        $appointment->is_approved               =$request->is_approved;
        $appointment->is_active                 =$request->is_active;

        $result=$appointment->save();
        if ($result)
        {
            return $this->returnData('Appointment', $appointment,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }
    }

//    public function search($name)
//    {
//        $appointment = DB::table('Appointments')
//            ->where("first_name","like","%".$name."%")
//            ->get();
//        if (!$appointment)
//        {
//            return $this->returnError('400', 'not found this patient');
//        }
//        else
//        {
//            return $this->returnData('Appointment', $appointment,'done');
//        }
//    }

    public function trash( $id)
    {
        $appointment= $this->AppointmentModel::find($id);
        $appointment->is_active=false;
        $appointment->save();
        return $this->returnData('Appointment', $appointment,'This Appointment is trashed Now');
    }

    public function restoreTrashed( $id)
    {
        $appointment=Appointment::find($id);
        $appointment->is_active=true;
        $appointment->save();
        return $this->returnData('Appointment', $appointment,'This Appointment is trashed Now');
    }

    public function delete($id)
    {
        $patient =Appointment::find($id);
        $patient->is_active = false;
        $patient->save();
        return $this->returnData('patient', $patient, 'This patient is deleted Now');
    }
}
