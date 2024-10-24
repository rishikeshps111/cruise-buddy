@props(['status'])

@if ($status)
    <div class="valid-feedback {{ $status ? '' : 'd-none' }}">
        {{ $status }}
    </div>
@endif
