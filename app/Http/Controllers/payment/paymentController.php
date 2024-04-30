<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class paymentController extends Controller
{
    //

    public function create(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'policy_id' => 'required|exists:policies,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        // Create a new payment record
        $payment = Payment::create($validatedData);

        // Return success response
        return response()->json(['message' => 'Payment created successfully', 'data' => $payment], 201);
    }

    public function update(Request $request, $paymentId){

        // Find the payment record by ID
        $payment= Payment::findOrFail($paymentId);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'policy_id' => 'required|exists:policies,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        // Update the payment record
        $payment->update($validatedData);

        // Return success response
        return response()->json(['message' => 'Payment updated successfully', 'data' => $payment]);
    }

    public function delete($paymentId)
    {
        // Find the payment record by ID
        $payment = Payment::findOrFail($paymentId);

        // Delete the payment record
        $payment->delete();

        // Return success response
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
