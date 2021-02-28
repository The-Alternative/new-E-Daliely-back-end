<?php


namespace App\Service\Languages;

use App\Models\Language\Language;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use App\Traits\GeneralTrait;
use App\Http\Requests\Language\LanguageRequest;


class LanguageService
{
    use GeneralTrait;
    private $LanguageModel;


    public function __construct(Language $language)
    {

        $this->LanguageModel=$language;
    }

    public function get()
    {
      $language=$this->LanguageModel::all()->where('is_active','=',1);

      return $this->returnData('Language',$language,'done');
    }

    public function getById($id)
    {
        $language= $this->LanguageModel::find($id);

        return $this->returnData('Language',$language,'done');
    }

    public function create($request)
    {
        $language=new Language();

        $language->lang_id                  =$request->lang_id ;
        $language->name                     =$request->name;
        $language->active                   =$request->active;
        $language->iso_code                 =$request->iso_code ;
        $language->lang_code                =$request->lang_code ;
        $language->locale                   =$request->locale ;
        $language->date_format_lite         =$request->date_format_lite  ;
        $language->date_format_full         =$request->date_format_full  ;
        $language->is_rtl                   =$request->is_rtl;

        $result=$language->save();
        if ($result)
        {
            return $this->returnData('language', $language,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function update(LanguageRequest $request,$id)
    {
        $language= Language::find($id);

        $language->lang_id                  =$request->lang_id ;
        $language->name                     =$request->name;
        $language->active                   =$request->active;
        $language->iso_code                 =$request->iso_code ;
        $language->lang_code                =$request->lang_code ;
        $language->locale                   =$request->locale ;
        $language->date_format_lite         =$request->date_format_lite  ;
        $language->date_format_full         =$request->date_format_full  ;
        $language->is_rtl                   =$request->is_rtl;

        $result=$language->save();
        if ($result)
        {
            return $this->returnData('language', $language,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }

    }
////
    public function delete(Request $request,$id)
    {
        $language=Language::find($id);

        $language->active           =$request->active;

        $language->save();
        return response()->json($language);
    }


    public function getTrashed()
    {
        $language=$this->LanguageModel::all()->where('is_active',0);
        return $this -> returnData('Language',$language,'done');
    }


    public function restoreTrashed( $id)
    {
        $language=$this->LanguageModel::find($id);
        $language->is_active=true;
        $language->save();
        return $this->returnData('language', $language,'This language Is trashed Now');
    }

    public function trash( $id)
    {
        $language= $this->LanguageModel::find($id);
        $language->is_active=false;
        $language->save();
        return $this->returnData('language', $language,'This language Is trashed Now');
    }

    public function search($name)
    {
        $language = DB::table('languages')
            ->where("name","like","%".$name."%")
            ->get();
        if (!$language)
        {
            return $this->returnError('400', 'not found this language');

        }
        else
        {
            return $this->returnData('language', $language,'done');

        }
    }
}
