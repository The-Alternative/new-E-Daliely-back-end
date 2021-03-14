<?php


namespace App\Service\SocialMedia;


use App\Http\Requests\SocialMedia\SocialMediaRequest;
use App\Models\SocialMedia\SocialMedia;
use App\Traits\GeneralTrait;

class SocialMediaService
{
    private $SocialMediaModel;
    use GeneralTrait;


    public function __construct(SocialMedia $SocialMedia)
    {

        $this->SocialMediaModel=$SocialMedia;
    }
    public function get()
    {

        $SocialMedia=$this->SocialMediaModel::all();
        return $this->returnData('SocialMedia',$SocialMedia,'done');

    }

    public function getById($id)
    {

        $SocialMedia= $this->SocialMediaModel::find($id);
        return $this->returnData('SocialMedia',$SocialMedia,'done');

    }

    public function getTrashed()
    {
        $SocialMedia= $this->SocialMediaModel::all()->where('is_active',0);
        return $this -> returnData('SocialMedia',$SocialMedia,'done');
    }

    public function create( SocialMediaRequest $request )
    {
        $SocialMedia=new SocialMedia();

        $SocialMedia->phone_number                       =$request->phone_number ;
        $SocialMedia->whatsapp_number                    =$request->whatsapp_number;
        $SocialMedia->facebook_account                   =$request->facebook_account;
        $SocialMedia->telegram_account                   =$request->telegram_account ;
        $SocialMedia->email                              =$request->email  ;


        $result=$SocialMedia->save();
        if ($result)
        {
            return $this->returnData('SocialMedia', $SocialMedia,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }

    }

    public function update(SocialMediaRequest $request,$id)
    {

        $SocialMedia= $this->SocialMediaModel::find($id);

        $SocialMedia->phone_number                       =$request->phone_number ;
        $SocialMedia->whatsapp_number                    =$request->whatsapp_number;
        $SocialMedia->facebook_account                   =$request->facebook_account;
        $SocialMedia->telegram_account                   =$request->telegram_account ;
        $SocialMedia->email                              =$request->email  ;

        $result=$SocialMedia->save();
        if ($result)
        {
            return $this->returnData('SocialMedia', $SocialMedia,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }

    }

//    public function search($name)
//    {
//        $SocialMedia = DB::table('doctors')
//            ->where("name","like","%".$name."%")
//            ->get();
//        if (!$doctorRate)
//        {
//            return $this->returnError('400', 'not found this doctorRate');
//        }
//        else
//        {
//            return $this->returnData('doctorRate', $doctorRate,'done');
//
//        }
//    }

    public function trash( $id)
    {
        $SocialMedia= $this->SocialMediaModel::find($id);
        $SocialMedia->is_active=false;
        $SocialMedia->save();

        return $this->returnData('SocialMedia', $SocialMedia,'This SocialMedia is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $SocialMedia=SocialMedia::find($id);
        $SocialMedia->is_active=true;
        $SocialMedia->save();

        return $this->returnData('SocialMedia', $SocialMedia,'This SocialMedia is trashed Now');
    }

    public function delete($id)
    {
        $SocialMedia = SocialMedia::find($id);
        $SocialMedia->is_active = false;
        $SocialMedia->save();
        return $this->returnData('SocialMedia', $SocialMedia, 'This SocialMedia is deleted Now');

    }

}
