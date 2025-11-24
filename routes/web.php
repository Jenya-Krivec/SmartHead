<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\AdminIndexController;
use App\Http\Middleware\AuthenticateMiddleware;

Route::get('/', [DashboardController::class, 'create'])->name('index');

Route::get('/widget', [WidgetController::class, 'create'])->name('widget.chat');

Route::get('/login', [AuthenticateController::class, 'create'])->name('admin.login');

Route::post('/login', [AuthenticateController::class, 'store']);

Route::post('/login/destroy', [AuthenticateController::class, 'destroy'])->name('admin.logout');

Route::middleware([AuthenticateMiddleware::class])->group(function () {

    Route::get('/admin/index', [AdminIndexController::class, 'create'])->name('admin.index');

});
