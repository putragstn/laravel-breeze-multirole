<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// superadmin routes
Route::middleware(['auth','role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard',[SuperadminController::class,'dashboard'])->name('superadmin.dashboard');
});


// admin routes
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
});

// Custom Route Not from Laravel Breeze
// Route::group(['middleware'=>'role:superadmin,admin','prefix'=>'car', 'as'=>'car.'],function () {
//     Route::group(['prefix'=>'car-type', 'as'=>'car-type.'],function () {
//         /* beberapa route di dalam group */
//         // Route::get('/admin/dashboard', function(){
//         //     return view('dashboard');
//         // })->name('admin.dashboard');

//         Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     });
// });


require __DIR__.'/auth.php';
