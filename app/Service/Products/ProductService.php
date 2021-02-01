<?php
namespace App\Service\Products;

// use App\Models\brand;
// use App\Models\category;
use App\Models\Custom_Fildes\Custom_Field;
use App\Http\Requests\ProductRequest;
use App\Models\Products\Product;
// use App\Store;

// use App\product_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;

class ProductService
{
private $productModel;
// private $custom;
// private $pimage;
//     private $category;
    /**
     * ProductService constructor.
     */
    public function __construct(Product $product/*,custom_field  $custom,category $category,product_image $pimage*/)
    {
        $this->productModel=$product;
        //$this->product=$product;
        // $this->custom=$custom;
        // $this->category=$category;
        // $this->pimage=$pimage;
    }
        public function getAllProducts()
        {
            return $this->productModel::all();        
        }

    

//     public function store(Request $request)
//     {
//         $request['brand_id']=(int)$request['brand_id'];
//                 $request->validate([
//             "title"          => "required:products",
//             "slug"           => "required:products",
//             "barcode"        => "required:products",
//             "productcol"     => "required:products",
//             "meta"           => "required:products",
//             "description"    => "required:products",
//         ]);
//         if ($request->is_active){
//             $is_active=true;
//         }else{
//             $is_active=false;
//         }
//         if ($request->is_appear){
//             $is_appear=true;
//         }else{
//             $is_appear=false;
//         }

//         //var_dump($request);
//         $response=$this->productModel::create([
//             'title'         => $request->title,
//             'slug'          => $request->slug,
//             'brand_id'      => $request->brand_id,
//             'barcode'       => $request->barcode,
//             'productcol'    => $request->productcol,
//             'meta'          => $request->meta,
//             'is_active'     => $is_active,
//             'is_appear'     => $is_appear,
//             'description'   => $request->description,
//         ]);
//         for ($i=0;$i<(int)$request->counter;$i++){
//             $response->customfields()->attach($request->custom_field[$i],[
//                 'value' => $request->value[$i],
//                 'description' => "sssssss",
//             ]);
//         }
//         for ($i=0;$i<(int)$request->ccounter;$i++){
//             $response->categories()->attach($request->category[$i],['description'=>$request->cdescription[$i]]);
//         }



//         for ($i = 0;$i< (int)$request->icounter;$i++){
//             $e =$i + 1;
//             if ( (int)$request->iscover == $e ){
//                 $xx[$i]=true;
//             }else{
//                 $xx[$i]=false;
//             }
//         }
//         for ($i = 0;$i< (int)$request->icounter;$i++) {

//                 $this->pimage::create([
//                     'product_id' => $response->id,
//                     'image'      =>$request->image[$i]->store('images','public'),
//                     'is_cover'   =>$xx[$i]
//                 ]);



//         }

//         session()->flash('success','product created successfuly');

//         return $request;

//     }
//     public function update(Request $request, Product $product)
//     {
// //        return $request->image[2]->store();
//         $request['brand_id']=(int)$request['brand_id'];
//         $product->brand_id=(int)$request['brand_id'];
//         $links=[];
//         for($i=0;$i<$request->counter;$i++){
//             $links[$request->custom_field[$i]] = ['value'=>$request->value[$i],'description'=>'ttttt'];
//         }
//             $product->customfields()->sync($links);
//         $clinks=[];
//         for($i=0;$i<$request->ccounter;$i++){
//             $clinks[$request->category[$i]] = ['description'=>$request->cdescription[$i]];
//         }
//         $product->categories()->sync($clinks);

// //        for ($i = 0;$i< (int)$request->icounter;$i++){
// //            $e =$i + 1;
// //            if ( (int)$request->iscover == $e ){
// //                $xx[$i]=true;
// //            }else{
// //                $xx[$i]=false;
// //            }
// //        }
// //        for ($i = 0;$i< (int)$request->icounter;$i++) {
// //
// //                $this->pimage::create([
// //                    'product_id' => $product->id,
// //                    'image'      =>$request->image[$i]->store('images','public'),
// //                    'is_cover'   =>$xx[$i]
// //                ]);
// //                Storage::disk('public')->delete($this->pimage->image);
// //
// //
// //
// //
// //
// //        }

//         if ($request->is_active){
//             $is_active=true;
//         }else{
//             $is_active=false;
//         }
//         if ($request->is_appear){
//             $is_appear=true;
//         }else{
//             $is_appear=false;
//         }
//         $response=$product->update([
//             'title'             => $request->title,
//             'slug'              => $request->slug,
//             'brand_id'          => $request->brand_id,
//             'barcode'           => $request->barcode,
//             'productcol'        => $request->productcol,
//             'meta'              => $request->meta,
//             'is_active'         => $is_active,
//             'is_appear'         => $is_appear,
//             'description'       => $request->description,
//         ]);
//         if($response=true){
//             return "success";
//         }else{
//             return "faild";
//         }
//     }

//     public function index(){
//         return view('products.index')->with('products',product::all()->where('is_active',true));

//     }

//     public function create(){
//         return view('products.create')->with('brands',brand::all())->with('custom_fields',custom_field::all()->where('is_active',true))->with('categories',category::all()->where('is_active',true));

//     }

//     public function edit($product){
//         return view('products.edit',[
//             'product' => $product,
//             'brands'  => brand::all(),
//             'custom_fields' => custom_field::all(),
//             'categories' => category::all(),
//             'pimages' => product_image::all()->where('product_id',$product->id)
//         ]);
//     }

//     public function delete(Product $product){
//         session()->flash('success','product deleted successfuly');
//         $response=$product->update([
//             'is_appear' => false,
//             'is_active' => false
//         ]);
//         return redirect(route('products.index'));
//     }
// //    public function storeProductCustomField(int $productId,Request $request)
// //    {
// //        $this->customField->product=product::find($productId);
// //        return $this->customField;
// //    }
//     public function Products()
//         {
//             $response=$this->productModel::all();
//             return $response;
//         }
//     public function appearProducts()
//         {
//             $res=$this->productModel::all()->where('is_appear',1);
//             return $res;
//         }
//     public function productsByCategory($category_id)
//     {
//       //  $product_ids=DB::table('product_categories')->select('product_id')->where('category_id',$category_id)->get();
//         $product_ids= $this->pcategory->ById($category_id);
//         $i=0;
//         foreach ($product_ids as $product_id){
//             $ids[$i]=$product_id->product_id;
//             $i++;

//         }

//         $res1=$this->productModel::all()->whereIn('id',$ids)->where('is_appear',1);
//         return $res1;
//     }
//     public function productDetails($id){
//         $response=$this->productModel::all()->where('id',$id);
//         return $response;
//     }

}
