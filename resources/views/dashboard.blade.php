<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">



                <div class="p-6 text-gray-900">
                    {{ __("You're Task . dashboard blade  !") }}
                </div>

                {{-- Success message --}}
                <div x-data="{ show: @if(session()->has('message')) true @else false @endif }"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-show="show"
                     x-transition:leave.duration.500ms
                     class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                     role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>

                <livewire:task.task-list />
            </div>

        </div>
    </div>
</x-app-layout>
