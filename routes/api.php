<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

$v1Helper = [
  "prefix" => "v1", 
  "namespace" => "App\Http\Controllers\Api\V1"
];

Route::group($v1Helper, function() {
  Route::apiResource("customers", CustomerController::class);
  Route::apiResource("invoices", InvoiceController::class);
});
