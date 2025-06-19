<div class="bg-white p-6 rounded-lg shadow-xl mt-8">


    <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">My Tasks</h2>



@if (count($tasks) === 0)
        <div class="text-center py-8">
            <p class="text-gray-600 text-lg">You haven't added any tasks yet. Let's create your first one!</p>
            {{-- Optional: Add a button to create a new task if you have a separate component/route for it --}}
            {{-- <button class="mt-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create New Task
            </button> --}}
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3"> {{-- Responsive grid layout --}}
            @foreach ($tasks as $task)
                <div class="bg-gray-50 border border-gray-200 p-5 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $task['title'] }}</h3>

                    <p class="text-gray-700 text-base mb-3 leading-relaxed">
                        {{ $task['description'] ?? 'No description provided.' }} {{-- More user-friendly if description is null --}}
                    </p>

                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span class="font-medium">Status:
                            @php
                                $statusClass = '';
                                switch ($task['status']) {
                                    case 'pending':
                                        $statusClass = 'text-yellow-700 bg-yellow-100';
                                        break;
                                    case 'completed':
                                        $statusClass = 'text-green-700 bg-green-100';
                                        break;
                                    case 'in-progress':
                                        $statusClass = 'text-blue-700 bg-blue-100';
                                        break;
                                    default:
                                        $statusClass = 'text-gray-700 bg-gray-100';
                                        break;
                                }
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                {{ ucfirst($task['status']) }}
                            </span>
                        </span>
                        {{-- Optional: Add other info like creation date --}}
                         @if (isset($task['created_at']))
                            <span class="text-xs text-gray-400">Created: {{ \Carbon\Carbon::parse($task['created_at'])->diffForHumans() }}</span>
                        @endif
                    </div>

                    {{-- Optional: Add action buttons --}}

                    @php
                        $isOwner = Auth::id() == ($task['user_id'] ?? null);
                    @endphp

                    @if ($isOwner)
                        <div class="mt-4 flex justify-end space-x-2">
                            <a href="{{ route('tasks.edit', ['id' => $task['id']]) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Edit
                            </a>

                            <button wire:click="delete({{ $task['id'] }})"
                                    onclick="return confirm('Are you sure?')"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Delete
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach



        </div>
    @endif
</div>
