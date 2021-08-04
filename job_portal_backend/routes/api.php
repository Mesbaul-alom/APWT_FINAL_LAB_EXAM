<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login','EmployeeController@Login');
Route::post('/createNewEmp','EmployeeController@CreateEmp');
Route::get('/getAllEmployee','EmployeeController@Employee');
Route::post('/editEmp','EmployeeController@Edit');
Route::post('/deleteEmp','EmployeeController@Delete');
Route::post('/job','JobController@Create');
Route::get('/job','JobController@Job');
Route::post('/jobUpdate','JobController@Update');
Route::post('/jobDelete','JobController@Delete');
