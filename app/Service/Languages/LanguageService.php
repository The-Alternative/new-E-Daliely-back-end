<?php

namespace App\Service\Languages;

use App\Traits\GeneralTrait;
use App\Http\Requests\LanguageRequest;
use App\Models\Language\Language;
<<<<<<< HEAD
use App\Models\Products\Product;
=======
use Illuminate\Http\JsonResponse;
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
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

        $this->LanguageModel = $language;
    }

<<<<<<< HEAD
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
=======
        /*__________________________________________________________________*/
    /**** Get All Active Language   ****/
    public function get()
    {
        $language = Language::selectActiveValue()->selection();
        return $this->returnData('language',$language,'done');
    }
        /*__________________________________________________________________*/
    /**** Get Active Language By ID  ****/
    public function getById(/*Request $request,*/ $id)
    {
        $language = Language::selectActiveValue()->find($id);
        return $this->returnData('language',$language,'done');
    }

        /*__________________________________________________________________*/
    /****  Create Language   ***/
    public function create(LanguageRequest $request)
    {
        try {
            $request->is_active ? $is_active = true : $is_active = false;
            $validated = $request->validated();
            $language = Language::create($request->except(['__token']));
            return $this->returnData('Language', $language, 'done');
        } catch (\Exception $ex) {
            return $this->returnError('400', 'saving failed');
        }
    }

        /*__________________________________________________________________*/
    /****  Update Product   ***
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(LanguageRequest $request, $id)
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
    {
        try {
            $validated = $request->validated();
            $language = Language::selectActiveValue()->find($id);
            $language->update($request->all());
            return $this->returnData('Language', $language, 'done');
        } catch (\Exception $ex) {
            return $this->returnError('400', 'updated failed');
        }
    }

        /*__________________________________________________________________*/
    /****ــــــThis Functions For Trashed Productsــــــ  ****/
    /****Get All Trashed Products Or By ID  ****/

<<<<<<< HEAD
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
=======
    public function getTrashed()
    {
        $language = Language::where('is_active',0)->get();
        return $this->returnData('Language',$language,'done');
    }

        /*__________________________________________________________________*/
    /****Restore Products Fore Active status  ****/
    public function restoreTrashed($id)
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
    {
        $language = Language::where('is_active',0)->find($id);
        $language->is_active = true;
        $language->save();
        return $this->returnData('language',$language,'This language Is trashed Now');
    }

<<<<<<< HEAD
        $result=$language->save();
        if ($result)
        {
            return $this->returnData('language', $language,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
=======
    /****   Product's Soft Delete   ***/
    public function trash($id)
    {
        $language = Language::where('is_active',1)->find($id);
        $language->is_active = false;
        $language->save();
        return $this->returnData('language',$language,'This language Is trashed Now');
    }
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f

            /*__________________________________________________________________*/
    /****  ٍsearch for Product   ****/
    public function search($title)
    {
        $language = Language::searchTitle();
        if (!$language) {
            return $this->returnError('400', 'not found this Product');
        } else {
            return $this->returnData('Language', $language, 'done');
        }
    }
<<<<<<< HEAD
////
    public function delete(Request $request,$id)
=======
    
            /*__________________________________________________________________*/
    /****  Delete Product   ***/
    public function delete($id)
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
    {
        try {
            $language = Language::find($id);
            $language->delete($id);
            return $this->returnData('Language', $language, 'done');
        } catch (\Exception $ex) {
            return $this->returnError('400', 'deleting failed');
        }
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
