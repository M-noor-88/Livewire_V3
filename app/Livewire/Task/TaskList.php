<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks = [];

    public $editTaskId;
    public $editTitle = '';
    public $editDescription = '';

    public string $heading = 'message.my-tasks';
    #[Url(as: 'filter')]
    public string $filter = 'mine'; // 'mine' or 'all'


    protected $listeners = ['taskCreated' => 'loadTasks'];

    public function mount(TaskService $taskService)
    {
        $this->loadTasks($taskService);
    }


    public function loadTasks(TaskService $taskService)
    {
        $this->tasks = ($this->filter === 'all')
            ? $taskService->getAllTasks()
            : $taskService->getUserTasks(Auth::id());

        $this->updatedFilter();
    }

    public function delete(int $taskId, TaskService $taskService)
    {
        $task = Task::findOrFail($taskId);
        $this->authorize('delete', $task);
        $taskService->deleteTask($task);

        session()->flash('message', 'Task deleted.');
        $this->loadTasks(app(TaskService::class));
    }

    public function updateStatus(int $taskId, string $status, TaskService $taskService)
    {
        $task = Task::findOrFail($taskId);

        $this->authorize('update', $task);

        // Optional: restrict to allowed statuses
        $validStatuses = ['pending', 'in_progress', 'completed'];
        if (!in_array($status, $validStatuses)) {
            abort(400, 'Invalid status');
        }

        $taskService->updateTask($task, ['status' => $status]);

        session()->flash('message', "Task marked as $status.");

        $this->loadTasks(app(TaskService::class));
    }



    public function updatedFilter()
    {
        $this->heading = $this->filter === 'all'
            ? __('message.all-tasks')
            : __('message.my-tasks');
    }

    public function render()
    {
        $this->updatedFilter();
        return view('livewire.task.task-list');
    }
}
