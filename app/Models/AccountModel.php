<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class AccountModel extends Model
{
    use HasFactory;
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    function getAccountInfo()
    {
        return DB::table('accounts')
            ->join('permissions','permissions.permission_id','=','accounts.permission')
            ->get();
    }
    function getPermis(){
        return DB::table('permissions')->get();
    }

    function getIdEmployee($id)
    {
        return DB::table('accounts')
            ->where('id', $id)
            ->value('id_employee');
    }

    function getEmployeesWithoutAccount()
    {
        return DB::table('employees')
            ->leftJoin('accounts', 'employees.employee_id', '=', 'accounts.id_employee')
            ->whereNull('accounts.id_employee')
            ->get();
    }
}
