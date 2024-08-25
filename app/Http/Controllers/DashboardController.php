<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function getView(){
        $data = DB::table('accounts')->get();

        $countEmployees = DB::table('employees')->count();
        $countDeparts = DB::table('departments')->count();
        $salary = DB::table('salaries')->sum('net_salary');
        $countJob = DB::table('job_positions')->count();
        $countTask = DB::table('tasks')->count();
        $countReward = DB::table('rewards')->count();
        $countDisciplines = DB::table('disciplines')->count();
        $countProposal = DB::table('proposals')->count();
        $countLeave = DB::table('leave_application')->count();

//        dd($countEmployee);
        return view('auth.dashboard.index-dashboard',
            compact(
                'data',
                'countEmployees',
                'countDeparts',
                'salary',
                'countJob',
                'countTask',
                'countReward',
                'countDisciplines',
                'countProposal',
                'countLeave',));
    }
}
