<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer;

Route::get('/', function () {
    return view('welcome');
});

Route::get('customers',[customerController::class,'index']);

// Route::get('/customers', [CustomerController::class, 'index']);
// Route::get('/customers/create', [CustomerController::class, 'create']);
// Route::post('/customers', [CustomerController::class, 'store']);
// Route::get('/customers/{id}', [CustomerController::class, 'show']);
// Route::get('/customers/{id}/edit', [CustomerController::class, 'edit']);
// Route::put('/customers/{id}', [CustomerController::class, 'update']);
// Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);


// Route::post('/policies', 'PolicyController@create');
// Route::put('/policies/{policyId}', 'PolicyController@update');
// Route::delete('/policies/{policyId}', 'PolicyController@delete');

// Route::post('/payments', 'PaymentController@create');
// Route::put('/payments/{paymentId}', 'PaymentController@update');
// Route::delete('/payments/{paymentId}', 'PaymentController@delete');
