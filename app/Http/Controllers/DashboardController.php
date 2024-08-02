<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function getView(){
        $data = DB::table('account')->get();
//        dd($data);
        return view('auth.dashboard.index-dashboard',compact('data'));
    }
}
