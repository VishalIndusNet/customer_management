<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class customerController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        // return view('customers.index', compact('customers'));
        dd("123");
        // exit();
        return response()->json(['customers' => $customers]);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        // return view('customers.show', compact('customer'));
        return $customer;
    }

    //
    public function create(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'date_of_birth' => 'required|date',
        'email' => 'required|email|unique:customers',
        'phone_number' => 'required|string',
        'address' => 'required|string',
        'kyc_status' => 'required|boolean',
    ]);

    // Create a new customer record
    $customer = Customer::create($validatedData);

    // Return success response
    return response()->json(['message' => 'Customer created successfully', 'data' => $customer], 201);
}

    public function update(Request $request, $customerId)
    {
        // Find the customer record by ID
        $customer = Customer::findOrFail($customerId);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:customers,email,'.$customerId,
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'kyc_status' => 'required|boolean',
        ]);

        // Update the customer record
        $customer->update($validatedData);

        // Return success response
        return response()->json(['message' => 'Customer updated successfully', 'data' => $customer]);
    }

        public function delete($customerId)
        {
            // Find the customer record by ID
            $customer = Customer::findOrFail($customerId);

            // Delete the customer record
            $customer->delete();

            // Return success response
            return response()->json(['message' => 'Customer deleted successfully']);
        }


        public function viewPolicies($customerId)
        {
        // Find the customer record by ID
        $customer = Customer::findOrFail($customerId);

        // Retrieve the policies associated with the customer
        $policies = $customer->policies()->get();

        // Return the policies as a JSON response
        return response()->json(['data' => $policies]);
        }



        public function viewPaymentHistory($policyId)
    {
        // Find the policy record by ID
        $policy = Policy::findOrFail($policyId);

        // Retrieve the payment history associated with the policy
        $payments = $policy->payments()->get();

        // Return the payment history as a JSON response
        return response()->json(['data' => $payments]);
    }

}
