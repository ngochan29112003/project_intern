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
        'proposal_date',
        'status',
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
    function getProposal()
    {
        return DB::table('proposals')
            ->join('employees','employees.employee_id','=','proposals.employee_id')
            ->join('type_proposals','type_proposals.type_proposal_id','=','proposals.type_proposal_id')
            ->get();
    }
}
