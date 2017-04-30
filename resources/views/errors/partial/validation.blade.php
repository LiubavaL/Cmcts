@if (!empty($errors))
    @foreach ($errors->get($name) as $message)
        <div class="alert alert-danger alert-block">
            {{$message}}
        </div>
    @endforeach
@endif