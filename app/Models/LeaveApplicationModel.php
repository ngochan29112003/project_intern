<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeaveApplicationModel extends Model
{
    use HasFactory;
    protected $table = 'leave_application';
    protected $primaryKey = 'application_id';
    protected $fillable = [
        'employee_id',
        'type_leave_id',
        'start_date',
        'end_date',
        'status',
    ];

    public $timestamps = false;

    function getEmployee()
    {
        return DB::table('employees')->get();
    }

    function getLeaveTypes()
    {
        return DB::table('type_leaves')->get();
    }

    function getLeaveApplication()
    {
        return DB::table('leave_application')
            ->join('employees','employees.employee_id','=','leave_application.employee_id')
            ->join('type_leaves','type_leaves.type_leave_id','=','leave_application.type_leave_id')
            ->get();
    }
}
