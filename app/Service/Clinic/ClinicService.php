<?php


namespace App\Service\Clinic;


use App\Http\Requests\Clinic\ClinicRequest;
use App\Models\Clinic\Clinic;
use App\Models\Clinic\ClinicTranslation;
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
        $clinic= $this->ClinicModel::IsActive()->WithTrans();
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
//___________________________________________________________________//
    public function create( ClinicRequest $request )
    {
        try {
            $allclinic= collect($request->Clinic)->all();

            DB::beginTransaction();

            $unTransclinic_id = Clinic::insertGetId([
                'location_id' => $request['location_id'],
                'doctor_id' => $request['doctor_id'],
                'phone_number' => $request['phone_number'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allclinic) && count($allclinic)) {
                foreach ($allclinic as $allclinic) {
                    $transclinic_arr[] = [
                        'name' => $allclinic['name'],
                        'locale' => $allclinic['locale'],
                        'clinic_id' => $unTransclinic_id,
                    ];
                }
                $transclinic_arr =ClinicTranslation::insert($transclinic_arr);
            }
            DB::commit();
            return $this->returnData('Clinic', [$unTransclinic_id, $transclinic_arr], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Clinic', 'faild');
        }
//        $clinic=new Clinic();
//
//        $clinic->name                 =$request->name;
//        $clinic->doctor_id            =$request->doctor_id ;
//        $clinic->location_id          =$request->location_id  ;
//        $clinic->phone_number         =$request->phone_number;
//        $clinic->is_active            =$request->is_active ;
//        $clinic->is_approved          =$request->is_approved;
//
//        $result=$clinic->save();
//        if ($result)
//        {
//            return $this->returnData('clinic', $clinic,'done');
//        }
//        else
//        {
//            return $this->returnError('400', 'saving failed');
//        }
    }
//______________________________________________________________//
    public function update(ClinicRequest $request,$id)
    {
        try{
            $clinic= Clinic::find($id);
            if(!$clinic)
                return $this->returnError('400', 'not found this Clinic');
            $allclinic= collect($request->Clinic)->all();
            if (!($request->has('clinic.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newclinic=Clinic::where('id',$id)
                ->update([
                    'location_id' => $request['location_id'],
                    'doctor_id' => $request['doctor_id'],
                    'phone_number' => $request['phone_number'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=ClinicTranslation::where('clinic_id',$id);
            $collection1 = collect($allclinic);
            $alldoctorlength=$collection1->count();
            $collection2 = collect($ss);

            $db_clinic= array_values(ClinicTranslation::where('clinic_id',$id)
                ->get()
                ->all());
            $dbclinic = array_values($db_clinic);
            $request_clinic= array_values($request->Clinic);
            foreach($dbclinic as $dbclinic){
                foreach($request_clinic as $request_clinic){
                    $values= ClinicTranslation::where('clinic_id',$id)
                        ->where('locale',$request_clinic['locale'])
                        ->update([
                            'name' => $allclinic ['name'],
                            'locale' => $allclinic['locale'],
                            'clinic_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Clinic', $dbclinic,'done');

        }
        catch(\Exception $ex){
            return $this->returnError('400', 'saving failed');
        }
//        $clinic= $this->ClinicModel::find($id);
//
//        $clinic->name                 =$request->name;
//        $clinic->doctor_id            =$request->doctor_id ;
//        $clinic->location_id          =$request->location_id  ;
//        $clinic->phone_number         =$request->phone_number;
//        $clinic->is_active            =$request->is_active ;
//        $clinic->is_approved          =$request->is_approved;
//
//        $result=$clinic->save();
//        if ($result)
//        {
//            return $this->returnData('clinic', $clinic,'done');
//        }
//        else
//        {
//            return $this->returnError('400', 'updating failed');
//        }
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
