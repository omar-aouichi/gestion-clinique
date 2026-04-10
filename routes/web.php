<?php

use Illuminate\Support\Facades\Route;

// Patient Portal
Route::get('/patient', function () {
    return view('patient.dashboard');
});

// Secretary Portal
Route::get('/secretary', function () {
    return view('secretary.appointments');
});
Route::get('/secretary/create-patient', function () {
    return view('secretary.create_patient');
});

// Doctor & Nurse Portal
Route::get('/staff', function () {
    return view('staff.schedule');
});

// HR Manager Portal
Route::get('/hr', function () {
    return view('hr.dashboard');
});

// Super Admin Portal
Route::get('/admin', function () {
    return view('admin.dashboard');
});
// Public Website Routes
Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/signup', function () {
    return view('auth.signup');
});
