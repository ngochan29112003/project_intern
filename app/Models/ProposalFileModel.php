<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalFileModel extends Model
{
    use HasFactory;

    protected $table = 'proposal_file';

    protected $primaryKey = 'proposal_file_id';

    protected $fillable = [
        'proposal_id',
        'proposal_file_name',
    ];
    public $timestamps = false;

    public function proposalApplication()
    {
        return $this->belongsTo(ProposalModel::class, 'proposal_id', 'proposal_id');
    }
}
