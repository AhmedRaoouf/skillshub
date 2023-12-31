@if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
