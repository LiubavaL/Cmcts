@extends('vendor.notifications.base-layout.email-base-layout')

@section('title', 'New Comic Subscriber')

@section('content')
    <p style="margin:20px 0">
        <a href="https://comicats.heroku.com/profile/{{$subscriptor->id}}" style="color:#f60066">{{$subscriptor->name}}</a> leaved new responce on your comic {{$comic->title}}!
    </p>
@endsection