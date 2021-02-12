<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
{{--                    <table class="table w-full">--}}
{{--                        <thead>--}}
{{--                        <tr class="text-left">--}}
{{--                            <th>Name</th>--}}
{{--                            <th>Email</th>--}}
{{--                            <th>Date</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @forelse($applicants as $applicant)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $applicant->name }}</td>--}}
{{--                                <td>{{ $applicant->email }}</td>--}}
{{--                                <td>{{ $applicant->created_at->toFormattedDateString() }}</td>--}}
{{--                            </tr>--}}
{{--                            @empty--}}
{{--                                <p>{{ __('No applicants') }}</p>--}}
{{--                        @endforelse--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
                    @empty(!$applicants)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applicants as $applicant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $applicant->name }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $applicant->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $applicant->created_at->toFormattedDateString() }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        @else
                            <p>{{ __('No applicants') }}</p>
                    @endempty

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
