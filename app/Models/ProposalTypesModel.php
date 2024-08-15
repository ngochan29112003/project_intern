<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalTypesModel extends Model
{
    use HasFactory;
    protected $table = 'type_proposals';
    protected $primaryKey = 'type_proposal_id';
    protected $fillable = ['proposal_name'];
    public $timestamps = false;

    public function proposalApplications()
    {
        return $this->hasMany(ProposalModel::class, 'proposal_id', 'type_proposal_id');
    }
}
