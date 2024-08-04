<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function getView()
    {
        $model = new CustomerModel();
        $customer_list = $model->getCustomer();
//        dd($customer_list);
        return view('auth.customer.index-customer', compact('customer_list'));
    }

    function add(Request $request){
        $validated = $request->validate([
            'add_customer_code'=>'required|string',
            'add_customer_name'=>'required|string',
            'add_phone_number'=>'required|string',
            'add_email'=>'required|string',
            'add_address'=>'required|string',
            'add_project'=>'required|string',
        ]);

        CustomerModel::create([
            'client_name' =>$validated['add_customer_name'],
            'phone_number' =>$validated['add_phone_number'],
            'email' =>$validated['add_email'],
            'address' =>$validated['add_address'],
            'project' =>$validated['add_project'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Customer added successfully',
        ]);
    }
}
