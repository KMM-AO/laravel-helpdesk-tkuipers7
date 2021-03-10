@props([
    'user',
    'colors'
])
<div class="h-12 w-12 rounded-full bg-{{ $user->color($colors) }}-600 text-white text-lg flex justify-center items-center">
    {{ $user->initials() }}
</div>
