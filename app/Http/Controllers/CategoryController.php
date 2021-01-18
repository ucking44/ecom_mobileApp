<?php

namespace App\Http\Controllers;

use App\Category;
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
        $dataC = Category::paginate(4);
        return response()->json($dataC, 200);

    }

    public function category_by_id($category_id)
    {
        $category_by_id = Category::findOrFail($category_id);
        return response()->json($category_by_id, 200);

    }

    public function save_category(Request $request)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;

        $dataC = DB::table('category')->insert($data);
        //return response()->json($dataC, 201);
        return response([
            'success' => $dataC,
            'Category' => 'Category Added Successfully!',
        ]);

    }

    public function update_category(Request $request, $category_id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        $updateC = DB::table('category')
            ->where('category_id', $category_id)
            ->update($data);

        return response([
            'success' => $updateC,
            'category' => 'Category Updated Successfully!',
        ]);

    }

    public function delete_category($category_id)
    {
        $deleteC = Category::findOrFail($category_id);
        $deleteC->delete();

        return response([
            'success' => true,
            'category' => 'Category Deleted Successfully!',
        ]);

    }

    public function unactive_category($category_id)
    {
        $unactive_category = DB::table('category')
            ->where('category_id', $category_id)
            ->update(['publication_status' => 0 ]);

        return response([
            'success' => $unactive_category,
            'category' => 'Category Un-Activated Successfully!',
        ]);

    }

    public function active_category($category_id)
    {
        $active_category = DB::table('category')
            ->where('category_id', $category_id)
            ->update(['publication_status' => 1 ]);

        return response([
            'success' => $active_category,
            'category' => 'Category Activated Successfully!',
        ]);

    }

    public function search($category_name)
    {
        $search = Category::where("category_name", "like", "%" . $category_name . "%")
                    ->get();
        return $search;
    }

}
