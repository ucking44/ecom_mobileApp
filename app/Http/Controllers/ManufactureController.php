<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
session_start();

class ManufactureController extends Controller
{
    public function index()
    {
        return view('admin.add_manufacture');
    }

    public function save_manufacture(Request $request)
    {
        $data = array();
        $data['manufacture_id'] = $request->manufacture_id;
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        $data['publication_status'] = $request->publication_status;

        DB::table('manufacture')->insert($data);
        Session::put('message', 'Manufacture added successfully !!');
        return Redirect::to('/add-manufacture');
    }

    public function all_manufacture()
    {
        $all_manufacture_info = DB::table('manufacture')->get();
        return view('admin.all_manufacture', compact('all_manufacture_info'));
    }

    public function delete_manufacture($manufacture_id)
    {
        DB::table('manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->delete();

        Session::get('message', 'Manufacture Deleted successfully !!');
        return Redirect::to('/all-manufacture');
    }

    public function unactive_manufacture($manufacture_id)
    {
        DB::table('manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status' => 0 ]);
        Session::put('message', 'Manufacture Unactivated successfully !!');
        return Redirect::to('/all-manufacture');
    }

    public function active_manufacture($manufacture_id)
    {
        DB::table('manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status' => 1 ]);
        Session::put('message', 'Manufacture Activated successfully !!');
        return Redirect::to('/all-manufacture');
    }

    public function edit_manufacture($manufacture_id)
    {
        $manufacture_info = DB::table('manufacture')
                           ->where('manufacture_id', $manufacture_id)
                           ->first();

        return view('admin.edit_manufacture', compact('manufacture_info'));
    }

    public function update_manufacture(Request $request, $manufacture_id)
    {
        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;

        DB::table('manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update($data);

        Session::get('message', 'Manufacture Updated successfully !!');
        return Redirect::to('/all-manufacture');
        
    }
}

