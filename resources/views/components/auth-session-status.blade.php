@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-white px-6 py-4 border-0 rounded relative']) }}>
        <span class="inline-block align-middle mr-8">
            {{ $status }}
        </span>
    </div>
@endif
