<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\LoginModel;
use App\StaticString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function getView()
    {
        return view('auth.login');
    }

    function postLogin(Request $request)
    {
        $account = AccountModel::where('username', $request->username)->first();

        if (!$account) {
            return redirect()
                ->route('index-login')
                ->with('msg', 'Username or password is incorrect');
        }

        if (Hash::check($request->password, $account->password)) {
            $request->session()->put(StaticString::SESSION_ISLOGIN, true);
            $request->session()->put(StaticString::PERMISSION, $account->permission);
            $request->session()->put(StaticString::ACCOUNT_ID, $account->id);
            return redirect()->route('index-dashboard');
        }

        return redirect()
            ->route('index-login')
            ->with('msg', 'Username or password is incorrect');

    }

    public function logOut(Request $request){
        $request->session()->flush();
        return redirect()->route('index-login');
    }
}
