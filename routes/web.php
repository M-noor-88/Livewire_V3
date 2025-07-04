<?php

use App\Http\Controllers\TaskExportController;
use App\Livewire\ChatWrapper;
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

Route::get('/tasks/{task}/pdf', [TaskExportController::class, 'generate'])
    ->middleware(['auth'])
    ->name('tasks.pdf');

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/create', CreateTask::class)->name('tasks.create');
    Route::get('/tasks', TaskList::class)->name('tasks.index');

    Route::get('/change' , [\App\Http\Controllers\LangController::class , 'change'])->name('lang.change');

});


Route::get('/tasks/{id}/edit', EditTask::class)
    ->middleware('auth')
    ->name('tasks.edit');


Route::middleware(['auth'])->group(function () {
    Route::get('/messages', ChatWrapper::class)->name('messages');
});


require __DIR__.'/auth.php';
