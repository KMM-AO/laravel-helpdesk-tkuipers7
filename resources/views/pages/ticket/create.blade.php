<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('ticket.store') }}" class="p-14">
                @csrf

                    <!-- Subject -->
                    <div>
                        <x-errored-label for="subject" :value="__('Subject')" :field="'subject'" />

                        <x-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" autofocus />
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <x-errored-label for="contents" :value="__('Contents')" :field="'contents'" />

                        <x-textarea id="contents" class="block mt-1 w-full" name="contents">{{ old('contents') }}</x-textarea>
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-errored-label for="category" :value="__('Category')" :field="'category'"/>

                        <x-select id="category" size="{{ $categories->count() }}" class="block mt-1 w-full" name="category">
                            @foreach($categories as $category)
                                <option {{ $category->id == old('category') ? 'selected' : '' }} value="{{$category->id}}" >{{ $category->name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Create a ticket') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
