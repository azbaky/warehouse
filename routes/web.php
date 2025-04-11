<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\BrokerPermissionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderStatusController;


use App\Models\Order;
use App\Models\Item;











/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    Route::get('/', function () {
        return redirect()->route('auth.login-view', ['guard' => 'admin']);
    });


    route::prefix('cms')->middleware('guest:admin,broker')->group(function(){
    Route::get('{guard}/login',[AuthController::class, 'showLogin'])->name('auth.login-view');
    route::post('login',[AuthController::class, 'login'])->name('auth.login');

});

 route::prefix('cms/admin')->middleware('auth:admin')->group(function(){

    Route::resource('admins',AdminController::class);
    Route::resource('brokers',BrokerController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',permissionController::class);
    Route::resource('customers',CustomerController::class);
    Route::resource('categories',CategoryController::class);    

    Route::put('roles/{role}/permission',[RolePermissionController::class,'update'])->name('role-permission.update');

    Route::put('orders/{order}/status',[OrderStatusController::class,'update'])->name('order-status.update');

    // Route::put('items/{item}/quntity',[OrderStatusController::class,'updateQun'])->name('item-quntity.update');
    Route::put('items/{id}/quantity', [OrderStatusController::class,'updateQun'])->name('item-quntity.update');



    Route::get('brokers/{id}/permissions',[BrokerPermissionController::class,'edit'])->name('broker-permissions.edit');
    Route::put('brokers/{id}/permissions',[BrokerPermissionController::class,'update'])->name('broker-permissions.update');




Route::prefix('cms/admin')->middleware('auth:admin,broker')->group(function () {
    // Route::view('/','cms.temp')->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('cities',CityController::class);
    Route::resource('items',ItemController::class);
    Route::resource('orders',OrderController::class);
    Route::resource('cars',CarController::class);
    route::get('edit-password',[AuthController::class,'editPassword'])->name('auth.edit-password');
    route::put('update-password',[AuthController::class,'updatePassword'])->name('auth.update-password');
    route::get('edit-profile',[AuthController::class,'editprofile'])->name('auth.edit-profile');
    route::put('update-profile',[AuthController::class,'updateprofile'])->name('auth.update-profile');
    route::get('logout',[AuthController::class,'logout'])->name('auth.logout');

});













