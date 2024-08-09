<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function getView()
    {
        return view('auth.profile');
    }
}
