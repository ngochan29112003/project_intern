<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function getView(){
        $model = new EmployeeModel();
        $employee_list = $model->getEmployee();
//        dd($employee_list);
        return view('auth.employees.index-employee',compact('employee_list'));
    }

    function add(Request $request)
    {
//        dd($request->all());
        $validated = $request->validate([
            'add_employee_name' => 'required|string',
            'add_gender' => 'required|string',
            'add_birthday' => 'required|date',
            'add_birthplace' => 'required|string',
            'add_idcard' => 'required|string',
            'add_edu' => 'required|string',
            'add_status' => 'required|string',
        ]);

        EmployeeModel::create([
            'name' => $validated['add_employee_name'],
//            'img' => $validated['add_img'],
            'gender' => $validated['add_gender'],
            'birth_date' => $validated['add_birthday'],
            'birth_place' => $validated['add_birthplace'],
            'id_card_number' => $validated['add_idcard'],
            'education_level' => $validated['add_edu'],
            'status' => $validated['add_status'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Employee added successfully',
        ]);
    }
}
