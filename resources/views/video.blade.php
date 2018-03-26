@extends('layouts.app')

@section('content')
    <!-- Gallery -->
    <section id="content">
        <div class="jumbotron content">
            <div class="container">
    			<ol class="breadcrumb mb-0 pl-0">
    			    <li class="breadcrumb-item active"></li>
    			</ol>
                <h4 class="text-primary">{{ trans('app.menu.video_gallery') }}</h4>
                <hr class="my-4">
                <div class="card-deck">
                @foreach ($videos as $video)
                    <div class="card text-center">
                        <a href="{{ ((!empty($video->path_external)) ? $video->path_external : url($video->path)) }}" data-toggle="lightbox" {!! ((empty($video->path_external)) ? 'data-type="video" ' : '') !!} data-title="{{ $video->name }}">
                            <img src="{{ asset('images/red-play-icon.svg') }}" width="80" class="card-img-top w-50">
                            <div class="card-body">
                                <h5 class="card-title">{{ $video->name }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
