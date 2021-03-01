<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($status) . ' ' . __('tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status :status="session('status')" class="mb-4 bg-green-500"/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @dd($tickets)
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
