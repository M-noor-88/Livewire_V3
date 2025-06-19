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
    }

    public function toggleTaskView(TaskService $taskService)
    {
        $this->showAll = !$this->showAll;
        $this->loadTasks($taskService);
    }

    public function delete(int $taskId, TaskService $taskService)
    {
        $task = Task::findOrFail($taskId);
        $this->authorize('delete', $task);
        $taskService->deleteTask($task);

        session()->flash('message', 'Task deleted.');
        $this->loadTasks(app(TaskService::class));
    }



    public function render()
    {
        return view('livewire.task.task-list');
    }
}
