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
                        <h2>
                            <a href="#" data-toggle="swiper-title-more" class="slide-link">{{ $descriptionsMain->descr }}</a>
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

    @if ($promo_news)
        <!-- Promo News -->
        <div class="modal fade" id="promo_news" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content bg-primary">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $promo_news->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fi flaticon-multiply fi-1x mr-1" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ url($promo_news->images[0]) }}">
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
