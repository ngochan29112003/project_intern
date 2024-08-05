<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeeModel extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'employee_name',
        'img',
        'gender',
        'birth_date',
        'birth_place',
        'id_card_number',
        'education_level_id',
        'status',
        'type_employee_id',
        'job_position_id'
    ];
    public $timestamps = false;

    function getEdulevel()
    {
        return DB::table('education_level')->get();
    }
    function getTypeEmployees()
    {
        return DB::table('type_employees')->get();
    }
    function getPosition()
    {
        return DB::table('job_positions')->get();
    }
    function getEmployeeInfo()
    {
        return DB::table('employees')
            ->join('education_level','employees.education_level_id','=','education_level.education_level_id')
            ->join('type_employees','employees.type_employee_id','=','type_employees.type_employee_id')
            ->join('job_positions', 'employees.job_position_id','=','job_positions.job_position_id')
            ->get();
    }

}
