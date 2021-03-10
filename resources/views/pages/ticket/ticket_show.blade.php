<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket') }}
        </h2>
    </x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status :status="session('status')" class="mb-4 bg-green-500"/>
            <div class="divide-y divide-gray-300 divide-solid">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-t-lg p-8 flex flex-column">
                    {{-- left --}}
                    <div class="flex-1">
                        <div class="mb-6">
                            {{-- category --}}
                            <div class="text-sm text-gray-400">
                                {{ $ticket->category->name }}
                            </div>
                            {{-- subject --}}
                            <strong class="text-xl">{{ $ticket->subject }}</strong>
                        </div>
                        {{-- customer --}}
                        <div class="flex">
                            {{-- avatar --}}
                            <div class="h-14 w-14 rounded-full bg-{{ $ticket->creating_user->color() }}-600 text-white text-xl flex justify-center items-center">
                                {{ $ticket->creating_user->initials() }}
                            </div>
                            <div class="ml-4">
                                <div class="text-lg">
                                    {{ $ticket->creating_user->name }} ( <a class="underline text-blue-500" href="mailto:{{$ticket->creating_user->email}}">{{ $ticket->creating_user->email }}</a> )
                                </div>
                                <div class="text-gray-400">
                                    {{ $ticket->created_at->toFormattedDateString() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- right --}}
                    <div class="flex-1">
                        {{-- status --}}
                        <div>
                            <div class="text-sm text-gray-400">
                                {{ __('Status') }}
                            </div>
                            <strong class="text-xl">{{ $ticket->status() }}</strong>
                        </div>
                        {{-- employees --}}
                        @can('read_employee_names')
                            <div class="text-lg">
                                {{ __('Processed by') . ' ' . ($ticket->processing_users->isNotEmpty() ? $ticket->processing_users()->pluck('name')->join(', ',' and ') : __('Nobody'))}}
                            </div>
                        @endcan
                    </div>
                </div>
                {{-- bottom --}}
                <div class="bg-white overflow-hidden shadow-sm p-6 flex flex-column">
                    {{-- content --}}
                    <div class="flex-1">
                        <div class="text-lg">
                            {!! nl2br(e($ticket->contents)) !!}
                        </div>
                    </div>
                </div>
                {{-- comments --}}
                @can('comment',$ticket)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg p-6 flex flex-column">
                    <a href="#commentform" class="w-full"/>
                    <form action="{{route('ticket.comment.store',['ticket' => $ticket])}}" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <x-errored-label for="contents" :value="__('Comment')" :field="'contents'" class="block text-lg font-medium text-gray-700"/>
                            <div class="mt-1 w-full">
                                <x-textarea id="contents" class="block mt-1 w-full" name="contents">{{ old('contents') }}</x-textarea>
                            </div>
                        </div>
                        <div class="flex justify-end mt-1">
                            <x-button>
                                {{ __('Send your comment') }}
                            </x-button>
                        </div>
                    </form>
                </div>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
