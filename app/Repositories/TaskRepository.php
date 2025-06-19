<?php
// app/Repositories/TaskRepository.php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    // Create a new task in DB
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    // Get all tasks (optional: you can paginate here)
    public function getAll(): Collection
    {
        return Task::all();
    }

    // Get tasks by user ID
    public function getByUserId(int $userId): Collection
    {
        return Task::where('user_id', $userId)->get();
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}
