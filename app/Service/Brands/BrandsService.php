<?php


namespace App\Service\Brands;

use App\Models\Brands\Brands;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;

class BrandsService
{
    private $BrandModel;

    public function __construct(Brands $brand)
    {

        $this->BrandModel=$brand;
    }

    public function getAllBrands()
    {
        $brand= DB ::table('brands')
            ->where('is_active','=',1)
            ->get();

        return response()->json($brand);
    }

    public function getBrandsById($id)
    {
        $brand= Brands::find($id);

        return response()->json($brand);
    }
//
    public function createNewBrands($request)
    {
        $brand=new Brands();

        $brand->name            =$request->name;
        $brand->slug            =$request->slug;
        $brand->description     =$request->description;
        $brand->image           =$request->image;
        $brand->is_active       =$request->is_active;

        $brand->save();
        return response()->json($brand);
    }
//
    public function updateBrand(Request $request,$id)
    {
        $brand= Brands::find($id);

        $brand->name            =$request->name;
        $brand->slug            =$request->slug;
        $brand->description     =$request->description;
        $brand->image           =$request->image;
        $brand->is_active       =$request->is_active;

        $brand->save();
        return response()->json($brand);

    }
//
    public function deleteBrand(Request $request,$id)
    {
        $brand=Brands::find($id);

        $brand->is_active           =$request->is_active;

        $brand->save();
        return response()->json($brand);
    }
}
