<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Admin - dashboard activites
Route::resource('admin_','AdminController');


Route::resource('department','DepartmentController');
Route::resource('location','LocationController');
Route::resource('leave','LeaveController');
Route::resource('holiday','HolidayController');

//for employee management
Route::resource('employee','EmployeeController');
