<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applicants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status :status="session('status')" class="mb-4 bg-green-500"/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__('Name')}}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__('Email')}}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__('Date')}}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__('Employ')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($applicants as $applicant)
                        <tr>
                            {{-- name --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $applicant->user->name }}
                                    </div>
                                </div>
                            </td>
                            {{-- email --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <x-link :href="('mailto:' . $applicant->user->email)">
                                        {{ $applicant->user->email }}
                                    </x-link>
                                </div>
                            </td>
                            {{-- date --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $applicant->created_at->toFormattedDateString() }}
                                </div>
                            </td>
                            {{-- employ buttons --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- employ button --}}
                                <x-applicant.employ-button
                                    :route="'applicant.employ'"
                                    :method="'PUT'"
                                    :policy="'employ'"
                                    :applicant="$applicant"
                                    :color="'green-500'"
                                    :icon="'far fa-smile'"
                                />

                                {{-- queue button --}}
                                <x-applicant.employ-button
                                    :route="'applicant.queue'"
                                    :method="'PUT'"
                                    :policy="'queue'"
                                    :applicant="$applicant"
                                    :color="'yellow-500'"
                                    :icon="'far fa-smile'"
                                />

                                {{-- reject button --}}
                                <x-applicant.employ-button
                                    :route="'applicant.reject'"
                                    :method="'DELETE'"
                                    :policy="'reject'"
                                    :applicant="$applicant"
                                    :color="'red-500'"
                                    :icon="'far fa-smile'"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900 font-semibold">
                                        {{ __('No applicants found.') }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
