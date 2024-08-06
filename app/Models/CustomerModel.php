<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customers';

    public $timestamps = false;
   protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_name',
        'phone_number',
        'email',
        'employee_id',
        'address',
        'project',
    ];

    function getCustomer()
    {
        return DB::table('customers')->get();
    }
}
