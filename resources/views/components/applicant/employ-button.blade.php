@props([
    'color',
    'method',
    'policy',
    'route',
    'icon',
    'applicant'
])
<form action="{{route($route, ['applicant' => $applicant])}}" {{ $attributes->merge(['class' => 'inline-flex', 'method' => strtoupper($method) === 'GET' ? 'GET' : 'POST']) }}>
    @csrf
    @method($method)
    @can($policy, $applicant)
    <button class="{{ "text-$color" }}">
        <i class="{{$icon}}"></i>
    </button>
    @else
        <button class="{{ "cursor-not-allowed opacity-50 text-$color" }}" disabled>
            <i class="{{$icon}}"></i>
        </button>
    @endcan
</form>

