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
//        dd($request->all());
        $validated = $request->validate([
            'add_department_name' => 'required|string',
            'add_department_code' => 'required|string',
        ]);

        DepartmentModel::create([
            'department_name' => $validated['add_department_name'],
            'department_code' => $validated['add_department_code'],
        ]);

       return response()->json([
           'success' => true,
           'status' => 200,
           'message' => 'Department added successfully',
       ]);
   }

    public function delete($id)
    {
        $department = DepartmentModel::findOrFail($id);

        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reward deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $department = DepartmentModel::findOrFail($id);
        return response()->json([
            'department' => $department
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'department_code' => 'string',
            'department_name' => 'string',
        ]);
        $department = DepartmentModel::findOrFail($id);
        $department->update($validated);

        return response()->json([
            'success' => true,
            'department' => $department,
        ]);
    }
}
