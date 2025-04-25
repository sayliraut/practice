<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageProfileController;
use App\Http\Controllers\ManageSubAdminController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return redirect('/admin/login');
});



Route::get('/admin/login', [LoginController::class, 'index'])->name('login');

Route::post('/check_login', [LoginController::class, 'login_check']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//*******************************************************manage users********************************************************

Route::group(['middleware' => ['checkStatus']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    Route::get('/add_user', [DashboardController::class, 'add'])->name('add_user');
    Route::get('/get-cities/{stateId}', [DashboardController::class, 'getCities']);
    Route::post('/store_user', [DashboardController::class, 'store_user']);
    Route::get('/view_user/{id}', [DashboardController::class, 'viewUser'])->name('view_user');
    Route::get('/edit_user/{id}', [DashboardController::class, 'edit_user']);
    Route::post('/update_user', [DashboardController::class, 'update_user'])->name('update_user');
    Route::delete('/delete_user/{id}', [DashboardController::class, 'delete_user']);
    Route::post('/export_selected_user', [DashboardController::class, 'exportSelectedUSer'])->name('export-selected-user');

    //*******************************************************manage profile********************************************************

    Route::get('/profile', [ManageProfileController::class, 'index'])->name('profile');
    Route::post('/update_profile', [ManageProfileController::class, 'update_profile'])->name('update.profile');

    //*******************************************************manage subadmin********************************************************

    Route::get('/manage-sub-admin', [ManageSubAdminController::class, 'index'])->name('manage.subAdmin');
    Route::get('/create_sub_admin', [ManageSubAdminController::class, 'create'])->name('manage.sub_admin_create');
    Route::post('/insert_sub_admin', [ManageSubAdminController::class, 'store_subadmin']);
    Route::get('/get_sub_admin_permission', [ManageSubAdminController::class, 'get_sub_admin_permission']);
    Route::get('/admin_users_mail/{id}', [ManageSubAdminController::class, 'AdminUsersMailView'])->name('admin.mailUser');
    Route::get('/edit_sub_admin/{id}', [ManageSubAdminController::class, 'edit'])->name('sub_admin_edit');
    Route::POST('/submit-subadmin-users-mail', [ManageSubAdminController::class, 'submitSubadminResponse'])->name('submit-subadmin-users-mail');


    //******************************************************* subadmin chat module********************************************************
    Route::get('/subadmin-contact-admin', [ManageSubAdminController::class, 'contactAdmin'])->name('subadmin.contact.admin');
    Route::POST('/submit-subadmin-contact-admin', [ManageSubAdminController::class, 'submitSubAdminContactAdminResponse'])->name('submit-subadmin-contact-admin');
});
