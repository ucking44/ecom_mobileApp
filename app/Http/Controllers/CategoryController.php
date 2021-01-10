<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
session_start();

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.add_category');
    }

    public function all_category()
    {
        $all_category_info = DB::table('category')->get();
        return view('admin.all_category', compact('all_category_info'));
        // $manage_category = view('admin.all_category')
        //     ->with('all_category_info', $all_category_info);
        // return view('admin.all_category')
        //     ->with('admin.all_category', $manage_category);

        // $all_category_info = DB::table('category')->get();
        // $manage_category = view('admin.all_category')
        //     ->with('all_category_info', $all_category_info);
        // return view('admin_layout')
        //     ->with('admin.all_category', $manage_category);
    }

    public function save_category(Request $request)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;

        DB::table('category')->insert($data);
        Session::put('message', 'Category added successfully !!');
        return Redirect::to('/add-category');
    }

    public function unactive_category($category_id)
    {
        DB::table('category')
            ->where('category_id', $category_id)
            ->update(['publication_status' => 0 ]);
        Session::put('message', 'Category Unactivated successfully !!');
        return Redirect::to('/all-category');
    }

    public function active_category($category_id)
    {
        DB::table('category')
            ->where('category_id', $category_id)
            ->update(['publication_status' => 1 ]);
        Session::put('message', 'Category Activated successfully !!');
        return Redirect::to('/all-category');
    }

    public function edit_category($category_id)
    {
        $category_info = DB::table('category')
                           ->where('category_id', $category_id)
                           ->first();

        return view('admin.edit_category', compact('category_info'));
    }

    public function update_category(Request $request, $category_id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        DB::table('category')
            ->where('category_id', $category_id)
            ->update($data);

        Session::get('message', 'Category Updated successfully !!');
        return Redirect::to('/all-category');
        
    }

    public function delete_category($category_id)
    {
        DB::table('category')
            ->where('category_id', $category_id)
            ->delete();

        Session::get('message', 'Category Deleted successfully !!');
        return Redirect::to('/all-category');
    }
}
