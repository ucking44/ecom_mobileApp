<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
session_start();

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.add_product');
    }

    public function all_product()
    {
        $all_product_info = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                   ->get();
        return view('admin.all_product', compact('all_product_info'));
    }

    public function save_product(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
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

                DB::table('products')->insert($data);
                Session::put('message', 'Product Added Successfully!!');
                return Redirect::to('/add-product');
            }
        }
        $data['product_image'] = '';

            DB::table('products')->insert($data);
                Session::put('message', 'Product Added Successfully Without Image!!');
                return Redirect::to('/add-product');
    }

    public function delete_product($product_id)
    {
        DB::table('products')
            ->where('product_id', $product_id)
            ->delete();

        Session::get('message', 'Product Deleted successfully !!');
        return Redirect::to('/all-product');
    }

    public function unactive_product($product_id)
    {
        DB::table('products')
            ->where('product_id', $product_id)
            ->update(['publication_status' => 0 ]);
        Session::put('message', 'Product Unactivated successfully !!');
        return Redirect::to('/all-product');
    }

    public function active_product($product_id)
    {
        DB::table('products')
            ->where('product_id', $product_id)
            ->update(['publication_status' => 1 ]);
        Session::put('message', 'Product Activated successfully !!');
        return Redirect::to('/all-product');
    }

}
