<?php

namespace App\Http\Controllers\Language;

use App\Http\Requests\LanguageRequest;
use App\Models\Language\Language;
use App\Http\controllers\controller;
use App\Service\languages\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\GeneralTrait;
use App\Http\Requests\Language\LanguageRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class LanguageController extends Controller
{
    use GeneralTrait;
<<<<<<< HEAD
=======
    private $response;
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
    private $LanguagesService;
    private $response;

<<<<<<< HEAD
    public function __construct(LanguageService $LanguagesService,Response $response)
    {
=======
    public function __construct(LanguageService $LanguagesService,Response  $response)
    {
        $this->response=$response;
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
        $this->LanguagesService=$LanguagesService;
        $this->response=$response;
    }

    public function get()
    {
<<<<<<< HEAD
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
=======
        $response= $this->LanguagesService->get();
        return $response;
    }
    public function getById($id )
    {
        $response= $this->LanguagesService->getById($id);
        return $response;
    }
    public function getTrashed()
    {
        $response= $this->LanguagesService->getTrashed();
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function create(LanguageRequest $request)
    {
        $response= $this->LanguagesService->create($request);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function update(LanguageRequest $request,$id)
    {
        $response= $this->LanguagesService->update($request,$id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function search($title)
    {
        $response= $this->LanguagesService->search($title);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function trash($id)
    {
        $response= $this->LanguagesService->trash($id);
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
<<<<<<< HEAD

=======
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
    public function restoreTrashed($id)
    {
        $response= $this->LanguagesService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
<<<<<<< HEAD
    public function trash($id)
    {
        $response= $this->LanguagesService->trash($id);
=======
    public function delete($id)
    {
        $response= $this->LanguagesService->delete($id);
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

<<<<<<< HEAD
    public function search($name)
    {
        $response= $this->LanguagesService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
=======
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
}
