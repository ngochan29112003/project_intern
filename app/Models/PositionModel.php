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
    protected $fillable=[
        'job_position_code',
        'job_position_name',
        'position_level',
        'salary_code',
        'description',
    ];
    public $timestamps = false;

    function getPosition()
    {
        return DB::table('job_positions')->get();
    }
}
