<?php

namespace App\Http\Controllers\Language;

use App\Models\Language\Language;
use App\Http\controllers\controller;
use App\Service\languages\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\GeneralTrait;
use App\Http\Requests\Language\LanguageRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class LanguageController extends Controller
{
    use GeneralTrait;
    private $LanguagesService;
    private $response;

    public function __construct(LanguageService $LanguagesService,Response $response)
    {
        $this->LanguagesService=$LanguagesService;
        $this->response=$response;
    }

    public function get()
    {
        $response=$this->LanguagesService->get();
        return  $response;


    }

    public function getById($id)
    {
        $response=$this->LanguagesService->getById($id);
        return  $response;
    }

    public function create(LanguageRequest  $request)
    {
        $response=$this->LanguagesService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(LanguageRequest $request,$id)
    {
        $response=$this->LanguagesService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }

    public function delete(LanguageRequest $request ,$id)
    {
        $response=$this->LanguagesService->delete($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function getTrashed()
    {
        $response= $this->LanguagesService->getTrashed();
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->LanguagesService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function trash($id)
    {
        $response= $this->LanguagesService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function search($name)
    {
        $response= $this->LanguagesService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
}
