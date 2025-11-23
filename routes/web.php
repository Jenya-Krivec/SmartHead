<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WidgetController;

Route::get('/', [DashboardController::class, 'create'])->name('index');

Route::get('/widget', [WidgetController::class, 'create'])->name('widget.chat');
