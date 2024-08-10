<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SalaryCalculationModel extends Model
{
    use HasFactory;
    protected $table = "salary_calculation";
    protected $primaryKey = "salary_calculation_id";
    public $timestamps = false;
    protected $fillable=[
        'payroll_code',
        'employee_id',
        'work_days',
        'allowance',
        'advance',
        'description',
    ];

    function getEmployee()
    {
        return DB::table('employees')->get();
    }

    function getSalaryCalculation()
    {
        return DB::table('salary_calculation')
            ->join('employees','employees.employee_id','=','salary_calculation.employee_id')
            ->get();
    }

}
