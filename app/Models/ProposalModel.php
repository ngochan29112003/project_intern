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

    function getProposal($employee_id)
    {

    }
}
