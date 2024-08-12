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
        'action_id',
        'employee_id',
    ];
    public $timestamps = false;

    function getEmployee()
    {
        return DB::table('employees')->get();
    }

    function getTypeDiscipline()
    {
        return DB::table('type_disciplines')->get();
    }
    function getDiscipline()
    {
        return DB::table('disciplines')
            ->join('employees','employees.employee_id','=','disciplines.employee_id')
            ->join('type_disciplines','type_disciplines.action_id','=','disciplines.action_id')
            ->get();
    }
}
