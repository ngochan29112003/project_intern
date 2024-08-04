<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DepartmentModel extends Model
{
    use HasFactory;
    protected $table = 'department';
    protected  $primaryKey = 'department_id';
    public  $timestamps = false;
    protected $fillable =[
        'department_code',
        'department_name',
        'description',
        'created_by',
        'created_date',
        'update_by',
        'update_date',
    ];
    function getDepartment()
    {
        return DB::table('departments')->get();
    }
}
