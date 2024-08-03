<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function getView(){
        $data = DB::table('accounts')->get();
        return view('auth.dashboard.index-dashboard',compact('data'));
    }
}
