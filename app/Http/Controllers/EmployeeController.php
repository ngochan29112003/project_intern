<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getView()
    {
        $model = new EmployeeModel();
        $employee_list = $model->getEmployeeInfo();
        $position_list = $model->getPosition();
        $edu_level_list = $model->getEdulevel();
        $type_employee_list = $model->getTypeEmployees();
//        dd($employee_list);
        return view('auth.employees.index-employee',
            compact('employee_list', 'position_list', 'edu_level_list',
                'type_employee_list'));
    }

    public function add(Request $request)
    {
//        dd($request);
        $validated = $request->validate([
            'first_name'         => 'required|string',
            'last_name'          => 'required|string',
            'img'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576',
            'gender'             => 'required|string',
            'email'              => 'required|string',
            'cic_number'         => 'required|string',
            'birth_date'         => 'required|date',
            'birth_place'        => 'string',
            'place_of_residencs' => 'required|string',
            'permanent_address'  => 'required|string',
            'education_level_id' => 'int',
            'status'             => 'int',
            'type_employee_id'   => 'int',
            'job_position_id'    => 'int',
        ]);

        $imagePath = 'avt.png';
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/employee_img/'), $imagePath);
        }

        EmployeeModel::create(array_merge($validated, ['img' => $imagePath]));

        return response()->json([
            'success' => true,
            'status'  => 200,
            'message' => 'Employee added successfully',
        ]);
    }

    public function delete($id)
    {
        $employee = EmployeeModel::findOrFail($id);

        $directoryPath = public_path('assets/employee_img/');
        $filePath = $directoryPath . $employee->img;

        if (file_exists($filePath) && $employee->img !== 'avt.png') {
            unlink($filePath);
        }

        $employee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully'
        ]);
    }

    public function edit($id)
    {
//        dd($id);
    }
}
