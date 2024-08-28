<?php

namespace App\Http\Controllers;

use App\Models\BhxhModel;
use Illuminate\Http\Request;

class BhxhController extends Controller
{
    function getView()
    {
        $bhxh_list = BhxhModel::all();
        return view('auth.bhxh.index-bhxh', compact('bhxh_list'));
    }
}
