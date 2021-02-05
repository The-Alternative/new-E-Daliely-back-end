<?php


namespace App\Service\Languages;

use App\Models\Language\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;

class LanguageService
{

    private $LanguageModel;

    public function __construct(Language $language)
    {

        $this->LanguageModel=$language;
    }

    public function getAllLanguage()
    {
        $language= DB ::table('Languages')->get();

        return response()->json($language);
    }

    public function getLanguageById($id)
    {
        $language= Language::find($id);

        return response()->json($language);
    }

    public function createNewLanguage($request)
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

        $language->save();
        return response()->json($language);
    }

    public function updateLanguage(Request $request,$id)
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

        $language->save();
        return response()->json($language);

    }
//
//    public function deleteLanguage(Request $request,$id)
//    {
//        $language=Language::find($id);
//
//        $language->active           =$request->active;
//
//        $language->save();
//        return response()->json($language);
//    }
}
