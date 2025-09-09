
{{--THIRD STYLE --}}

<div class="flex flex-col h-[80vh] backdrop-blur-lg rounded-br-2xl border border-white/30 shadow-xl overflow-hidden">

    <!-- Message Area -->
    <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-100 backdrop-blur-sm">
        @foreach($messages as $msg)
            <div class="flex {{ $msg['from_user_id'] === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[70%]">
                    <div class="flex items-end gap-2 {{ $msg['from_user_id'] === auth()->id() ? 'flex-row-reverse' : '' }}">
                        <img src="https://ui-avatars.com/api/?name=U{{ $msg['from_user_id'] }}" class="w-8 h-8 rounded-full shadow-md ring-1 ring-white/30">

                        <div class="
                            px-5 py-3 rounded-2xl shadow-md transition-all duration-300 transform animate-fade-in-up
                            {{ $msg['from_user_id'] === auth()->id()
                                ? 'bg-gradient-to-br from-blue-600 to-blue-800 text-white'
                                : 'bg-emerald-200  text-gray-900' }}
                        ">
                            <p class="text-sm break-words">{{ $msg['message'] }}</p>
                            <div class="text-[10px] text-gray-400 mt-1 text-right">
                                {{ \Carbon\Carbon::parse($msg['created_at'])->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Typing Indicator -->
    <div wire:poll.1000ms="resetTyping">
        @if($isTyping)
            <div class="px-6 py-2 text-sm italic text-gray-600 bg-white/20 backdrop-blur transition-all duration-300 transform animate-fade-in-up">
                Typing…
            </div>
        @endif
    </div>


    <!-- Message Input -->
    <form wire:submit.prevent="sendMessage" class="flex items-center px-6 py-4 bg-gray-200 backdrop-blur border-t border-white/20 space-x-3">
        <input
            wire:model="message"
            wire:keydown.debounce.300ms="typing"
            type="text"
            class="flex-grow bg-white/50 backdrop-blur-md text-gray-800 border border-white/20 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-400"
            placeholder="iMessage…">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full shadow-md transition-all duration-150">
            Send
        </button>
    </form>

</div>


@push('scripts')
    <script>
        window.authUserId = @json(auth()->id());
        window.chatReceiverId = @json($receiverId);
    </script>
@endpush
