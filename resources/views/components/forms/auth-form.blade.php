@props([
    'method' => 'post',
    'action' => ''
])

<form action="{{ $action }}" method="{{ $method }}" class="space-y-3">
    @csrf
    {{ $slot }}
    
    {{ $buttons }}
</form>