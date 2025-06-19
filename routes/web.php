<?php

use App\Livewire\Task\CreateTask;
use App\Livewire\Task\EditTask;
use App\Livewire\Task\TaskList;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');



Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/create', CreateTask::class)->name('tasks.create');
    Route::get('/tasks', TaskList::class)->name('tasks.index');


});


Route::get('/tasks/{id}/edit', EditTask::class)
    ->middleware('auth')
    ->name('tasks.edit');


require __DIR__.'/auth.php';
