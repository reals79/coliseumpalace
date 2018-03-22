@extends('layouts.app')

@section('content')
    <!-- News -->
    <section id="content">
        <div class="jumbotron content">
            <div class="container">
    			<ol class="breadcrumb mb-0 pl-0">
    			    <li class="breadcrumb-item active"></li>
    			</ol>
                <h4 class="text-primary">{{ trans('app.menu.news') }}</h4>
                <hr class="my-4">
                
                @if ($is_news_list)
                    <ul class="list-unstyled">
                    @foreach ($news as $r_news)
                        <li class="media mb-5">
                            @if ($r_news->images)
                                <img src="{{ url($r_news->images[0]) }}" alt="" class="col-2 mr-3 img-thumbnail">
                            @else
                                <div class="col-2 h-100 mr-3 img-thumbnail">&nbsp;</div>
                            @endif
                            <div class="media-body">
                                <h4 class="my-0"><strong>{{ $r_news->title }}</strong></h4>
                                <div class="small text-muted mb-1">{{ $r_news->when_at->format('d.m.Y') }}</div>
                                <div>{{ \Illuminate\Support\Str::words(strip_tags($r_news->descr), 100, '...') }}</div>
                                <div class="mt-4">
                                    <a href="{{ route('news', $r_news->id) }}" class="btn btn-primary">{{ trans('app.buttons.more') }}</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                @else
                    <div class="card mb-3">
                        @if ($news->images)
                            <div id="newsImages" class="carousel slide card-img-top" data-ride="carousel">
                                <ol class="carousel-indicators">
                                @foreach($news->images as $index => $image)
                                    <li data-target="#newsImages" data-slide-to="{{ $index }}" @if ($index == 0) class="active" @endif></li>
                                @endforeach
                                </ol>
                                <div class="carousel-inner">
                                @foreach($news->images as $index => $image)
                                    <div class="carousel-item @if ($index == 0) active @endif">
                                        <img class="d-block mx-auto" src="{{ url($image) }}">
                                    </div>
                                @endforeach
                                </div>
                                @if (count($news->images) > 1)
                                <a class="carousel-control-prev text-primary" href="#newsImages" role="button" data-slide="prev">
                                    <i class="fa fa-chevron-left fa-2x text-primary" aria-hidden="true"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next text-primary" href="#newsImages" role="button" data-slide="next">
                                    <i class="fa fa-chevron-right fa-2x text-primary" aria-hidden="true"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                                @endif
                            </div>
                        @endif
                        <div class="card-body">
                            <h4 class="card-title my-0">{{ $news->title }}</h4>
                            <div class="small text-muted mb-1">{{ $news->when_at->format('d.m.Y') }}</div>
                            <div class="card-text">{!! $news->descr !!}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
