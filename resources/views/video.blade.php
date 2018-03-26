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
                    <div class="card">
                        <a href="{{ ((!empty($video->path_external)) ? $video->path_external : url($video->path)) }}" data-toggle="lightbox" {!! ((empty($video->path_external)) ? 'data-type="video" ' : '') !!} data-title="{{ $video->name }}" class="container">
                            <div class="row">
                                <div class="col-4 py-2 text-center">
                                    <img src="{{ asset('images/red-play-icon.svg') }}" width="50">
                                </div>
                                <div class="col-8 p-2">
                                    <div class="card-body p-0">
                                        <h5 class="card-title m-0">{{ $video->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
