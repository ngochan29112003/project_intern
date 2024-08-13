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
        $reward_type_list = $model->getRewardType();
        $employee_list = $model->getEmployee();
//        dd($reward_list);
        return view('auth.reward.index-reward',
            compact('reward_list', 'employee_list', 'reward_type_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_reward_type' => 'int',
            'add_employee_id' => 'int',
        ]);

       RewardModel::create([
            'type_reward_id' =>$validated['add_reward_type'],
            'employee_id' =>$validated['add_employee_id'],
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

    public function edit($id)
    {
        $reward = RewardModel::findOrFail($id);
        return response()->json([
            'reward' => $reward
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type_reward_id' => 'int',
            'employee_id' => 'int',
        ]);
        $reward = RewardModel::findOrFail($id);
        $reward->update($validated);

        return response()->json([
            'success' => true,
            'reward' => $reward,
        ]);
    }
}
