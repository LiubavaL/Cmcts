@extends('vendor.notifications.base-layout.email-base-layout')

@section('title', 'New Reaction!')

@section('content')
    <p style="margin:20px 0">
        <a href="https://comicats.heroku.com/profile/{{$rater->id}}" style="color:#f60066">{{$rater->name}}</a> is reacted on your comic {{$comic->title}}!
    </p>
@endsection