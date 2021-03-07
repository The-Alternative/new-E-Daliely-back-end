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

    use GeneralTrait;

    public function __construct(Brands $brand)
    {

        $this->BrandModel=$brand;
    }

    public function get()
    {

        return $this->BrandModel::all();
<<<<<<< HEAD


       $brand=$this->BrandModel::all()->where('is_active','=',1);
        return $this->returnData('brand',$brand,'done');

=======

//        $brand=DB::table('brands')
//            ->select('brands.id','brands.slug','brands.image','brands_language.name as name','brands_language.description as description')
//            ->join('brands_language','brands_id','=','brands.id')
//            ->join('languages','languages.lang_id','=','brands_language.lang_id')
//            ->where('languages.lang_code','=','ar-SY');
//
//        return response()->json($brand);
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
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

    public function create( BrandRequest $request ,$id)
    {

        return $this->BrandModel::find($id);

    }

    public function createNewBrands( BrandRequest $request)
    {

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
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f

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
<<<<<<< HEAD


    public function update(BrandRequest $request,$id)
    {

        $brand= $this->BrandModel::find($id);
=======
//
    public function updateBrand(Request $request,$id)
    {
        $brand= Brands::find($id);
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f

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
        }
        else
        {
            return $this->returnData('brand', $brand,'done');

        }
    }

<<<<<<< HEAD
=======
        $brand->is_active    =$request->is_active;
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f

    public function trash( $id)
    {
        $brand= $this->BrandModel::find($id);
        $brand->is_active=false;
        $brand->save();
<<<<<<< HEAD
        return $this->returnData('brand', $brand,'This brand is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $brand=Product::find($id);
        $brand->is_active=true;
        $brand->save();

        return $this->returnData('Product', $brand,'This brand is trashed Now');
    }

    public function delet($id)
    {
        $brand = Brands::find($id);
        $brand->is_active = false;
        $brand->save();
        return $this->returnData('brand', $brand, 'This brand is deleted Now');


=======

        return response()->json($brand);
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
    }
}
