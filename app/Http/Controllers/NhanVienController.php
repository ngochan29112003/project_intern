<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    function getView(){
        return view('auth.nhanvien.index-nhanvien');
    }
}
