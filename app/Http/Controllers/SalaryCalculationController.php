<?php

namespace App\Http\Controllers;

use App\Models\SalaryCalculationModel;
use Illuminate\Http\Request;

class SalaryCalculationController extends Controller
{
    //
    function getView(){
        $model = new SalaryCalculationModel();
        $salarycalculation_list = $model->getSalaryCalculation();
//        dd($salarycalculation_list);
        return view('auth.payroll.index-salarycalculation', compact('salarycalculation_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_payroll_code' => 'required|string',
            'add_employee_id' => 'required|string',
            'add_work_day' => 'required|string',
            'add_allowance' => 'required|string',
            'add_advance' => 'required|string',
            'add_description' => 'required|string',
        ]);

        SalaryCalculationModel::create([
            'payroll_code' => $validated['add_payroll_code'],
            'employee_id' => $validated['add_employee_id'],
            'work_days' => $validated['add_work_day'],
            'allowance' => $validated['add_allowance'],
            'advance' => $validated['add_advance'],
            'description' => $validated['add_description'],
        ]);

        return response()->json([
            'success' => true,
            'status'  => 200,
            'message' => 'Salary calculation added successfully',
        ]);
    }

    public function delete($id)
    {
        $position = SalaryCalculationModel::findOrFail($id);

        $position->delete();

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Proposal application deleted successfully'
        ]);
    }
}
