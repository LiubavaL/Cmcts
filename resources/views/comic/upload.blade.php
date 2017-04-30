@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-block">
            {{session('success')}}
        </div>
    @endif
    {{phpinfo()}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Добавить новую работу</div>
                <div class="panel-heading">
                    <form action="/comic/create" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'title'])

                                <input type="text" name="title" class="form-control" placeholder="Название*" value="{{old('title')}}">
                            </div>
                            <div class="col-md-12">
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'description'])

                                <input type="text" name="description" class="form-control" placeholder="Описание*" value="{{old('description')}}">
                            </div>
                            <div class="col-md-12">
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'genres'])

                                <label>Жанры *</label>
                                <select multiple class="form-control" style="overflow: scroll" name="genres[]">
                                    @foreach ($genres as $genre)                              
                                        <option value="{{$genre->id}}" {{( old('genres') == $genre->id ) ? 'selected' : '' }}>{{$genre->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                 @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'comic_status'])

                                <label class="form-check-labexl">Статус *</label>
                                <select class="form-control" name="comic_status">
                                  @foreach ($comicStatuses as $comicStatus)                              
                                      <option value="{{$comicStatus->id}}" {{ (old('comic_status') == $comicStatus->id) ? 'selected' : '' }}>{{$comicStatus->title}}</option>
                                  @endforeach
                                </select>   
                            </div>
                            <div class="col-md-12">
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'single'])

                                <label class="form-check-labexl">
                                  <input type="checkbox" name="single" class="form-check-input">
                                  Сингл
                                </label>   
                            </div>
                            <div class="col-md-12">
                                <label class="form-check-labexl">
                                  <input type="checkbox" name="adult_content" class="form-check-input"  value="{{ (old('adult_content')) ? 'selected' : ''}}">
                                  Содержит контент для взрослых
                                </label>   
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'cover'])

                                <label class="form-check-labexl">Обложка</label>
                                <input type="file" name="cover" value="{{old('cover')}}"/>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-check-labexl">Загрузка глав</label>
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.0.title'])

                                <input type="text" name="volume[0][title]" class="form-control" placeholder="Том" value="{{old('volume.0.title')}}">

                                <div class="col-md-12">
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.0.chapter.0.title'])

                                    <input type="text" name="volume[0][chapter][0][title]" class="form-control" placeholder="Глава" value="{{old('volume.0.chapter.0.title')}}">

                                    <label class="form-check-labexl">Выберите zip-архив с изображениями</label>
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.0.chapter.0.chapter_images'])

                                    <input type="file" name="volume[0][chapter][0][chapter_images]" value="{{old('volume.0.chapter.0.chapter_images')}}"/>
                                </div>
                                <div class="col-md-12">
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.0.chapter.1.title'])

                                    <input type="text" name="volume[0][chapter][1][title]" class="form-control" placeholder="Глава" value="{{old('volume.0.chapter.1.title')}}">

                                    <label class="form-check-labexl">Выберите zip-архив с изображениями</label>
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.0.chapter.1.chapter_images'])

                                    <input type="file" name="volume[0][chapter][1][chapter_images]" value="{{old('volume.0.chapter.1.chapter_images')}}"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.1.title'])

                                <input type="text" name="volume[1][title]" class="form-control" placeholder="Том" value="{{old('volume.1.title')}}">

                                <div class="col-md-12">
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.1.chapter.0.title]'])

                                    <input type="text" name="volume[1][chapter][0][title]" class="form-control" placeholder="Глава" value="{{old('volume.1.chapter.0.title]')}}">

                                    <label class="form-check-labexl">Выберите zip-архив с изображениями</label>
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.1.chapter.0.chapter_images'])

                                    <input type="file" name="volume[1][chapter][0][chapter_images]" value="{{old('volume.0.chapter.1.chapter_images')}}"/>
                                </div>
                            </div>
                            {{--<div class="col-md-12">
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.2.title'])

                                <input type="text" name="volume[2][title]" class="form-control" placeholder="Том">
                                <div class="col-md-12">
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.2.chapter.0.title]'])

                                    <input type="text" name="volume[2][chapter][0][title]" class="form-control" placeholder="Глава">
                                    <label class="form-check-labexl">Выберите zip-архив с изображениями</label>
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.2.chapter.0.chapter_images]'])

                                    <input type="file" name="volume[2][chapter][0][chapter_images]" />
                                </div>
                                <div class="col-md-12">
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.2.chapter.1.title'])

                                    <input type="text" name="volume[2][chapter][1][title]" class="form-control" placeholder="Глава">
                                    <label class="form-check-labexl">Выберите zip-архив с изображениями</label>
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.2.chapter.1.chapter_images]'])

                                    <input type="file" name="volume[2][chapter][1][chapter_images]" />
                                </div>
                                <div class="col-md-12">
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.2.chapter.2.title.'])

                                    <input type="text" name="volume[2][chapter][2][title]" class="form-control" placeholder="Глава">
                                    <label class="form-check-labexl">Выберите zip-архив с изображениями</label>
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.2.chapter.2.chapter_images]'])

                                    <input type="file" name="volume[2][chapter][2][chapter_images]" />
                                </div>
                            </div>--}}

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Продолжить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
