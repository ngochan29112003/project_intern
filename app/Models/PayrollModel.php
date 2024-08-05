<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PayrollModel extends Model
{
    use HasFactory;
    protected $table ='payroll';
    protected $primaryKey ='payroll_id';
    protected $fillable=[
        'payroll_code',
        'employee_id',
        'position_id',
        'monthly_salary',
        'work_days',
        'net_salary',
    ];
    public $timestamps = false;

    function getPayroll()
    {
        return DB::table('payroll')->get();
    }
}
