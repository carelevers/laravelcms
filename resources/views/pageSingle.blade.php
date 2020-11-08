
@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto mt-lg-5">
                <br>
                <h3 class="mt-4">
                    {{ $content->title }}
                    <span class="lead">by <a href="#">{{ $content->user->name }}</a></span>
                </h3>
                <hr>
                <p>Posted {{ $content->created_at->diffForHumans() }}</p>
                <hr>
                <img class="img-fluid rounded" src="{!! !empty($content->image) ? '/uploads/content/' . $content->image : 'http://placehold.it/750x300' !!}" alt="">
                <hr>
                <div>
                    <p>{!!   $content->body !!}</p>
                    <hr>
                    <br>
                </div>

            </div>
        </div>
    </div>
@endsection
