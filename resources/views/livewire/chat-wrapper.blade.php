
{{--<div class="flex h-[600px] border rounded overflow-hidden shadow-lg">--}}
{{--    <!-- Sidebar -->--}}
{{--    <div class="w-1/4 bg-gray-100 border-r overflow-y-auto">--}}
{{--        <div class="p-4 font-bold text-lg border-b">Users</div>--}}
{{--        @foreach($users as $user)--}}
{{--            <div wire:click="selectUser({{ $user->id }})"--}}
{{--                 class="p-3 cursor-pointer hover:bg-gray-200 transition--}}
{{--                 {{ $selectedUserId === $user->id ? 'bg-blue-100 font-semibold' : '' }}">--}}
{{--                🧑 {{ $user->name }}--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}

{{--    <!-- Chat area -->--}}
{{--    <div class="w-3/4 relative">--}}
{{--        @if($selectedUserId)--}}
{{--            <livewire:chat :receiverId="$selectedUserId" :key="$selectedUserId" />--}}
{{--        @else--}}
{{--            <div class="h-full flex items-center justify-center text-gray-400">--}}
{{--                Select a user to start chatting.--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}
<div class="flex h-[600px] bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-lg">

    <!-- Sidebar / User List -->
    <div class="w-1/4 bg-gradient-to-b from-gray-100 to-gray-200 border-r overflow-y-auto">
        <div class="px-4 py-3 border-b text-lg font-semibold text-gray-700 flex items-center justify-between">
            <span>💬 Chats</span>
        </div>

        @foreach($users as $user)
            <div wire:click="selectUser({{ $user->id }})"
                 class="px-4 py-3  flex items-center space-x-2 p-3 cursor-pointer hover:bg-blue-200 transition-all duration-200 ease-in-out rounded-xl

                 {{ $selectedUserId === $user->id ? 'bg-blue-200 text-blue-800 font-semibold' : 'text-gray-700' }}">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                     class="w-8 h-8 rounded-full shadow-sm">



                <div class="flex-1   truncate ">

                    <div class="truncate gap-1.5 flex items-center justify-between">

                        {{ $user->name }}

                        <div class="justify-end relative">
                            @if($user->isOnline())
                                <span class="text-green-500 text-xs font-medium">Online</span>
                            @else
                                <span class="text-gray-400 text-xs">Last seen {{ $user->last_seen_at ? $user->last_seen_at->diffForHumans() : '—' }}</span>
                            @endif


                                {{-- Online Status Indicator --}}
                                @if($user->isOnline())
                                    <span class="absolute bottom-1.5 -left-4  w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                @else
                                    <span class="absolute bottom-1.5 -left-4  w-3 h-3 bg-gray-400 border-2 border-white rounded-full"></span>
                                @endif

                        </div>


                    </div>





                    <small class="text-gray-500 text-xs truncate mx-1 " dir="auto">{{ $user->lastMessageText }}</small>
                    <span class="text-xs text-gray-400 ">{{ $user->lastMessageTime }}</span>

                </div>
            </div>
        @endforeach
    </div>

    <!-- Chat Area -->
    <div class="flex-1 bg-gradient-to-br from-white to-gray-50 relative rounded-3xl">
        @if($selectedUserId)

            @push('scripts')
                <script>
                    window.authUserId = @json(auth()->id());
                    window.chatReceiverId = @json($selectedUserId);
                </script>
            @endpush

            <livewire:chat :receiverId="$selectedUserId" :key="$selectedUserId" />
        @else
            <div class="h-full flex items-center justify-center text-gray-400 text-lg font-medium">
                👈 Select a user to start chatting.
            </div>
        @endif
    </div>

</div>


