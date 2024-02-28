<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\AuthController;


Route::controller(AuthController::class)->group(function(){
    Route::get('/', 'login')->name('login')->middleware(['check.for.admin', 'check.for.employee']);
    Route::post('post-login', 'postLogin')->name('login.post');
    Route::get('registration', 'Register')->name('register')->middleware('check.for.admin', 'check.for.employee');
    Route::post('post-registration', 'postRegistration')->name('register.post');
    Route::post('logout', 'logout')->name('logout');
    // for admin profile update
    Route::get('/adminprofile', 'Adminprofile');
    Route::post('/adminprofileupdate', 'Adminprofileupdate')->name('updateadmin.profile');
    // for employee profile updated
    Route::get('/employeeprofile', 'Employeeprofile');
    Route::post('/employeeprofileupdate', 'Employeeprofileupdate')->name('updateemployee.profile');
});
Route::middleware('auth')->group(function(){
    Route::controller(AdminController::class)->group(function(){
     Route::get('/indexdashboard', 'dashboard')->name('admin.dashboard');
                //  department
     Route::get('/department', 'department');
     Route::post('/addepartment', 'addDepartment')->name('add.department');
     Route::get('/pagination/department','paginationdepartment');
     Route::delete('/deletedepartment/{id}', 'departmentDelete');
     Route::post('/updatedepartment', 'departmentUpdate')->name('department.update');
                //  Employee
     Route::get('/adminemployee', 'employeeadmin');
     Route::delete('/employeedelete/{id}', 'employeeDelete');
     Route::get('/pagination/adminemployee','paginationemployee');
     Route::post('/adminupdateemployee', 'empUpdate')->name('adminemployee.update');
        });
    });


Route::middleware('auth')->group(function(){
    Route::controller(EmployeeController::class)->group(function(){
     Route::get('/employee', 'employee')->name('user.index');
     Route::post('/addemp', 'addemployee')->name('addemployee');
     Route::delete('/deleteemployee/{id}', 'deleteEmployee');
     Route::post('/updateemployee', 'employeeUpdate')->name('employee.update');
     Route::get('/pagination/employee','paginationemp');
    });
});

