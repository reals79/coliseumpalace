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
                            @if ($r_news->image)
                                <img src="{{ url($r_news->image) }}" alt="" class="col-2 mr-3 img-thumbnail">
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
                        @if ($news->image)
                            <img src="{{ url($news->image) }}" alt="" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title my-0">Card title</h4>
                            <div class="small text-muted mb-1">{{ $news->when_at->format('d.m.Y') }}</div>
                            <div class="card-text">{!! $news->descr !!}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
