<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status :status="session('status')" class="mb-4 bg-green-500"/>
            <div class="divide-y divide-gray-300 divide-solid">
                <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-t-lg p-8 flex">
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
                            <x-user-avatar :user="$ticket->creating_user" :colors="config('custom.user_palette')"  class="h-14 w-14 text-xl"/>
                            {{-- info --}}
                            <div class="ml-4">
                                {{-- name --}}
                                <div class="text-lg">
                                    {{ $ticket->creating_user->name }} ( <a class="underline text-blue-500" href="mailto:{{$ticket->creating_user->email}}">{{ $ticket->creating_user->email }}</a> )
                                </div>
                                {{-- created at --}}
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
                    @can('close',$ticket)
                        <form action="{{route('ticket.close',['ticket' => $ticket])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <x-button>{{ __('close ticket') }}</x-button>
                        </form>
                    @endcan
                    @can('claim',$ticket)
                        <form action="{{route('ticket.claim',['ticket' => $ticket])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <x-button>{{ __('claim ticket') }}</x-button>
                        </form>
                    @endcan
                </div>
                {{-- bottom --}}
                <div class="bg-white overflow-hidden shadow-sm p-6 flex">
                    {{-- content --}}
                    <div class="flex-1">
                        <div class="text-lg">
                            {!! nl2br(e($ticket->contents)) !!}
                        </div>
                    </div>
                </div>
                {{-- comments --}}
                @if($comments->isNotEmpty())
                <div class="bg-white overflow-hidden shadow-sm flex flex-col">
                    @foreach($comments as $comment)
                        <div class="flex" id="comment{{ $comment->id }}">
                            {{-- comment user --}}
                            <div class="flex bg-gray-50 p-6">
                                @can('read_user_info',$comment)
                                    <x-user-avatar :user="$comment->user" :colors="config('custom.user_palette')" class="h-12 w-12"/>
                                @else
                                    <x-application-logo class="block h-12 w-auto" />
                                @endcan
                                <div class="flex flex-col ml-4">
                                    <span class="text-lg">
                                        @can('read_user_info',$comment)
                                            {{ $comment->user->name }}
                                        @else
                                            {{ __('Helpdesk') }}
                                        @endcan
                                    </span>
                                    <span class="text-sm text-gray-400">
                                        {{ $comment->created_at->diffForHumans(\Carbon\Carbon::now()) }}
                                    </span>
                                </div>
                            </div>
                            {{-- comment info --}}
                            <div class="flex p-6">
                                {!! nl2br(e($comment->contents)) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                {{-- comment form --}}
                @can('comment',$ticket)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg p-6 flex">
                    <form action="{{route('ticket.comment',['ticket' => $ticket])}}" id="commentform" method="POST" class="w-full">
                        @csrf
                        <div>
                            <x-errored-label for="contents" :value="__('Comment')" :field="'contents'" class="block text-lg font-medium text-gray-700"/>
                            <div class="mt-1 w-full">
                                <x-textarea id="contents" class="block mt-1 w-full" name="contents">{{ old('contents') }}</x-textarea>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
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
