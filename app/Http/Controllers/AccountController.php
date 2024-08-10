<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    function getView()
    {
        $model_account = new AccountModel();
        $model_employee = new EmployeeModel();
        $employee_list = $model_employee->getEmployeeInfo();
        $account_list = $model_account->getAccountInfo();
        $permis_list = $model_account->getPermis();
        return view('auth.account.index-account', compact('account_list','permis_list','employee_list'));
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

    public function delete($id)
    {
        $account = AccountModel::findOrFail($id);

        $account->delete();

        return response()->json([
            'success' => true,
            'message' => 'Account deleted successfully'
        ]);
    }
    public function edit($id)
    {
        $account = AccountModel::findOrFail($id);
        return response()->json([
            'account' => $account
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'string',
            'password' => 'string',
            'permission' => 'string',
            'id_employee' => 'string',
        ]);
        $account = AccountModel::findOrFail($id);
        $account->update($validated);

        return response()->json([
            'success' => true,
            'account' => $account,
        ]);
    }
}
