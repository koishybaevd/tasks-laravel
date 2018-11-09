@if ($errors->any())
    <div class="alert alert-danger mt-2 mb-0">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif