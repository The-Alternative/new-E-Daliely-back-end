<?php


namespace App\Service\Brands;

use App\Models\Brands\Brands;
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

    public function __construct(Brands $brand,BrandRequest $request)
    {
        $this->BrandModel=$brand;
    }

    public function get()
    {
       $brand=$this->BrandModel::all()->where('is_active','=',1);
        return $this->returnData('brand',$brand,'done');
    }

    public function getById($id)
    {
        $brand= $this->BrandModel::find($id);
        return $this->returnData('brand',$brand,'done');
    }

    public function getTrashed()
    {
        $brand= $this->BrandModel::all()->where('is_active',0);
        return $this -> returnData('brand',$brand,'done');
    }

    public function create( BrandRequest $request )
    {
        $brand = new Brands();

        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->description = $request->description;
        $brand->image = $request->image;
        $brand->is_active = $request->is_active;

        $result = $brand->save();
        if ($result) {
            return $this->returnData('brand', $brand, 'done');
        } else {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function update(BrandRequest $request,$id)
    {
        $brand= $this->BrandModel::find($id);

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
            ->where("name", "like", "%" . $name . "%")
            ->get();
        if (!$brand) {
            return $this->returnError('400', 'not found this brand');
        } else {
            return $this->returnData('brand', $brand, 'done');

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
        $brand=Brands::find($id);
        $brand->is_active=true;
        $brand->save();

        return $this->returnData('brand', $brand,'This brand is trashed Now');
    }


    public function delete($id)
    {
        $brand = Brands::find($id);
        $brand->is_active = false;
        $brand->save();

        return $this->returnData('brand', $brand, 'This brand is deleted Now');
    }
}
