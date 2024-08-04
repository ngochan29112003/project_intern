<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'clients';

    public $timestamps = false;
   protected $primaryKey = 'client_id';
    protected $fillable = [
        'client_name',
        'phone_number',
        'email',
        'address',
        'project'
    ];

    function getCustomer()
    {
        return DB::table('clients')->get();
    }
}
