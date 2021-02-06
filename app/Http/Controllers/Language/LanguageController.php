<?php

namespace App\Http\Controllers\Language;

use App\Models\Language\Language;
use App\Http\controllers\controller;
use App\Service\languages\LanguageService;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class LanguageController extends Controller
{
    private $LanguagesService;

    public function __construct(LanguageService $LanguagesService)
    {

        $this->LanguagesService=$LanguagesService;
    }

    public function getAllLanguage()
    {
        $response=$this->LanguagesService->getAllLanguage();
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }

    public function getLanguageById($id)
    {
        $response=$this->LanguagesService->getLanguageById($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
//
    public function createNewLanguage(Request $request)
    {
        $response=$this->LanguagesService->createNewLanguage($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function updateLanguage(Request $request,$id)
    {
        $response=$this->LanguagesService->updateLanguage($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
//
    public function deleteLanguage(Request $request ,$id)
    {
        $response=$this->LanguagesService->deleteLanguage($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
