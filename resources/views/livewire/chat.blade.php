<div class="chat-container">
    <div class="messages h-64 overflow-auto border p-4 mb-4">
        @foreach($messages as $msg)
            <div class="{{ $msg['from_user_id'] === auth()->id() ? 'text-right' : 'text-left' }}">
                <p class="inline-block bg-gray-200 rounded px-3 py-1">
                    {{ $msg['message'] }}
                </p>
                <small class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($msg['created_at'])->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMessage" class="flex space-x-2">
        <input wire:model="message" type="text" class="flex-grow border rounded px-3 py-2" placeholder="Type your message...">
        <button type="submit" class="bg-blue-600 text-white px-4 rounded">Send</button>
    </form>
</div>
