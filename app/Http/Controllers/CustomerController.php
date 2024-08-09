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
        $employee_list = $model->getEmployee();
        $project_list = $model->getProject();
        dd($customer_list);
        return view('auth.customer.index-customer',
            compact('customer_list',
                 'employee_list',
                            'project_list'));
    }

    function add(Request $request){
        $validated = $request->validate([
            'add_customer_name'=>'required|string',
            'add_phone_number'=>'required|string',
            'add_email'=>'required|string',
            'add_employee_id'=>'int',
            'add_address'=>'required|string',
            'add_project'=>'int',
        ]);

        CustomerModel::create([
            'customer_name' =>$validated['add_customer_name'],
            'phone_number' =>$validated['add_phone_number'],
            'email' =>$validated['add_email'],
            'employee_id' =>$validated['add_employee_id'],
            'address' =>$validated['add_address'],
            'project_id' =>$validated['add_project'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Customer added successfully',
        ]);
    }

    public function delete($id)
    {
//        dd($id);
        $customer = CustomerModel::findOrFail($id);
        $customer->delete();
        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully'
        ]);
    }
}
