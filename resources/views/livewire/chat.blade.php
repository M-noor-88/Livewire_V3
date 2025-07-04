<div class="flex flex-col h-full">

    <div class="flex-grow overflow-y-auto p-4 space-y-2">
        @foreach($messages as $msg)
            <div class="{{ $msg['from_user_id'] === auth()->id() ? 'text-right' : 'text-left' }}">
                <p class="inline-block px-4 py-2 rounded
                          {{ $msg['from_user_id'] === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
                    {{ $msg['message'] }}
                </p>
                <div class="text-xs text-gray-500 mt-1">
                    {{ \Carbon\Carbon::parse($msg['created_at'])->diffForHumans() }}
                </div>
            </div>
        @endforeach
    </div>

    <div class="p-2">
        @if($isTyping)
            <p class="text-gray-400 italic">Typing...</p>
        @endif
    </div>

    <form wire:submit.prevent="sendMessage" class="p-2 flex space-x-2 border-t">
        <input
            wire:model="message"
            wire:keydown="typing"
            type="text"
            class="flex-grow border rounded px-3 py-2"
            placeholder="Type your message...">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Send</button>
    </form>
</div>


@push('scripts')
    <script>
        window.authUserId = @json(auth()->id());
        window.chatReceiverId = @json($receiverId);
    </script>
@endpush
