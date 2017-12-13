@extends('layouts.app')

@section('content')
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($slideshow as $ss)
            <div class="swiper-slide" style="background-image: url({{ asset($ss->image) }});">
                <div class="row">
                    <div class="swiper-title">
                        <div class="bg-opacity"></div>
                        <div class="swiper-descr">
                            <h1>Coliseum Palace - Ваша территория комфорта</h1>
                            <div class="text-center">
                                10 поводов выбрать Coliseum Palace (<a href="#" data-toggle="swiper-title-more">далее...</a>)
                            </div>
                            <slides :records="{{ $contentsMain }}"></slides>
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
