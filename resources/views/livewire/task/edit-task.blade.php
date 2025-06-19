<!-- resources/views/livewire/task/edit-task.blade.php -->

<div class="max-w-2xl mx-auto py-12 px-6 bg-white rounded shadow-lg mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Task</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Title</label>
            <input type="text" wire:model="title" class="w-full border p-2 rounded" />
            @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea wire:model="description" rows="4" class="w-full border p-2 rounded"></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:underline">← Back to Tasks</a>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" type="submit">
                Save Changes
            </button>
        </div>
    </form>
</div>
