<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfileModel extends Model
{
    use HasFactory;

    function getProfile()
    {
        $account_id = \Illuminate\Support\Facades\Request::session()->get(\App\StaticString::ACCOUNT_ID);
        $model_account = new AccountModel();
        $employee_id = $model_account->getIdEmployee($account_id);

        $profile_info = DB::table('employees')
            ->join('type_employees', 'employees.type_employee_id', '=', 'type_employees.type_employee_id')
            ->join('job_details', 'employees.employee_id', '=', 'job_details.employee_id')
            ->join('job_positions', 'job_details.job_position_id', '=', 'job_positions.job_position_id')
            ->join('education_level', 'education_level.education_level_id', '=', 'employees.education_level_id')
            ->join('departments', 'departments.department_id', '=', 'employees.department_id')
            ->where('employees.employee_id', $employee_id)
            ->first();

        return $profile_info;
    }
}
