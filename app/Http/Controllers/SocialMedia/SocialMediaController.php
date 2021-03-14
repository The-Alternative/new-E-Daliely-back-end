<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMedia\SocialMediaRequest;
use App\Service\SocialMedia\SocialMediaService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialMediaController extends Controller
{
    use GeneralTrait;
    private $SocialMediaService;
    private $response;

    public function __construct(SocialMediaService $SocialMediaService,Response $response )
    {
        $this->SocialMediaService=$SocialMediaService;
        $this->response=$response;
    }
    public function get()
    {

        $response=$this->SocialMediaService->get();
        return $response;
    }

    public function  getById($id)
    {

        $response=$this->SocialMediaService->getById($id);
        return $response;
    }

    public function getTrashed()
    {
        $response= $this->SocialMediaService->getTrashed();
        return $response;

    }

    public function create(SocialMediaRequest $request)
    {
        $response=$this->SocialMediaService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(SocialMediaRequest $request,$id)
    {
        $response=$this->SocialMediaService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
//    public function search($name)
//    {
//        $response= $this->SocialMediaService->search($name);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }

    public function trash($id)
    {
        $response= $this->SocialMediaService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->SocialMediaService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response=$this->SocialMediaService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }


}
