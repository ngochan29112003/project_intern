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
        $employee_list = $model->getEmployee();
        $type_discipline_list = $model->getTypeDiscipline();
//        dd($discipline_list);
        return view('auth.discipline.index-discipline',
            compact('discipline_list', 'employee_list','type_discipline_list'));
    }

    function add(Request $request){
        $validated = $request->validate([
            'add_action_id'=>'int',
            'add_employee_id'=>'int',
        ]);

        DisciplineModel::create([
            'action_id' =>$validated['add_action_id'],
            'employee_id' =>$validated['add_employee_id'],
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

    public function edit($id)
    {
        $discipline = DisciplineModel::findOrFail($id);
        return response()->json([
            'discipline' => $discipline
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'action_id' => 'int',
            'employee_id' => 'int',
        ]);
        $discipline = DisciplineModel::findOrFail($id);
        $discipline->update($validated);

        return response()->json([
            'success' => true,
            'discipline' => $discipline,
        ]);
    }
}
