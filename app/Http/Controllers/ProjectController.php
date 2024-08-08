<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function getView()
    {
        $model = new ProjectModel();
        $project_list = $model->getProject();
        return view('auth.project.index-project', compact('project_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_project_code' => 'required|string',
            'add_project_name' => 'required|string',
            'add_status' => 'required|string',
            'add_customer' => 'required|string',
            'add_employee_id' => 'required|string',
            'add_start_date' => 'required|string',
            'add_end_date' => 'required|string',
            ]);

        ProjectModel::create([
            'project_code' =>$validated['add_project_code'],
            'project_name' =>$validated['add_project_name'],
            'status' =>$validated['add_status'],
            'customer_id' =>$validated['add_customer'],
            'emloyee_id' =>$validated['add_employee_id'],
            'start_date' =>$validated['add_start_date'],
            'end_date' =>$validated['add_end_date'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Project added successfully',
        ]);
    }


}
