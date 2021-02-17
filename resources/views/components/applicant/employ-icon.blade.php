@props([
    'color' => 'green-500',
    'method' => 'PUT',
    'can' => 'true',
])
<form {{ $attributes->merge(['class' => 'inline-flex', 'method' => strtolower($method ?? 'GET') === 'get' ? 'GET' : 'POST']) }}>
    @csrf
    @method($method)
    @can($can)
    <button class="{{ "text-$color" }}">
        <i class="far fa-smile"></i>
    </button>
    @else
        <button class="{{ "cursor-not-allowed opacity-50 text-$color" }}" disabled>
            <i class="far fa-smile"></i>
        </button>
    @endcan
</form>

