<?php

namespace App\Http\Controllers\Product;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Models\Products\product;
use App\Service\Products\ProductService;



// use App\brand;
// use App\category;
// use App\custom_field;




// use App\product_image;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    use GeneralTrait;
    private $ProductService;
    private $response;

     /* ProductsController constructor.
     */
    public function __construct(ProductService $ProductService,Response  $response)
    {
        $this->ProductService=$ProductService;
        $this->response=$response;
    }

    public function getAllProducts()
        {
         $response= $this->ProductService->getAllProducts();
         return response($response, 200)
                     ->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', '*');
        }
//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      *
//      */
//     public function store(Request $request)
//     {
//        return $this->productService->store($request);
//     }

//     /**
//      * Display the specified resource.
//      *
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         return $this->productService->productDetails($id);
//     }
//     /**
//      * Display the specified resource.
//      *
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function get_by_category($category_id)
//     {
//         return $this->productService->productsByCategory($category_id);

//     }
//     /**
//      *
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function get_all()
//     {
//      return $this->productService->appearProducts();
//     }
//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit(Product $product)
//     {
// //<<<<<<< HEAD
//         return $this->productService->edit($product);
// //=======
//         return view('products.create')
//         ->with('product',$product)
//         ->with('brands',brand::all())
//         ->with('custom_fields',custom_field::all())
//         ->with('pcustoms',product_customfield::all()
//         ->where('product_id',$product->id))
//         ->with('categories',category::all())
//         ->with('pcategories',product_category::all()
//         ->where('product_id',$product->id));
// //>>>>>>> aca03b873f07700450f968bca908c7aae4a68b51
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, Product $product)
//     {
//         return $this->productService->update($request,$product);
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy(Product $product)
//     {
//         return $this->productService->delete($product);


//     }
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         return $this->productService->index();
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
// //<<<<<<< HEAD
//         return $this->productService->create();
// //=======
//         return view('products.create')
//         ->with('brands',brand::all())
//         ->with('custom_fields',custom_field::all())
//         ->with('categories',category::all());
// //>>>>>>> aca03b873f07700450f968bca908c7aae4a68b51
//     }



}
