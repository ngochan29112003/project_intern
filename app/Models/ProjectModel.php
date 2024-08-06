<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectModel extends Model
{
    use HasFactory;
    protected $table='projects';
    protected $primaryKey='project_id';
    protected $fillable=[
        'project_code',
        'project_name',
        'status',
        'customer_id',
        'emloyee_id',
        'start_date',
        'end_date',
    ];
    public $timestamps = false;

    function getProject()
    {
        return DB::table('projects')->get();
    }
}
