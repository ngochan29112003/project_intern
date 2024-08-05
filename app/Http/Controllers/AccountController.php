<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    function getView()
    {

        $account = AccountModel::all();
        $model = new AccountModel();
        $model_employee = new EmployeeModel();
        $employee_list = $model_employee->getEmployeeInfo();

        $permis_list = $model->getPermis();
        return view('auth.account.index-account', compact('account','permis_list','employee_list'));
    }

    function add(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'repassword' => 'required|string',
            'permission' => 'int',
            'id_employee' => 'int'
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
        $account->id_employee = $request->id_employee;
        $account->save();

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Account added successfully']);
    }
}
