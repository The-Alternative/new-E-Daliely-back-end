<?php


namespace App\Service\Specialty;


use App\Http\Requests\Specialty\SpecialtyRequest;
use App\Models\Doctors\DoctorTranslation;
use App\Models\medicalDevice\medicalDevice;
use App\Models\medicalDevice\MedicalDeviceTranslation;
use App\Models\Specialty\Specialty;
use App\Models\Specialty\SpecialtyTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class SpecialtyService
{
    private $SpecialtyModel;
    use GeneralTrait;


    public function __construct(Specialty $Specialty)
    {

        $this->SpecialtyModel=$Specialty;
    }
    public function get()
    {

        $Specialty=$this->SpecialtyModel::all()->IsActive()->WithTrans();
        return $this->returnData(' Specialty', $Specialty,'done');

    }

    public function getById($id)
    {

        $Specialty= $this->SpecialtyModel::find($id);
        return $this->returnData(' Specialty', $Specialty,'done');

    }

    public function getTrashed()
    {
        $Specialty= $this->SpecialtyModel::all();
        return $this -> returnData('Specialty', $Specialty,'done');
    }
//_____________________________________________________________________//
    public function create( SpecialtyRequest $request )
    {
        try {
            $allspecialty = collect($request->Specialty)->all();

            DB::beginTransaction();

            $unTransspecialty_id = Specialty::insertGetId([
                'graduation_year' => $request['graduation_year'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allspecialty) && count($allspecialty)) {
                foreach ($allspecialty as $allspecialty) {
                    $transspecialty_arr[] = [
                        'name' => $allspecialty ['name'],
                        'locale' => $allspecialty['locale'],
                        'specialty_id' => $unTransspecialty_id,
                    ];
                }
                $transspecialty_arr =MedicalDeviceTranslation::insert($transspecialty_arr);
            }
            DB::commit();
            return $this->returnData('Specialty', [$unTransspecialty_id, $transspecialty_arr], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Specialty', 'faild');
        }
//        $Specialty=new Specialty();
//
//        $Specialty->name                =$request->name;
//        $Specialty->graduation_year     =$request->graduation_year ;
//        $Specialty->is_active           =$request->is_active ;
//
//
//        $result= $Specialty->save();
//        if ($result)
//        {
//            return $this->returnData('Specialty',  $Specialty,'done');
//        }
//        else
//        {
//            return $this->returnError('400', 'saving failed');
//        }

    }
//_________________________________________________________//
    public function update(SpecialtyRequest $request,$id)
    {
        try{
            $specialty= Specialty::find($id);
            if(!$specialty)
                return $this->returnError('400', 'not found this Specialty');
            $allspecialty = collect($request->Specialty)->all();
            if (!($request->has('specialty.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newspecialty=Specialty::where('id',$id)
                ->update([
                    'graduation_year' => $request['graduation_year'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=SpecialtyTranslation::where('specialty_id',$id);
            $collection1 = collect($allspecialty);
            $alldoctorlength=$collection1->count();
            $collection2 = collect($ss);

            $db_specialty= array_values(SpecialtyTranslation::where('specialty_id',$id)
                ->get()
                ->all());
            $dbspecialty = array_values($db_specialty);
            $request_specialty= array_values($request->Specialty);
            foreach($dbspecialty as $dbspecialty){
                foreach($request_specialty as $request_specialty){
                    $values= DoctorTranslation::where('doctor_id',$id)
                        ->where('locale',$request_specialty['locale'])
                        ->update([
                            'name' => $allspecialty ['name'],
                            'locale' => $allspecialty['locale'],
                            'specialty_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Specialty', $dbspecialty,'done');

        }
        catch(\Exception $ex){
            return $this->returnError('400', 'saving failed');
        }

//        $Specialty= $this->SpecialtyModel::find($id);
//
//        $Specialty->name                =$request->name;
//        $Specialty->graduation_year     =$request->graduation_year ;
//        $Specialty->is_active           =$request->is_active ;
//
//
//
//        $result= $Specialty->save();
//        if ($result)
//        {
//            return $this->returnData('Specialty',  $Specialty,'done');
//        }
//        else
//        {
//            return $this->returnError('400', 'updating failed');
//        }

    }

    public function search($name)
    {
        $Specialty = DB::table('specialties')
            ->where("name","like","%".$name."%")
            ->get();
        if (! $Specialty)
        {
            return $this->returnError('400', 'not found this Specialty');
        }
        else
        {
            return $this->returnData('Specialty',  $Specialty,'done');

        }
    }

    public function trash( $id)
    {
        $Specialty= $this->SpecialtyModel::find($id);
        $Specialty->is_active=false;
        $Specialty->save();

        return $this->returnData('Specialty',  $Specialty,'This Specialty is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $Specialty=Specialty::find($id);
        $Specialty->is_active=true;
        $Specialty->save();

        return $this->returnData('Specialty',  $Specialty,'This Specialty is trashed Now');
    }

    public function delete($id)
    {
        $Specialty = Specialty::find($id);
        $Specialty->is_active = false;
        $Specialty->save();
        return $this->returnData('Specialty',  $Specialty, 'This Specialty is deleted Now');

    }
}
