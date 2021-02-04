<?php

namespace App\Http\Controllers\Category;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\Category;
use App\Service\Categories\CategoryService;
use Illuminate\Http\Response;


use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CategoriesController extends Controller
{
    use GeneralTrait;
    private $Category;
    private $CategoryService;
    private $response;

    public function __construct(Category $category, CategoryService $CategoryService,Response  $response)
     {
        $this->CategoriyService=$CategoryService;
        $this->response=$response;
    //    $this->$Category=$CategoryModel;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function get()
    {
     $response= $this->CategoriyService->get($id=null);
     return response($response, 200)
                 ->header('Access-Control-Allow-Origin', '*')
                 ->header('Access-Control-Allow-Methods', '*');
    }


    public function create(Request $request)
    {
        $response= $this->CategoriyService->create($request);
        return response($response, 200)
                 ->header('Access-Control-Allow-Origin', '*')
                 ->header('Access-Control-Allow-Methods', '*');
    }


    public function update(Request $request)
    {
        $response= $this->CategoriyService->update($request);
        return response($response, 200)
                 ->header('Access-Control-Allow-Origin', '*')
                 ->header('Access-Control-Allow-Methods', '*');
    }


    public function search(Request $request)
    {
        $response= $this->CategoriyService->search($request);
        return response($response, 200)
                 ->header('Access-Control-Allow-Origin', '*')
                 ->header('Access-Control-Allow-Methods', '*');
    }

}