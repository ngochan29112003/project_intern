<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
   function getView(){
       $model = new DepartmentModel();
       $department_list = $model->getDepartment();
//       dd($department_list);
       return view('auth.department.index-department',compact('department_list'));
   }

    function add(Request $request)
    {
        $validated = $request->validate([
            'add_department_code' => 'required|string',
            'add_department_name' => 'required|string',
            'add_description' => 'required|string',
            'add_created_by' => 'required|string',
            'add_created_date' => 'required|date',
            'add_updated_by' => 'required|string',
            'add_updated_date' => 'required|date',
        ]);

        DepartmentModel::create([
            'department_code' => $validated['add_department_code'],
            'department_name' => $validated['add_department_name'],
            'description' => $validated['add_description'],
            'created_by' => $validated['add_created_by'],
            'created_date' => $validated['add_created_date'],
            'updated_by' => $validated['add_updated_by'],
            'updated_date' => $validated['add_updated_date'],
        ]);


       return response()->json([
           'success' => true,
           'status' => 200,
           'message' => 'Department added successfully',
       ]);
   }
}
