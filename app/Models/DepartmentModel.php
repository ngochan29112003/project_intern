<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DepartmentModel extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected  $primaryKey = 'department_id';
    public  $timestamps = false;
    protected $fillable =[
        'department_code',
        'department_name',
    ];
    function getDepartment()
    {
        return DB::table('departments')->get();
    }

    function getInfoDepartment($id)
    {
        return DB::table('departments')
            ->where('department_id',$id)
            ->first();
    }

    function getEmployeeInDepartment($id)
    {
        return DB::table('employees')
            ->where('department_id',$id)
            ->get();
    }
}
