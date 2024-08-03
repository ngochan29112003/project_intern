<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    function getView()
    {
        $account = AccountModel::all();

        return view('auth.account.index-account', compact('account'));
    }

    function add(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'repassword' => 'required|string',
            'permission' => 'required|int',
        ]);

        if($request->password != $request->repassword){
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => 'Re-password not match with password',
            ]);
        }
        // Băm mật khẩu
        $hashedPassword = Hash::make($request->password);

        // Tạo tài khoản mới và lưu vào cơ sở dữ liệu
        $account = new AccountModel();
        $account->username = $request->username;
        $account->password = $hashedPassword;
        $account->permission = $request->permission;
        $account->save();

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Account added successfully']);
    }
}
