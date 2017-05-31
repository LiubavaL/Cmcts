@if (!empty($errors))
    @foreach ($errors->get($name) as $message)
        <div class="alert alert_theme_error">
            {{$message}}
        </div>
    @endforeach
@endif