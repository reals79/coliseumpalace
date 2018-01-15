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
                <div class="card-columns">
                @foreach ($videos as $video)
                    <div class="card text-center">
                        <a href="{{ ((!empty($video->path_external)) ? $video->path_external : $video->path) }}" data-toggle="lightbox" {!! ((empty($video->path_external)) ? 'data-type="video" ' : '') !!} data-title="{{ $video->name }}">
                            <img src="{{ asset('images/red-play-icon.svg') }}" width="80">
                            <br>
                            {{ $video->name }}
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
