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
        'first_name',
        'last_name',
        'img',
        'gender',
        'birth_date',
        'birth_place',
        'place_of_resident',
        'email',
        'permanent_address',
        'cic_number',
        'education_level_id',
        'status',
        'type_employee_id',
        'department_id',
        'job_detail_id',
        'ethnic',
        'religion',
        'marital_status',
        'nation',
        'phone_number',
        'place_of_issue',
        'date_of_issue',
        'date_of_exp',
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

    function getDepartment()
    {
        return DB::table('departments')->get();
    }
    function getEmployeeInfo()
    {
        return DB::table('employees')
            ->join('type_employees','employees.type_employee_id','=','type_employees.type_employee_id')
            ->get();
    }

    function getImageOld($id)
    {
        return DB::table('employees')
            ->where('employee_id', $id)
            ->value('img');
    }

    function getOneEmployee($id)
    {
        return DB::table('employees')
            ->join('job_details','employees.employee_id','=','job_details.employee_id')
            ->join('job_positions','job_details.job_position_id','=','job_positions.job_position_id')
            ->where('employees.employee_id', $id)
            ->first();
    }
}
