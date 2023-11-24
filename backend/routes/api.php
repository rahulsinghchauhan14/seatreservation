<?php

use App\Http\Controllers\SeatController;
use App\Http\Middleware\ValidBookingRequest;
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

Route::get("remainingSeats",[SeatController::class,"remainingSeats"]);
Route::get("allSeats",[SeatController::class,"allSeats"]);
Route::post("booking",[SeatController::class,"seatBooking"])->middleware([ValidBookingRequest::class]);
