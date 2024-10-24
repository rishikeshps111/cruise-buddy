@props(['messages'])

<div class="invalid-feedback {{ $messages ? '' : 'd-none' }}">
    @if ($messages)
        @foreach ((array) $messages as $message)
            <p>{{ $message }}</p>
        @endforeach
    @endif
</div>