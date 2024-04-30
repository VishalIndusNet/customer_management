<?php

namespace App\Http\Controllers\policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\policy;

class policyController extends Controller
{
    //
    public function create(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'policy_number' => 'required|unique:policies',
            'policy_type' => 'required|string',
            'coverage_details' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'premium_amount' => 'required|numeric',
        ]);

        // Create a new policy record
        $policy = Policy::create($validatedData);

        // Return success response
        return response()->json(['message' => 'Policy created successfully', 'data' => $policy], 201);
    }


    public function update(Request $request, $policyId)
    {
        // Find the policy record by ID
        $policy = Policy::findOrFail($policyId);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'policy_number' => 'required|unique:policies,policy_number,' . $policyId,
            'policy_type' => 'required|string',
            'coverage_details' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'premium_amount' => 'required|numeric',
        ]);

        // Update the policy record
        $policy->update($validatedData);

        // Return success response
        return response()->json(['message' => 'Policy updated successfully', 'data' => $policy]);
    }


    public function delete($policyId)
    {
        // Find the policy record by ID
        $policy = Policy::findOrFail($policyId);

        // Delete the policy record
        $policy->delete();

        // Return success response
        return response()->json(['message' => 'Policy deleted successfully']);
    }

}
