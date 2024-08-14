<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\EmployeeModel;
use App\Models\LeaveApplicationModel;
use Illuminate\Http\Request;
use App\StaticString;

class LeaveApplicationController extends Controller
{
    function getView()
    {
        $account_id = \Illuminate\Support\Facades\Request::session()->get(\App\StaticString::ACCOUNT_ID);
        $model = new LeaveApplicationModel();
        $model_account = new AccountModel();
        $model_employee = new EmployeeModel();
        $employee_id = $model_account->getIdEmployee($account_id);
        $current_employee = $model_employee->getOneEmployee($employee_id);
        $leave_application_list = $model->getLeaveApplication($employee_id);
        $leave_types = $model->getLeaveTypes();
        $employee_list = $model->getEmployee();
//        dd($leave_application_list);
        return view('auth.leave_application.index-leave-application',
            compact('leave_application_list', 'employee_list','leave_types','current_employee'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_employee_id' => 'int',
            'add_leave_type' => 'int',
            'add_start_date' => 'date',
            'add_end_date' => 'date',
            'duration' => 'int',
        ]);

        $validated['add_status'] = 0;
        LeaveApplicationModel::create([
            'employee_id' =>$validated['add_employee_id'],
            'type_leave_id' =>$validated['add_leave_type'],
            'start_date' =>$validated['add_start_date'],
            'end_date' =>$validated['add_end_date'],
            'duration' =>$validated['duration'],
            'leave_status' =>$validated['add_status'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Leave application added successfully',
        ]);
    }

    public function delete($id)
    {
        $leave_application = LeaveApplicationModel::findOrFail($id);

        $leave_application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Leave application deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $leaveapplication = LeaveApplicationModel::findOrFail($id);
        return response()->json([
            'leaveapplication' => $leaveapplication
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'employee_id'=> 'int',
            'type_leave_id'=> 'int',
            'start_date'=> 'date',
            'end_date'=> 'date',
            'duration' => 'int',
            'status'=> 'int',
        ]);
        $leaveapplication = LeaveApplicationModel::findOrFail($id);
        $leaveapplication->update($validated);

        return response()->json([
            'success' => true,
            'leaveapplication' => $leaveapplication,
        ]);
    }

    public function getViewReport()
    {
        $model = new LeaveApplicationModel();
        $leaveReport = $model->getAllLeaveAppReport();
        return view('auth.leave_application.report-leave-application', compact('leaveReport'));
    }

    public function approve($id)
    {
        $leaveReport = LeaveApplicationModel::findOrFail($id);
        $leaveReport->leave_status = 1;
        $leaveReport->save();

        return response()->json([
            'success' => true,
            'message' => 'Leave application approved successfully'
        ]);
    }
}
