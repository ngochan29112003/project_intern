<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getView()
    {
        $model = new EmployeeModel();
        $employee_list = $model->getEmployee();
//        dd($employee_list);
        return view('auth.employees.index-employee', compact('employee_list'));
    }

    public function add(Request $request)
    {
//        dd($request->file('add_img'));
        $validated = $request->validate([
            'add_employee_name' => 'required|string',
            'add_img'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576',
            'add_gender'        => 'required|string',
            'add_birthday'      => 'required|date',
            'add_birthplace'    => 'required|string',
            'add_idcard'        => 'required|string',
            'add_edu'           => 'required|string',
            'add_status'        => 'required|string',
        ]);

        $imagePath = 'avt.png';
        if ($request->hasFile('add_img')) {
            $file = $request->file('add_img');
//            $imagePath = asset('assets/employee_img') . time() . '_' . $file->getClientOriginalName();
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/employee_img/'), $imagePath);
        }

        EmployeeModel::create([
            'employee_name'      => $validated['add_employee_name'],
            'img'                => $imagePath,
            'gender'             => $validated['add_gender'],
            'birth_date'         => $validated['add_birthday'],
            'birth_place'        => $validated['add_birthplace'],
            'id_card_number'     => $validated['add_idcard'],
            'education_level_id' => $validated['add_edu'],
            'status'             => $validated['add_status'],
            'type_employee_id' => null,
            'job_position_id' => null,
        ]);

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
            'message' => 'Proposal application deleted successfully'
        ]);
    }
}
