@extends('vendor.notifications.base-layout.email-base-layout')

@section('title', 'New Responce')

@section('content')
    <p style="margin:20px 0">
        <a href="https://comicats.heroku.com/profile/{{$responcer->id}}" style="color:#f60066">{{$responcer->name}}</a> leaved new responce on your comic {{$comic->title}}!
    </p>
@endsection