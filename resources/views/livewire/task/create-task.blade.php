<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-xl mt-10">
    {{-- Success message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
            {{-- Optional: Add a close button for the alert --}}
            {{-- <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 2.65a1.2 1.2 0 1 1-1.697-1.697L8.303 10l-2.651-2.651a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-2.651a1.2 1.2 0 1 1 1.697 1.697L11.697 10l2.651 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span> --}}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create New Task</h2>

    <form wire:submit.prevent="create" class="space-y-5"> {{-- Increased spacing between elements --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Task Title</label>
            <input
                type="text"
                wire:model.lazy="title"
                id="title"
                placeholder="e.g., Finish project report"
                class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            />
            @error('title') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Task Description (optional)</label>
            <textarea
                wire:model.lazy="description"
                id="description"
                placeholder="Provide more details about the task..."
                rows="4" {{-- Added rows for better initial sizing --}}
                class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm resize-y" {{-- resize-y allows vertical resizing --}}
            ></textarea>
            @error('description') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <button
            type="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out"
        >
            Create Task
        </button>
    </form>
</div>
