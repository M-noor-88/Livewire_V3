<div class="bg-white p-6 rounded-lg shadow-xl mt-8">


    <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">
        {{ $this->heading }}  <!-- Access the computed property -->
    </h2>


@if (count($tasks) === 0)
        <div class="text-center py-8">
            <p class="text-gray-600 text-lg">You haven't added any tasks yet. Let's create your first one!</p>

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

                            <a href="{{ route('tasks.pdf', ['task' => $task['id']]) }}"
                               target="_blank"
                               class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                Generate PDF
                            </a>


                        </div>


                        <div class="flex gap-2">
                            @foreach (['pending', 'in_progress', 'completed'] as $status)
                                @if ($task['status'] !== $status)
                                    <button wire:click="updateStatus({{ $task['id'] }}, '{{ $status }}')"
                                            class="text-sm px-2 py-1 rounded
                           {{ $status === 'completed' ? 'bg-green-200 text-green-700' :
                              ($status === 'in_progress' ? 'bg-blue-200 text-blue-700' : 'bg-yellow-200 text-yellow-700') }}">
                                        Mark {{ ucfirst($status) }}
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    @endif

                </div>
            @endforeach



        </div>
    @endif
</div>
