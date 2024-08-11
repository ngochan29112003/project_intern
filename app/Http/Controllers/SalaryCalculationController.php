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
        $employee_list = $model->getEmployee();
//        dd($salarycalculation_list);
        return view('auth.payroll.index-salary-calculation',
            compact('salarycalculation_list','employee_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_payroll_code' => 'required|string',
            'add_employee_id' => 'int',
            'add_work_day' => 'required|string',
            'add_allowance' => 'int',
            'add_advance' => 'int',
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
        $salary_calculation = SalaryCalculationModel::findOrFail($id);

        $salary_calculation->delete();

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Proposal application deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $salary_calculation = SalaryCalculationModel::findOrFail($id);
        return response()->json([
            'salary_calculation' => $salary_calculation
        ]);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'payroll_code' => 'required|string',
            'employee_id' => 'int',
            'work_day' => 'required|string',
            'allowance' => 'int',
            'advance' => 'int',
            'description' => 'required|string',
        ]);
        $salary_calculation = SalaryCalculationModel::findOrFail($id);
        $salary_calculation->update($validated);

        return response()->json([
            'success' => true,
            'salary_calculation' => $salary_calculation,
        ]);
    }
}
