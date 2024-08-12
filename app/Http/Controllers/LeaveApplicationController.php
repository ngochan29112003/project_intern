<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplicationModel;
use Illuminate\Http\Request;

class LeaveApplicationController extends Controller
{
    function getView()
    {
        $model = new LeaveApplicationModel();
        $leave_application_list = $model->getLeaveApplication();
        $leave_types = $model->getLeaveTypes();
        $employee_list = $model->getEmployee();
        return view('auth.leave_application.index-leave-application',
            compact('leave_application_list', 'employee_list','leave_types'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_employee_id' => 'int',
            'add_leave_type' => 'int',
            'add_start_date' => 'required|string',
            'add_end_date' => 'required|string',
        ]);

        $validated['add_status'] = 0;
        LeaveApplicationModel::create([
            'employee_id' =>$validated['add_employee_id'],
            'type_leave_id' =>$validated['add_leave_type'],
            'start_date' =>$validated['add_start_date'],
            'end_date' =>$validated['add_end_date'],
            'status' =>$validated['add_status'],
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
            'type_leave_id'=> 'required|string',
            'start_date'=> 'required|string',
            'end_date'=> 'required|string',
            'status'=> 'int',
        ]);
//        $leaveapplication = LeaveApplicationModel::ModelfindOrFail($id);
        $leaveapplication = LeaveApplicationModel::findOrFail($id);
        $leaveapplication->update($validated);

        return response()->json([
            'success' => true,
            'leaveapplication' => $leaveapplication,
        ]);
    }
}
