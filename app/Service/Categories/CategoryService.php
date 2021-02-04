<?php


namespace App\Service\Categories;


use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\Category;
use Illuminate\Http\Response;


use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class CategoryService
{
    private $CategoryModel;

    public function __construct(Category $category)
    {
        $this->CategoryModel = $category;
        
    }

    public function get($id=null)
    {

        $response= $id?Category::find($id):Category::all();
          return $this -> returnData('categories',$response,'done')
          ->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', '*');
        
    }
    public function create(Request $request)
    {
       
        if ($request->is_active)
        {
            $is_active=true;
        }
        else
        {
            $is_active=false;
        }
       
        $category= new Category;
        $category->name= $request->name;
        $category->slug= $request->slug;
        $category->is_active= $is_active;
        $category->parent_id= (int)$request->parent;
        $category->image= $request->image->store('images','public');
        $result=$category->save();
        if ($result)
        {
            return $this->returnData('categroy', $category,'done');
        }
        else
        {
           return $this->returnError('400', 'saving failed');
        }
    }

    public function update(Request $request)
    {
        $category=Category::find($request->$id);
        $category->name= $request->name;
        $category->slug= $request->slug;
        $category->is_active= $is_active;
        $category->parent_id= (int)$request->parent;
        $category->image= $request->image->store('images','Public');
        $result=$category->save();
        if ($result)
        {
            return $this->returnData('categroy', $category,'done');
        }
        else
        {
           return $this->returnError('400', 'updating failed');
        }

    }

    public function search($name)
    {
        $result= Category::where("name","like","%".$name."%")->get();
        if ($result==null)

            return $this->returnError('400', 'not found this category');

            return $this->returnData('categroy', $result,'done');

    }


}
  