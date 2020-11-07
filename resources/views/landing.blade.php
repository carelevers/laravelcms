@extends('layouts.master')
@section('content')



    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h1>De leefbare <strong>STAD</strong></h1>
                        <p>{{ $heading->body }}</p>
                        <a href="#about" class="main-button-slider">Bekijk meer</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                        <img src="{!! !empty($heading->image) ? '/uploads/content/' . $heading->image : 'http://placehold.it/750x300' !!}" class="rounded img-fluid d-block mx-auto" alt="First Vector Graphic">
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->


    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 headline" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="{!! !empty($contentOne->image) ? '/uploads/content/' . $contentOne->image : 'http://placehold.it/750x300' !!}" class="rounded img-fluid d-block mx-auto" alt="First Vector Graphic">
                </div>
                <div class="right-text col-lg-5 col-md-12 col-sm-12 mobile-top-fix">
                    <div class="left-heading">
                        <h5>{{$contentOne->title}}</h5>
                    </div>
                    <div class="left-text">
                        <p>{{$contentOne->body}}</p>
                        <a href="{{$contentOne->id}}" class="main-button">Bekijk meer</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->


    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="about2">
        <div class="container">
            <div class="row">
                <div class="left-text col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix">
                    <div class="left-heading">
                        <h5>Curabitur aliquam eget tellus id porta</h5>
                    </div>
                    <p>Proin justo sapien, posuere suscipit tortor in, fermentum mattis elit. Aenean in feugiat purus.</p>
                    <ul>
                        <li>
                            <img src="/images/about-icon-01.png" alt="">
                            <div class="text">
                                <h6>Nulla ultricies risus quis risus</h6>
                                <p>You can use this website template for commercial or non-commercial purposes.</p>
                            </div>
                        </li>
                        <li>
                            <img src="/images/about-icon-02.png" alt="">
                            <div class="text">
                                <h6>Donec consequat commodo purus</h6>
                                <p>You have no right to re-distribute this template as a downloadable ZIP file on any website.</p>
                            </div>
                        </li>
                        <li>
                            <img src="/images/about-icon-03.png" alt="">
                            <div class="text">
                                <h6>Sed placerat sollicitudin mauris</h6>
                                <p>If you have any question or comment, please <a rel="nofollow" href="https://templatemo.com/contact">contact</a> us on TemplateMo.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right-image col-lg-7 col-md-12 col-sm-12 mobile-bottom-fix-big" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    <img src="/images/right-image.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->


    <!-- ***** Features Small Start ***** -->
    <section class="section" id="services">
        <div class="container">
            <div class="row">
                <div class="owl-carousel owl-theme">
                    @foreach ($posts as $post)
                    <div class="item service-item">
                        <div class="icon">
                            <i><img src=" {!! !empty($post->image) ? '/uploads/posts/' . $post->image :  'http://placehold.it/750x300' !!} " alt=""></i>
                        </div>
                        <h5 class="service-title">{{ $post->title }}</h5>
                        <p>{{ $post->body }}</p>
                        <a href="/blog/{{ $post->id }}" class="main-button">Read More</a>
                        <div class="card-footer text-muted mt-4">
                            Posted {{ $post->created_at->diffForHumans() }} by
                            <a href="#">{{ $post->user->name }} </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Small End ***** -->

@endsection
