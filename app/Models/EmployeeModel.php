<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeeModel extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'name',
        'img',
        'gender',
        'birth_date',
        'birth_place',
        'id_card_number',
        'education_level',
        'status',
    ];
    public $timestamps = false;
    function getEmployee()
    {
        return DB::table('employees')->get();
    }
}
