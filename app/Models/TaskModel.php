<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskModel extends Model
{
    use HasFactory;

    protected $table='tasks';
    protected $primaryKey='id_task';
    protected $fillable=[
        'task_code',
        'employee_id',
        'start_date',
        'end_date',
        'location',
        'purpose',
    ];

    public $timestamps = false;

    function getEmployee()
    {
        return DB::table('employees')->get();
    }
    function getTask()
    {
        return DB::table('tasks')
            ->join('employees','employees.employee_id','=','tasks.employee_id')
            ->get();
    }

}
