@if (session('success'))
    <div class="alert alert-success text-capitalize" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-capitalize" role="alert">
        {{ session('error') }}
    </div>
@endif
