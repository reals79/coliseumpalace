@extends('layouts.app')

@section('content')
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($slideshow as $ss)
            <div class="swiper-slide" style="background-image: url({{ asset($ss->image) }});">
                <div class="row">
                    <div class="swiper-title">
                        @if (!empty($ss->title) || !empty($ss->descr))
                            <div class="bg-opacity"></div>
                        @endif
                        <div class="swiper-descr">
                            <h1>{!! str_replace("\n", "<br>", $ss->title) !!}</h1>
                            <div class="descr-short"><p>{!! \Illuminate\Support\Str::words(strip_tags($ss->descr), 15, ' (<a href="#" data-toggle="swiper-title-more">далее...</a>)') !!}</p></div>
                            <div class="descr-long">{!! $ss->descr !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
