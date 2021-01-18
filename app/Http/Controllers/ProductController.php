<?php

namespace App\Http\Controllers;

use App\Product;
use JWTAuth;
//use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
session_start();

class ProductController extends Controller
{
    protected $user;

    /**
     * The attributes that is for user authentication
     *
     *
     */
    // public function __construct()
    // {
    //     $this->user = JWTAuth::parseToken()->authenticate();
    // }

    public function __construct()
    {
        $this->middleware('auth.role:admin');
        //$this->middleware('auth.role:admin', ['except' => ['index']]);
    }

    /**
     * The attributes that is for all products
     *
     *
     */


    public function index()
    {
        return $this->user = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                   ->paginate(4);
                   //->toArray();
                   //->get();

    }

    // public function index()
    // {
    //     $products = Product::with('user:id,name')
    //         ->withCount('reviews')
    //         ->latest()
    //         ->paginate(20);
    //     return response()->json(['products' => $products]);
    // }

    public function show($product_id)
    {
        $product = Product::findOrFail($product_id);
        return response()->json($product, 200);

    }

    // public function show(Product $product)
    // {
    //     $product->load(['reviews' => function ($query) {
    //         $query->latest();
    //     }, 'user']);
    //     return response()->json(['product' => $product]);
    // }


    public function save_product(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['user_id'] = $request->user_id;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['publication_status'] = $request->publication_status;

        $image = $request->file('product_image');
        if ($image) {
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['product_image'] = $image_url;

                $dataP = DB::table('products')->insert($data);
                return response()->json([
                    'success' => $dataP,
                    'product' => 'Product added successfully!',
                ], 201);

            }
        }

        $data['product_image'] = '';

        $dataP = DB::table('products')->insert($data);
        return response()->json([
            'success' => $dataP,
            'product' => 'Product added successfully!',
            'message' => 'Image could not be added',
        ], 201);

    }

    public function update_product(Request $request, $product_id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['user_id'] = $request->user_id;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['publication_status'] = $request->publication_status;

        $updateP = Product::findOrFail($product_id);
        $updateP->update($data);

        return response([
            'success' => $updateP,
            'message' => 'Product Updated Successfully !!',
        ]);

    }

    public function delete_product($product_id)
    {
        $deleteP = Product::findOrFail($product_id);
        $deleteP->delete();

        return response()->json(null, 204);

        // return response([
        //     'success' => true,
        //     'product' => 'Product Deleted Successfully!',
        // ]);

    }

    public function unactive_product($product_id)
    {
        $unactive_product = DB::table('products')
            ->where('product_id', $product_id)
            ->update(['publication_status' => 0 ]);

        return response([
            'success' => $unactive_product,
            'product' => 'Product Unactivated Successfully!',
        ]);

    }

    public function active_product($product_id)
    {
        $active_product = DB::table('products')
            ->where('product_id', $product_id)
            ->update(['publication_status' => 1 ]);

        return response([
            'success' => $active_product,
            'product' => 'Product Unactivated Successfully!',
        ]);

    }

    public function search($product_name)
    {
        // $search = DB::table('products')
        //         ->where("product_name", "like", "%" . $product_name . "%")
        //         ->get();

        $search = Product::where("product_name", "like", "%" . $product_name . "%")
                    ->get();
        return $search;
    }
}


