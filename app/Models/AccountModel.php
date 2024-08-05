<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class AccountModel extends Model
{
    use HasFactory;
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    function getPermis()
    {
        return DB::table('permissions')->get();
    }

}
