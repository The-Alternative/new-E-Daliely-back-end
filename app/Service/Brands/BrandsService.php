<?php


namespace App\Service\Brands;

use App\Models\Brands\Brands;
 use  App\Http\Controllers\LangController;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneralTrait;
use App\Http\Requests\Brands\BrandRequest;
use phpDocumentor\Reflection\Types\This;

use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;

class BrandsService
{
    private $BrandModel;
    private $lang;
    use GeneralTrait;

    public function __construct(Brands $brand)
    {

        $this->BrandModel=$brand;
    }

    public function get()
    {

<<<<<<< HEAD
       $brand=$this->BrandModel::all()->where('is_active','=',1);
        return $this->returnData('brand',$brand,'done');
=======
        return $this->BrandModel::all();
>>>>>>> 147a9d6640b5efa2eaa525babaaf6aeb77fce6d1

//        $brand=DB::table('brands')
//            ->select('brands.id','brands.slug','brands.image','brands_language.name as name','brands_language.description as description')
//            ->join('brands_language','brands_id','=','brands.id')
//            ->join('languages','languages.lang_id','=','brands_language.lang_id')
//            ->where('languages.lang_code','=','ar-SY');
<<<<<<< HEAD

        //return response()->json($brand);

=======
//
//        return response()->json($brand);
>>>>>>> 147a9d6640b5efa2eaa525babaaf6aeb77fce6d1
    }

    public function getById($id)
    {
<<<<<<< HEAD
        $brand= $this->BrandModel::find($id);
        return $this->returnData('brand',$brand,'done');

    }

    public function getTrashed()
    {
        $brand= $this->BrandModel::all()->where('is_active',0);
        return $this -> returnData('brand',$brand,'done');
    }
//
    public function create( BrandRequest $request )
    {
        $request->is_active?$is_active=true:$is_active=false;
       // $validated = $request->validated();
=======
        return $this->BrandModel::find($id);

//         Brands::find($id);
//
//        $brand=DB::table('brands')
//            ->select('brands.id','brands.slug','brands.image','brands_language.name as name','brands_language.description as description')
//            ->join('brands_language','brands_id','=','brands.id')
//            ->join('languages','languages.lang_id','=','brands_language.lang_id')
//            ->where('languages.lang_code','=','ar-SY')
//            ->get();
//
//        return response()->json($brand);
    }
//
    public function createNewBrands( BrandRequest )
    {
>>>>>>> 147a9d6640b5efa2eaa525babaaf6aeb77fce6d1

        $brand=new Brands();

        $brand->name            =$request->name;
        $brand->slug            =$request->slug;
        $brand->description     =$request->description;
        $brand->image           =$request->image;
        $brand->is_active       =$request->is_active;

        $result=$brand->save();
        if ($result)
        {
            return $this->returnData('brand', $brand,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
    }
////
    public function update(BrandRequest $request,$id)
    {
<<<<<<< HEAD
        $brand= Brands::find($request->id);
=======
        $brand= Brands::find($id);
>>>>>>> 147a9d6640b5efa2eaa525babaaf6aeb77fce6d1

        $brand->name            =$request->name;
        $brand->slug            =$request->slug;
        $brand->description     =$request->description;
        $brand->image           =$request->image;
        $brand->is_active       =$request->is_active;

        $result=$brand->save();
        if ($result)
        {
            return $this->returnData('brand', $brand,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }

    }

    public function search($name)
    {
        $brand = DB::table('brands')
            ->where("name","like","%".$name."%")
            ->get();
        if (!$brand)
        {
            return $this->returnError('400', 'not found this brand');

<<<<<<< HEAD
        }
        else
        {
            return $this->returnData('brand', $brand,'done');
=======
        $brand->is_active    =$request->is_active;
>>>>>>> 147a9d6640b5efa2eaa525babaaf6aeb77fce6d1

        }
    }


    public function trash( $id)
    {
        $brand= $this->BrandModel::find($id);
        $brand->is_active=false;
        $brand->save();
        return $this->returnData('brand', $brand,'This brand is trashed Now');
    }

    public function restoreTrashed( $id)
    {
        $brand=Product::find($id);
        $brand->is_active=true;
        $brand->save();
<<<<<<< HEAD
        return $this->returnData('Product', $brand,'This brand is trashed Now');
    }
////
    public function delet($id)
    {
        $brand = Brands::find($id);

        $brand->is_active = false;
        $brand->save();
        return $this->returnData('brand', $brand, 'This brand is deleted Now');



=======

        return response()->json($brand);
>>>>>>> 147a9d6640b5efa2eaa525babaaf6aeb77fce6d1
    }
}
