@extends('layouts.app')
@section('content')
<div class="container">
  @foreach ( $images as $image)
    <h1 class="bd-title" id="content"><a class="anchorjs-link " href="#content" aria-label="Anchor link for: content" data-anchorjs-icon="" style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>
    </h1>
    <img src="{{'/images/test/'.$image->name}}" width="150" height="auto"/>
  @endforeach
</div>
@endsection