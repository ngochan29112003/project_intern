<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DisciplineModel;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    function getView()
    {
        $model = new DisciplineModel();
        $discipline_list = $model->getDiscipline();
//        dd($discipline_list);
        return view('auth.discipline.index-discipline', compact('discipline_list'));
    }

    function add(Request $request){
        $validated = $request->validate([
            'add_discipline_code'=>'required|string',
            'add_discipline_name'=>'required|string',
            'add_employee_id'=>'required|string',
            'add_description'=>'required|string',
        ]);

        DisciplineModel::create([
            'discipline_code' =>$validated['add_discipline_code'],
            'discipline_name' =>$validated['add_discipline_name'],
            'employee_id' =>$validated['add_employee_id'],
            'description' =>$validated['add_description'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Discipline added successfully',
        ]);
    }

    function delete($id)
    {
//        dd($id);
        $discipline = DisciplineModel::findOrFail($id);
        $discipline->delete();
        return response()->json([
            'success' => true,
            'message' => 'Discipline deleted successfully'
        ]);
    }
}
