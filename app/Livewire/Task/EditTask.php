<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Services\TaskService;
use Livewire\Component;

class EditTask extends Component
{

    public Task $task;
    public string $title;
    public string $description;

    public function mount($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('update', $task);

        $this->task = $task;
        $this->title = $task->title;
        $this->description = $task->description;
    }

    public function update(TaskService $taskService)
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $this->authorize('update', $this->task); // ✅ Enforce again

        $taskService->updateTask($this->task, [
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Task updated successfully.');
        return redirect()->route('tasks.index');
    }



    public function render()
    {
        return view('livewire.task.edit-task');
    }
}
