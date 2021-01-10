<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Redirect;
//use App\Http\Requests;
use Session;
//session_start();

class HomeController extends Controller
{
    public function index()
    {
        $all_published_product = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                   ->where('products.publication_status', 1)
                   ->limit(9)
                   ->get();
        return view('pages.home_content', compact('all_published_product'));

        //return view('pages.home_content');
    }

    public function show_product_by_category($category_id)
    {
        $product_by_category = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   //->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name')
                   ->where('category.category_id', $category_id)
                   ->where('products.publication_status', 1)
                   ->limit(10)
                   ->get();
        return view('pages.category_by_products', compact('product_by_category'));

    }

    public function show_product_by_manufacture($manufacture_id)
    {
        $product_by_manufacture = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                   ->where('manufacture.manufacture_id', $manufacture_id)
                   ->where('products.publication_status', 1)
                   ->limit(18)
                   ->get();
        return view('pages.manufacture_by_products', compact('product_by_manufacture'));

    }

    public function product_details_by_id($product_id)
    {
        $product_by_details = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                   ->where('products.product_id', $product_id)
                   ->where('products.publication_status', 1)
                   ->first();
                   //->limit(18)
                   //->get();
        return view('pages.product_details', compact('product_by_details'));

    }

}
