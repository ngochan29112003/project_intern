<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class RewardModel extends Model
{
    use HasFactory;

    protected $table = 'rewards';
    protected $primaryKey = 'rewards_id';
    protected $fillable=[
        'type_reward_id',
        'employee_id',
    ];
    public $timestamps = false;

    function getEmployee()
    {
        return DB::table('employees')->get();
    }

    function getRewardType()
    {
        return DB::table('type_rewards')->get();
    }

    function getReward()
    {
        return DB::table('rewards')
            ->join('employees','employees.employee_id','=','rewards.employee_id')
            ->join('type_rewards','type_rewards.type_reward_id','=','rewards.type_reward_id')
            ->get();
    }
}
