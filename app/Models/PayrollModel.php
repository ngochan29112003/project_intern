<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PayrollModel extends Model
{
    use HasFactory;
    protected $table ='salaries';
    protected $primaryKey ='payroll_id';
    protected $fillable=[
        'payroll_code',
        'employee_id',
        'job_position_id',
        'monthly_salary',
        'work_days',
        'net_salary',
    ];
    public $timestamps = false;

    function getEmployee()
    {
        return DB::table('employees')->get();
    }

    function getPosition()
    {
        return DB::table('job_positions')->get();
    }

    function getPayroll()
    {
        return DB::table('salaries')
            ->join('employees','employees.employee_id','=','salaries.employee_id')
            ->join('job_positions','job_positions.job_position_id','=','salaries.job_position_id')
            ->get();
    }
}
