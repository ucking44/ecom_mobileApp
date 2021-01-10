<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
session_start();

class SuperAdminController extends Controller
{
    public function logout()
    {
        Session::put('admin_name', null);
        Session::put('id', null);
        Redirect::to('/admin');
    }
}
