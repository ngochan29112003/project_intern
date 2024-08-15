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

    public function files()
    {
        return $this->hasMany(ProposalFileModel::class, 'proposal_id', 'proposal_id');
    }

    function getProposalList($account_id, $employee_id)
    {
//        permission = 3 -> nhân viên bth
//        permission = 2 và job_position_id = 6 -> DM truong phong
//        permission = 2 và job_position_id = 7 -> Dir giam doc

        $permission = DB::table('accounts')
            ->where('id',$account_id)
            ->value('permission');

        $job_position_id = DB::table('employees')
            ->where('employee_id',$employee_id)
            ->value('job_position_id');

        $list_proposal = [];

        if ($permission === 3){

        }else if ($permission === 2 && $job_position_id === 6){

        }else if ($permission === 2 && $job_position_id === 7){

        }
    }
}
