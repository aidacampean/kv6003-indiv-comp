@php

$type = session()->has('success') ? 'success' : 'error'

@endphp

@if (session()->has('success') || session()->has('error')) 
    <div class="alert alert-dismissible alert-<?= $type ?>" role="alert" aria-live="polite" aria-atomic="true">
    {{ session('success') ?? session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span>&times;</span>
    </button>
</div>
@endif