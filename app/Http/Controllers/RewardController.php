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
        return view('auth.reward.index-reward', compact('reward_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_reward_code' => 'required|string',
            'add_reward_name' => 'required|string',
            'add_employee_id' => 'required|string',
            'add_discription' => 'required|string',
        ]);

       RewardModel::create([
            'reward_code' =>$validated['add_reward_code'],
            'reward_name' =>$validated['add_reward_name'],
            'employee_id' =>$validated['add_employee_id'],
            'discription' =>$validated['add_discription'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Reward added successfully',
        ]);
    }
}
