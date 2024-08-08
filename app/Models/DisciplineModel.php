<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class DisciplineModel extends Model
{
    use HasFactory;
    protected $table = 'disciplines';
    protected $primaryKey = 'discipline_id';
    protected $fillable = [
        'discipline_code',
        'discipline_name',
        'employee_id',
        'description',
    ];
    public $timestamps = false;

    function getDiscipline()
    {
        return DB::table('disciplines')->get();
    }
}
