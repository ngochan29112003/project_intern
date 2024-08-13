<?php

namespace App\Http\Controllers;

use App\Models\PositionModel;
use Illuminate\Http\Request;

class PositionCotroller extends Controller
{
    function getView(){
        $model = new PositionModel();
        $position_list = $model->getPosition();
//        dd($position_list);
        return view('auth.position.index-position', compact('position_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_job_position_code' => 'required|string',
            'add_job_position_name' => 'required|string',
            'add_job_position_salary' => 'required|string',
            'add_description' => 'required|string',
        ]);

        PositionModel::create([
            'job_position_code' => $validated['add_job_position_code'],
            'job_position_name' => $validated['add_job_position_name'],
            'job_position_salary' => $validated['add_job_position_salary'],
            'description' => $validated['add_description'],
        ]);

        return response()->json([
            'success' => true,
            'status'  => 200,
            'message' => 'Position added successfully',
        ]);
    }

    public function delete($id)
    {
        $position = PositionModel::findOrFail($id);

        $position->delete();

        return response()->json([
            'success' => true,
            'message' => 'Proposal application deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $position = PositionModel::findOrFail($id);
        return response()->json([
            'position' => $position
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'job_position_code' => 'required|string',
            'job_position_name' => 'required|string',
            'job_position_salary' => 'required|string',
            'description' => 'required|string',
        ]);
        $position = PositionModel::findOrFail($id);
        $position->update($validated);

        return response()->json([
            'success' => true,
            'position' => $position,
        ]);
    }

}
