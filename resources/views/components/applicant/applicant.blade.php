<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="text-sm font-medium text-gray-900">
                {{ $applicant->user->name }}
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">
            <x-link :href="('mailto:' . $applicant->user->email)">
                {{ $applicant->user->email }}
            </x-link>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">
            {{ $applicant->created_at->toFormattedDateString() }}
        </div>
    </td>
</tr>
