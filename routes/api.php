<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::post('/tickets', [ApiController::class, 'store']);

Route::get('/tickets', [ApiController::class, 'getLatestTickets']);
