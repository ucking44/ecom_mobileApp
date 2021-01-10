<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
session_start();

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.add_slider');
    }

    public function save_slider(Request $request)
    {
        $data = array();
        $data['publication_status'] = $request->publication_status;

        $image = $request->file('slider_image');
        if ($image) {
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'slider/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['slider_image'] = $image_url;

                DB::table('slider')->insert($data);
                Session::put('message', 'Slider Added Successfully!!');
                return Redirect::to('/add-slider');
            }
        }
        $data['slider_image'] = '';

            DB::table('slider')->insert($data);
                Session::put('message', 'Slider Added Successfully Without Image!!');
                return Redirect::to('/add-slider');
    }

    public function all_slider()
    {
        $all_slider = DB::table('slider')->get();
        return view('admin.all_slider', compact('all_slider'));
    }

    public function delete_slider($slider_id)
    {
        DB::table('slider')
            ->where('slider_id', $slider_id)
            ->delete();

        Session::get('message', 'Slider Deleted successfully !!');
        return Redirect::to('/all-slider');
    }

    public function unactive_slider($slider_id)
    {
        DB::table('slider')
            ->where('slider_id', $slider_id)
            ->update(['publication_status' => 0 ]);
        Session::put('message', 'Slider Unactivated successfully !!');
        return Redirect::to('/all-slider');
    }

    public function active_slider($slider_id)
    {
        DB::table('slider')
            ->where('slider_id', $slider_id)
            ->update(['publication_status' => 1 ]);
        Session::put('message', 'Slider Activated successfully !!');
        return Redirect::to('/all-slider');
    }

}

