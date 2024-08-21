<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'job_details';
    protected $primaryKey = '	id_job_detail';
    protected $fillable = [
        'employee_id',
        'job_position_id',
        'job_level',
        'salary_code',
    ];
    public $timestamps = false;
}
