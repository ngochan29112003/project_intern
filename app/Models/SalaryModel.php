<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SalaryModel extends Model
{
    use HasFactory;

    protected $table = 'salaries';
    protected $primaryKey = 'salary_id';
    protected $fillable = [
        'employee_id',
        'salary_coefficient',
        'allowance_salary_coefficient',
        'social_insurance',
        'health_insurance',
        'accident_insurance',
        'gross_salary',
        'net_salary',
    ];
    public $timestamps = false;

    public function getSalaryEmployee()
    {
        $salaries = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', '=', 'employees.employee_id')
            ->join('job_positions', 'employees.job_position_id', '=', 'job_positions.job_position_id')
            ->where('employees.status', 1)
            ->select(
                'employees.first_name',
                'employees.last_name',
                'job_positions.job_position_code',
                'job_positions.job_position_name',
                'job_positions.position_level',
                'job_positions.salary_code',
                'salaries.salary_coefficient',
                'salaries.allowance_salary_coefficient',
                'salaries.social_insurance',
                'salaries.health_insurance',
                'salaries.accident_insurance',
                'salaries.gross_salary',
                'salaries.net_salary',
                'salaries.salary_id'
            )
            ->get();

        return $salaries;
    }

    public function getSalaryEmployeeCurrent($id)
    {
        return DB::table('salaries')
            ->join('employees', 'salaries.employee_id', '=', 'employees.employee_id')
            ->join('job_positions', 'employees.job_position_id', '=', 'job_positions.job_position_id')
            ->where('employees.status', 1)
            ->where('salaries.salary_id', $id)
            ->select(
                'employees.first_name',
                'employees.last_name',
                'job_positions.job_position_code',
                'job_positions.job_position_name',
                'job_positions.position_level',
                'job_positions.salary_code',
                'salaries.salary_coefficient',
                'salaries.allowance_salary_coefficient',
                'salaries.social_insurance',
                'salaries.health_insurance',
                'salaries.accident_insurance',
                'salaries.gross_salary',
                'salaries.net_salary',
                'salaries.salary_id'
            )
            ->first();
    }

    public function calculateAndUpdateSalary($salaryId)
    {
        $salary = DB::table('salaries')
            ->where('salary_id', $salaryId)
            ->first();

        if ($salary && $salary->salary_coefficient !== null) {
            $base_salary = 2340000; // Lương cứng
            $gross_salary = ($salary->salary_coefficient + $salary->allowance_salary_coefficient) * $base_salary;
            $social_insurance = $gross_salary * 0.08;
            $health_insurance = $gross_salary * 0.015;
            $accident_insurance = $gross_salary * 0.01;
            $net_salary = $gross_salary - ($social_insurance + $health_insurance + $accident_insurance);

            // Cập nhật lại giá trị đã tính vào bảng `salaries`
            DB::table('salaries')
                ->where('salary_id', $salaryId)
                ->update([
                    'social_insurance' => $social_insurance,
                    'health_insurance' => $health_insurance,
                    'accident_insurance' => $accident_insurance,
                    'gross_salary' => $gross_salary,
                    'net_salary' => $net_salary
                ]);
        }
    }
}
