<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return redirect('/dashboard');
});
    //*******************************************************manage users********************************************************
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
Route::get('/add_user', [DashboardController::class, 'add'])->name('add_user');
Route::get('/get-cities/{stateId}', [DashboardController::class, 'getCities']);
Route::post('/store_user', [DashboardController::class, 'store_user']);
Route::get('/view_user/{id}', [DashboardController::class, 'viewUser'])->name('view_user');
Route::get('/edit_user/{id}', [DashboardController::class, 'edit_user']);
Route::post('/update_user', [DashboardController::class, 'update_user'])->name('update_user');
Route::delete('/delete_user/{id}', [DashboardController::class, 'delete_user']);
Route::post('/export_selected_user', [DashboardController::class, 'exportSelectedUSer'])->name('export-selected-user');










