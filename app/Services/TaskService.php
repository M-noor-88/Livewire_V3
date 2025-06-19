<?php
// app/Services/TaskService.php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
    }

    public function getAllTasks(): Collection
    {
        return $this->taskRepository->getAll();
    }

    public function getUserTasks(int $userId): Collection
    {
        return $this->taskRepository->getByUserId($userId);
    }

    public function updateTask(Task $task, array $data): bool
    {
        return $this->taskRepository->update($task, $data);
    }

    public function deleteTask(Task $task): bool
    {
        return $this->taskRepository->delete($task);
    }
}
