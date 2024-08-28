<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BhxhController extends Controller
{
    function getView()
    {
        return view('auth.bhxh.index-bhxh');
    }
}
