<?php

namespace App\Livewire\Task;

use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateTask extends Component
{
    public string $title = '';
    public string $description = '';

    protected array $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    public function create(TaskService $taskService)
    {
        $this->validate();

        $taskService->createTask([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'status' => 'pending',
        ]);

        session()->flash('message', 'Task created successfully!');

        $this->reset(['title', 'description']);
        $this->redirect('/dashboard' , navigate: true);
    }



    public function render()
    {
        return view('livewire.task.create-task');
    }
}
