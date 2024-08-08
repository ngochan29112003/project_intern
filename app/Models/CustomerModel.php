<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customers';

    public $timestamps = false;
   protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_name',
        'phone_number',
        'email',
        'employee_id',
        'address',
        'project_id',
    ];

    function getEmployee()
    {
        return DB::table('employees')->get();
    }

    function getProject()
    {
        return DB::table('projects')->get();
    }

    function getCustomer()
    {
        return DB::table('customers')
            ->join('employees','employees.employee_id','=','customers.employee_id')
            ->join('projects','projects.project_id','=','customers.project_id')
            ->get();
    }
}
