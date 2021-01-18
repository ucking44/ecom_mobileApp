<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Manufacture;
use Session;
session_start();

class ManufactureController extends Controller
{
    public function index()
    {
        $dataM = Manufacture::paginate(4);
        return response()->json($dataM, 200);

    }

    public function manufacture_by_id($manufacture_id)
    {
        $manufacture_by_id = Manufacture::findOrFail($manufacture_id);
        return response()->json($manufacture_by_id, 200);

    }

    public function save_manufacture(Request $request)
    {
        $data = array();
        $data['manufacture_id'] = $request->manufacture_id;
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        $data['publication_status'] = $request->publication_status;

        $dataM = DB::table('manufacture')->insert($data);
        return response([
            'success' => $dataM,
            'message' => 'Manufacture Added Successfully !!',
        ]);

    }

    public function update_manufacture(Request $request, $manufacture_id)
    {
        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;

        $updateM = Manufacture::findOrFail($manufacture_id);
        $updateM->update($data);

        return response()->json($updateM, 200);

    }

    public function delete_manufacture($manufacture_id)
    {
        $deleteM = Manufacture::findOrFail($manufacture_id);
        $deleteM->delete();

        return response([
            'success' => true,
            'message' => 'Manufacture Deleted successfully !!',
        ]);

    }

    // public function unactive_manufacture($manufacture_id)
    // {
    //     DB::table('manufacture')
    //         ->where('manufacture_id', $manufacture_id)
    //         ->update(['publication_status' => 0 ]);
    //     Session::put('message', 'Manufacture Unactivated successfully !!');
    //     return Redirect::to('/all-manufacture');
    // }

    // public function active_manufacture($manufacture_id)
    // {
    //     DB::table('manufacture')
    //         ->where('manufacture_id', $manufacture_id)
    //         ->update(['publication_status' => 1 ]);
    //     Session::put('message', 'Manufacture Activated successfully !!');
    //     return Redirect::to('/all-manufacture');
    // }

    public function search($manufacture_name)
    {
        $search = Manufacture::where("manufacture_name", "like", "%" . $manufacture_name . "%")
                    ->get();
        return $search;
    }

}

