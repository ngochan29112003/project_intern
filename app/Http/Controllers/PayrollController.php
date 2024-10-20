<?php

namespace App\Http\Controllers;

use App\Models\PayrollModel;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    function getView()
    {
        $model = new PayrollModel();
        $payroll_list = $model->getPayroll();
        $employee_list = $model->getEmployee();
        $position_list = $model->getPosition();
        return view('auth.salaries.index-salaries',
            compact('payroll_list','employee_list','position_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_payroll_code' => 'required|string',
            'add_employee_id' => 'int',
            'add_position_id' => 'int',
            'add_monthly_salary' => 'required|string',
            'add_work_days' => 'required|string',
            'add_net_salary' => 'required|string',
        ]);

        PayrollModel::create([
            'payroll_code' =>$validated['add_payroll_code'],
            'employee_id' =>$validated['add_employee_id'],
            'job_position_id' =>$validated['add_position_id'],
            'monthly_salary' =>$validated['add_monthly_salary'],
            'work_days' =>$validated['add_work_days'],
            'net_salary' =>$validated['add_net_salary'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Payroll added successfully',
        ]);
    }

    public function delete($id)
    {
        $payroll = PayrollModel::findOrFail($id);

        $payroll->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payroll deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $payroll = PayrollModel::findOrFail($id);
        return response()->json([
            'salaries' => $payroll
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'payroll_code' => 'required|string',
            'employee_id' => 'int',
            'position_id' => 'int',
            'monthly_salary' => 'required|string',
            'work_days' => 'required|string',
            'net_salary' => 'required|string',
        ]);
        $payroll = PayrollModel::findOrFail($id);
        $payroll->update($validated);

        return response()->json([
            'success' => true,
            'salaries' => $payroll,
        ]);
    }
}
