<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class PermissionModel extends Model
{
    use HasFactory;
    protected $table = 'permissions';

    public $timestamps = false;
    protected $primaryKey = 'permission_id';
    protected $fillable = [
        'permission_name',
    ];

    function getPermission()
    {
        return DB::table('permissions')->get();
    }
}
