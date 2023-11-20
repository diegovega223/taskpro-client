<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () { return view('index'); });
Route::get('/register', function () { return view('register');});
Route::get('/login', function () { return view('login'); });
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/create-project', [ProjectController::class, 'createProject'])->name('createProject');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/search/{user}', [UserController::class, 'search'])->name('search');
Route::get('/backlog', function () { return view('backlog'); });
Route::get('/project', [ProjectController::class, 'showUserProjects']);
Route::get('/create-project', function () { return view('create-project'); });
Route::get('/create-task', function () { return view('create-task'); });
Route::get('/kanban-board', function () { return view('kanban-board'); });
Route::get('/modify-task', function () { return view('modify-task'); });
Route::get('/notifications', function () { return view('notifications'); });
Route::get('/profile', function () { return view('profile'); });