<?php


namespace App\Service\Specialty;


use App\Http\Requests\Specialty\SpecialtyRequest;
use App\Models\Specialty\Specialty;
use App\Traits\GeneralTrait;

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

        $Specialty=$this->SpecialtyModel::all();
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

    public function create( SpecialtyRequest $request )
    {
        $Specialty=new Specialty();

        $Specialty->name                =$request->name;
        $Specialty->graduation_year     =$request->graduation_year ;


        $result= $Specialty->save();
        if ($result)
        {
            return $this->returnData('Specialty',  $Specialty,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }

    }

    public function update(SpecialtyRequest $request,$id)
    {

        $Specialty= $this->SpecialtyModel::find($id);

        $Specialty->name                =$request->name;
        $Specialty->graduation_year     =$request->graduation_year ;


        $result= $Specialty->save();
        if ($result)
        {
            return $this->returnData('Specialty',  $Specialty,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }

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
