<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class PositionModel extends Model
{
    use HasFactory;
    protected $table = "job_positions";
    protected $primaryKey = "job_position_id";
    public $timestamps = false;
    protected $fillable=[
        'job_position_code',
        'job_position_name',
        'job_position_salary',
        'description',
    ];

    function getPosition()
    {
        return DB::table('job_positions')->get();
    }
}
