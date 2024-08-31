<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BhxhModel extends Model
{
    use HasFactory;

    protected $table = 'bao_hiem_xh';
    protected $primaryKey = 'bhxh_id';
    protected $fillable = [
        'employee_id',
        'luong_theo_hs',
        'luong_theo_hspc',
        'tong_hs',
        'bhxh_capbac',
        'bhyt_capbac',
        'bhtn_capbac',
        'bhxh_hscv',
        'bhyt_hscv',
        'bhtn_hscv',
        'tong_tru_luong',
        'bhxh_to_chuc',
        'bhyt_to_chuc',
        'bhtn_to_chuc',
        'bhnn_to_chuc',
        'tong_to_chuc',
    ];
    public $timestamps = false;

    public function getEmployeeBHXH()
    {
        $bhxh = DB::table('bao_hiem_xh')
            ->join('employees', 'bao_hiem_xh.employee_id', '=', 'employees.employee_id')
            ->join('salaries', 'bao_hiem_xh.employee_id', '=', 'salaries.employee_id')
            ->join('job_details', 'employees.employee_id', '=', 'job_details.employee_id')
            ->join('job_positions', 'job_details.job_position_id', '=', 'job_positions.job_position_id')
            ->join('type_employees', 'employees.type_employee_id', '=', 'type_employees.type_employee_id')
            ->where('employees.status', 1)
            ->get();

        return $bhxh;
    }

    public function getBHXHEmployeeCurrent($id)
    {
        return DB::table('bao_hiem_xh')
            ->join('employees', 'bao_hiem_xh.employee_id', '=', 'employees.employee_id')
            ->join('salaries', 'bao_hiem_xh.employee_id', '=', 'salaries.employee_id')
            ->join('job_details', 'employees.employee_id', '=', 'job_details.employee_id')
            ->join('job_positions', 'job_details.job_position_id', '=', 'job_positions.job_position_id')
            ->join('type_employees', 'employees.type_employee_id', '=', 'type_employees.type_employee_id')
            ->where('employees.status', 1)
            ->where('bao_hiem_xh.bhxh_id', $id)
            ->first();
    }

    public function calculateAndUpdateBHXH($salaryId)
    {
        // Retrieve the related salary data
        $salary = DB::table('salaries')->where('salary_id', $salaryId)->first();

        // Calculate each value based on the provided formulas
        $luong_theo_hs = $salary->salary_coefficient * 2340000;
        $luong_theo_hspc = $salary->allowance_salary_coefficient * 2340000;
        $tong_hs = $luong_theo_hs + $luong_theo_hspc;

        $bhxh_capbac = $luong_theo_hs * 0.08;
        $bhyt_capbac = $luong_theo_hs * 0.015;
        $bhtn_capbac = $luong_theo_hs * 0.01;

        $bhxh_hscv = $luong_theo_hspc * 0.08;
        $bhyt_hscv = $luong_theo_hspc * 0.015;
        $bhtn_hscv = $luong_theo_hspc * 0.01;

        $tong_tru_luong = $bhxh_capbac + $bhyt_capbac + $bhtn_capbac + $bhxh_hscv + $bhyt_hscv + $bhtn_hscv;

        $bhxh_to_chuc = $tong_hs * 0.17;
        $bhyt_to_chuc = $tong_hs * 0.03;
        $bhtn_to_chuc = $tong_hs * 0.01;
        $bhnn_to_chuc = $tong_hs * 0.005;

        $tong_to_chuc = $bhxh_to_chuc + $bhyt_to_chuc + $bhtn_to_chuc + $bhnn_to_chuc;

        // Update the bao_hiem_xh table with the calculated values
        DB::table('bao_hiem_xh')
            ->where('employee_id', $salary->employee_id)
            ->update([
                'luong_theo_hs' => $luong_theo_hs,
                'luong_theo_hspc' => $luong_theo_hspc,
                'tong_hs' => $tong_hs,
                'bhxh_capbac' => $bhxh_capbac,
                'bhyt_capbac' => $bhyt_capbac,
                'bhtn_capbac' => $bhtn_capbac,
                'bhxh_hscv' => $bhxh_hscv,
                'bhyt_hscv' => $bhyt_hscv,
                'bhtn_hscv' => $bhtn_hscv,
                'tong_tru_luong' => $tong_tru_luong,
                'bhxh_to_chuc' => $bhxh_to_chuc,
                'bhyt_to_chuc' => $bhyt_to_chuc,
                'bhtn_to_chuc' => $bhtn_to_chuc,
                'bhnn_to_chuc' => $bhnn_to_chuc,
                'tong_to_chuc' => $tong_to_chuc
            ]);
    }



}

