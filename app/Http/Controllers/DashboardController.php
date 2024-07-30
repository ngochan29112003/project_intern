<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function getView(){
        return view('auth.dashboard.index-dashboard');
    }
}
