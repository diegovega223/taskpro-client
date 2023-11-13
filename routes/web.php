<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/backlog', function () {
    return view('backlog');
});

Route::get('/create-project', function () {
    return view('create-project');
});

Route::get('/create-task', function () {
    return view('create-task');
});

Route::get('/kanban-board', function () {
    return view('kanban-board');
});

Route::get('/modify-task', function () {
    return view('modify-task');
});

Route::get('/notifications', function () {
    return view('notifications');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/project', function () {
    return view('project');
});


