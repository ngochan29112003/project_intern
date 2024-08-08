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
        'reward_code',
        'reward_name',
        'employee_id',
        'description',
    ];
    public $timestamps = false;

    function getEmployee()
    {
        return DB::table('employees')->get();
    }

    function getReward()
    {
        return DB::table('rewards')
            ->join('employees','employees.employee_id','=','rewards.employee_id')
            ->get();
    }


}
