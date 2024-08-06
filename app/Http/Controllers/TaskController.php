<?php

namespace App\Http\Controllers;

use App\Models\TaskModel;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function getView()
    {
        $model = new TaskModel();
        $task_list = $model->getTask();
        return view('auth.task.index-task', compact('task_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_task_code' => 'required|string',
            'add_employee_id' => 'required|string',
            'add_start_date' => 'required|string',
            'add_end_date' => 'required|string',
            'add_location' => 'required|string',
            'add_purpose' => 'required|string',
        ]);

        TaskModel::create([
            'task_code' =>$validated['add_task_code'],
            'employee_id' =>$validated['add_employee_id'],
            'start_date' =>$validated['add_start_date'],
            'end_date' =>$validated['add_end_date'],
            'location' =>$validated['add_location'],
            'purpose' =>$validated['add_purpose'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Task added successfully',
        ]);
    }
}
