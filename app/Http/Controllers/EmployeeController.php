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
        $department_list = $model->getDepartment();
//        dd($employee_list);
        return view('auth.employees.index-employee',
            compact('employee_list',
                'position_list',
                'edu_level_list',
                'type_employee_list',
                'department_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'first_name'         => 'required|string',
            'last_name'          => 'required|string',
            'img'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576',
            'gender'             => 'required|string',
            'email'              => 'required|string',
            'cic_number'         => 'required|string',
            'birth_date'         => 'required|date',
            'birth_place'        => 'string',
            'place_of_resident' => 'required|string',
            'permanent_address'  => 'required|string',
            'education_level_id' => 'int',
            'status'             => 'int',
            'type_employee_id'   => 'int',
            'job_position_id'    => 'int',
            'department_id'      => 'int',
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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name'         => 'string',
            'last_name'          => 'string',
            'gender'             => 'string',
            'img'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576',
            'email'              => 'string',
            'cic_number'         => 'string',
            'birth_date'         => 'date',
            'birth_place'        => 'string',
            'place_of_residencs' => 'string',
            'permanent_address'  => 'string',
            'education_level_id' => 'int',
            'status'             => 'int',
            'type_employee_id'   => 'int',
            'job_position_id'    => 'int',
        ]);

        $employee = EmployeeModel::findOrFail($id);

        // Lấy đường dẫn hình ảnh cũ
        $imageOld = $employee->img;

        $imagePath = $imageOld;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/employee_img/'), $imagePath);

            // Xóa hình ảnh cũ nếu có
            if ($imageOld && file_exists(public_path('assets/employee_img/' . $imageOld))) {
                unlink(public_path('assets/employee_img/' . $imageOld));
            }
        }

        // Cập nhật thông tin nhân viên
        $employee->update(array_merge($validated, ['img' => $imagePath]));

        return response()->json([
            'success' => true,
            'employee' => $employee,
        ]);
    }

    public function edit($id)
    {
//        dd($id);
        $employee = EmployeeModel::findOrFail($id);
        return response()->json([
           'employee' =>  $employee
        ]);
    }
}
