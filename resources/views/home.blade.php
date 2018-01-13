@extends('layouts.app')

@section('content')
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($slideshow as $ss)
            <div class="swiper-slide" style="background-image: url({{ asset($ss->image) }});"></div>
            @endforeach
            <div class="row align-items-center">
                <div class="swiper-title">
                    <div class="bg-opacity"></div>
                    <div class="swiper-descr">
                        <h1 class="display-4">{{ $descriptionsMain->name }}</h1>
                        <h2 class="text-center">
                            {{ $descriptionsMain->descr }} <small><a href="#" data-toggle="swiper-title-more">далее...</a></small>
                        </h2>
                        <slides :records="{{ $contentsMain }}"></slides>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    @foreach ($contents as $content)
        <!-- Content -->
        <section id="content">
            <div class="jumbotron content">
                <div class="container">
                    <h4 class="text-primary">{{ $content->name }}</h4>
                    <hr class="my-4">
                    <p>{!! $content->descr !!}</p>
                </div>
            </div>
        </section>
    @endforeach
@endsection
