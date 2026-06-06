@if (session('success'))
    <div id="flash-data" data-status="success" data-message="{{ session('success') }}" class="hidden"></div>
@endif

@if (session('error'))
    <div id="flash-data" data-status="error" data-message="{{ session('error') }}" class="hidden"></div>
@endif
