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
            'job_position_code' => 'required|string',
            'job_position_name' => 'required|string',
            'position_level' => 'required|string',
            'salary_code' => 'nullable',
            'description' => 'nullable',
        ]);

        // Kiểm tra nếu tồn tại một position với ba trường giống nhau
        $existingPosition = PositionModel::where('job_position_code', $validated['job_position_code'])
            ->where('job_position_name', $validated['job_position_name'])
            ->where('position_level', $validated['position_level'])
            ->first();

        if ($existingPosition) {
            return response()->json([
                'success' => false,
                'status'  => 400,
                'message' => 'Position already exists with the same job position code, job position name, and position level.',
            ]);
        }

        PositionModel::create($validated);

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
            'job_position_code' => 'string',
            'job_position_name' => 'string',
            'position_level' => 'string',
            'salary_code' => 'nullable',
            'description' => 'nullable',
        ]);
        $position = PositionModel::findOrFail($id);
        $position->update($validated);

        return response()->json([
            'success' => true,
            'position' => $position,
        ]);
    }

}
