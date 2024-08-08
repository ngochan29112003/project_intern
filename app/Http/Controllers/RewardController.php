<?php

namespace App\Http\Controllers;

use App\Models\RewardModel;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    function getView()
    {
        $model = new RewardModel();
        $reward_list = $model->getReward();
        $employee_list = $model->getEmployee();
//        dd($reward_list);
        return view('auth.reward.index-reward',
            compact('reward_list', 'employee_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_reward_code' => 'required|string',
            'add_reward_name' => 'required|string',
            'add_employee_id' => 'int',
            'add_description' => 'required|string',
        ]);

       RewardModel::create([
            'reward_code' =>$validated['add_reward_code'],
            'reward_name' =>$validated['add_reward_name'],
            'employee_id' =>$validated['add_employee_id'],
            'add_description' =>$validated['add_description'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Reward added successfully',
        ]);
    }

    public function delete($id)
    {
        $reward = RewardModel::findOrFail($id);

        $reward->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reward deleted successfully'
        ]);
    }
}
