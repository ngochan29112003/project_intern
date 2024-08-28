<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProposalModel extends Model
{
    use HasFactory;

    protected $table = 'proposals';
    protected $primaryKey = 'proposal_id';
    protected $fillable=[
        'employee_id',
        'type_proposal_id',
        'proposal_description',
        'proposal_status',
    ];

    public $timestamps = false;

    function getEmployee()
    {
        return DB::table('employees')->get();
    }

    function getTypeProposal()
    {
        return DB::table('type_proposals')->get();
    }

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class, 'employee_id', 'employee_id');
    }

    public function proposalType()
    {
        return $this->belongsTo(ProposalTypesModel::class, 'proposal_id', 'type_proposal_id');
    }

    public function files()
    {
        return $this->hasMany(ProposalFileModel::class, 'proposal_id', 'proposal_id');
    }

    public function getEmployeeOfDepartment()
    {
        $account_id = \Illuminate\Support\Facades\Request::session()->get(\App\StaticString::ACCOUNT_ID); //get account_id from session
        $model_account = new AccountModel();
        $employee_id = $model_account->getIdEmployee($account_id); //Get employee_id
        $department_id = DB::table('employees')
            ->join('departments', 'employees.department_id','=','departments.department_id')
            ->where('employees.employee_id',$employee_id)
            ->value('employees.department_id');

        return DB::table('employees')
            ->where('department_id',$department_id)
            ->get();
    }

    function getProposalList()
    {
//        permission = 3 -> nhân viên bth
//        permission = 2 và job_position_id = 6 -> DM truong phong
//        permission = 2 và job_position_id = 7 -> Dir giam doc
        $account_id = \Illuminate\Support\Facades\Request::session()->get(\App\StaticString::ACCOUNT_ID); //get account_id from session
        $model_account = new AccountModel();
        $employee_id = $model_account->getIdEmployee($account_id); //Get employee_id

        $permission = DB::table('accounts')
            ->where('id',$account_id)
            ->value('permission');

        $job_position_id = DB::table('employees')
            ->join('job_details','employees.employee_id','=','job_details.employee_id')
            ->where('employees.employee_id',$employee_id)
            ->value('job_details.job_position_id');

        $department_id = DB::table('employees')
            ->join('departments', 'employees.department_id','=','departments.department_id')
            ->where('employees.employee_id',$employee_id)
            ->value('employees.department_id');

        $list_proposal = [];

        if (($permission === 3 || $permission === 1 || $permission === 2) && $job_position_id !== 6 && $job_position_id !== 7){
            $list_proposal = DB::table('proposals')
                ->join('employees','proposals.employee_id', '=','employees.employee_id')
                ->join('type_proposals','proposals.type_proposal_id', '=','type_proposals.type_proposal_id')
                ->where('proposals.employee_id', $employee_id)
                ->get();
        }else if ($permission === 2 && $job_position_id === 6){
            $list_proposal = DB::table('proposals')
                ->join('employees','proposals.employee_id', '=','employees.employee_id')
                ->join('type_proposals','proposals.type_proposal_id', '=','type_proposals.type_proposal_id')
                ->join('departments', 'employees.department_id','=','departments.department_id')
                ->where('employees.department_id',$department_id)
                ->get();
        }else if ($permission === 2 && $job_position_id === 7){
            $list_proposal = DB::table('proposals')
                ->join('employees','proposals.employee_id', '=','employees.employee_id')
                ->join('type_proposals','proposals.type_proposal_id', '=','type_proposals.type_proposal_id')
                ->get();
        }

        return $list_proposal;
    }
}
