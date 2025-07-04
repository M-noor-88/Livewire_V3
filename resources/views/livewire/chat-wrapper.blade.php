
<div class="flex h-[600px] border rounded overflow-hidden shadow-lg">
    <!-- Sidebar -->
    <div class="w-1/4 bg-gray-100 border-r overflow-y-auto">
        <div class="p-4 font-bold text-lg border-b">Users</div>
        @foreach($users as $user)
            <div wire:click="selectUser({{ $user->id }})"
                 class="p-3 cursor-pointer hover:bg-gray-200 transition
                 {{ $selectedUserId === $user->id ? 'bg-blue-100 font-semibold' : '' }}">
                🧑 {{ $user->name }}
            </div>
        @endforeach
    </div>

    <!-- Chat area -->
    <div class="w-3/4 relative">
        @if($selectedUserId)
            <livewire:chat :receiverId="$selectedUserId" :key="$selectedUserId" />
        @else
            <div class="h-full flex items-center justify-center text-gray-400">
                Select a user to start chatting.
            </div>
        @endif
    </div>
</div>
