<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\BookAreaController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/change/password/store', [UserController::class, 'ChangePasswordStore'])->name('password.change.store');      
});

require __DIR__.'/auth.php';

//Admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//Admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function() {
    //Using grouping method to handle the controller and routes
    Route::controller(TeamController::class)->group(function() {
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update/store', 'StoreUpdatedTeam')->name('team.update.store');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
    });
});

//Admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function() {
    //Using grouping method to handle the controller and routes
    Route::controller(BookAreaController::class)->group(function() {
        Route::get('/all/bookarea', 'AllBookArea')->name('all.book.area');
        Route::get('/add/bookarea', 'AddBookArea')->name('add.book.area');
        Route::post('/bookarea/store', 'StoreBookarea')->name('book.area.store');
        Route::get('/edit/bookarea/{id}', 'EditBookarea')->name('edit.book.area');
        Route::post('/bookarea/update/store', 'StoreUpdatedBookarea')->name('bookarea.update.store');
        Route::get('/delete/bookarea/{id}', 'DeleteBookarea')->name('delete.book.area');
    });
});