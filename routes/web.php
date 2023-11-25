<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

Route::get('/', function () { return view('index'); });

Route::get('/register', function () { return view('register');});
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', function () { return view('login'); });
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware(['access'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/create-project', function () { return view('create-project'); });
    Route::post('/create-project', [ProjectController::class, 'createProject'])->name('createProject');
    Route::get('/delete-project/{id}', [ProjectController::class, 'deleteProject'])->name('deleteProject');
    Route::get('/project', [ProjectController::class, 'showUserProjects'])->name('project');


    Route::get('/search/{user}', [UserController::class, 'search'])->name('search');
    Route::get('/SearchProjectUser/{project}/{user}', [UserController::class, 'SearchProjectUserByName'])->name('SearchProjectUserByName');
    
    Route::get('/backlog/{project}', [TaskController::class, 'showBacklog'])->name('backlog');
    Route::post('/backlog/{project}', [TaskController::class, 'listTasksByTitle'])->name('listTasksByTitle');

    Route::get('/task/{project}/{id}', [TaskController::class, 'getTask'])->name('getTask');
    
    Route::get('/delete-task/{project}/{id}', [TaskController::class, 'deleteTask'])->name('deleteTask');
    
    Route::post('/modify-subtask/{id}', [TaskController::class, 'updateSubTask'])->name('updateSubTask');
    
    Route::post('/create-task/{project}', [TaskController::class, 'createTask'])->name('createTask');
    Route::get('/create-task/{project}', function () { return view('create-task'); });

    Route::get('/modify-task/{project}/{id}', [TaskController::class, 'getModifyTask'])->name('modifyTask');
    Route::post('/backlog/{project}', [TaskController::class, 'listTasksByTitle'])->name('listTasksByTitle'); 

    Route::get('/kanban-board/{project}', [TaskController::class, 'getKanban'])->name('getKanban');
    Route::post('/changeStateTask/{project}/{id}', [TaskController::class, 'changeStateTask'])->name('changeStateTask');

    Route::get('/modify-task/{project}', function () { return view('modify-task'); });
    Route::get('/notifications/{project}', function () { return view('notifications'); });
    Route::get('/profile/{project}', function () { return view('profile'); });


});

