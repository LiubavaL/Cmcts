<div class="col-md-4 portfolio-item">
    {{--<small>{{$loop->iteration}}</small>--}}
    <a href="/comic/{{$comic->slug}}">
        <img class="img-responsive" src="{{'/images/'.$comic->cover}}" alt="">
    </a>
    <div class="card-block">
        <a href="/profile/{{$comic->user_id}}">
           <img class="img-circle" src="/storage/profile/{{$comic->author_image}}" width="50" height="auto">
           <span style="margin-left: 5px; color: #8c8c8c">
            {{$comic->author_name}}
           </span>
        </a>
    </div>
    <h3>
        <a href="/comic/{{$comic->slug}}">{{$comic->title}}</a>
    </h3>
    <p>{{$comic->description}}</p>
</div>