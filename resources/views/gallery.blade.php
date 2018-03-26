@extends('layouts.app')

@section('content')
    <!-- Gallery -->
    <section id="content">
        <div class="jumbotron content">
            <div class="container">
    			<ol class="breadcrumb mb-0 pl-0">
                    @if (!$is_gallery_list) <li class="breadcrumb-item"><a href="{{ url('gallery') }}">{{ trans('app.menu.photo_gallery') }}</a></li> @endif
    			    <li class="breadcrumb-item active"></li>
    			</ol>
                @if ($is_gallery_list)
                    <h4 class="text-primary">{{ trans('app.menu.photo_gallery') }}</h4>
                    <hr class="my-4">
                    <div class="card-deck">
                    @foreach ($gallery as $gal)
                        @if ($gal->images)
                            <div class="card text-center">
                                <a href="{{ route('gallery', [$gal->id]) }}">
                                    <img src="{{ url($gal->images[0]) }}" alt="" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">{{ $gal->name }}</h5>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    </div>
                @else
                    <h4 class="text-primary">{{ $gallery->name }}</h4>
                    <hr class="my-4">
                    <div class="card-deck">
                    @foreach ($gallery->images as $image)
                        <div class="card text-center">
                            <a href="{{ url($image) }}" data-toggle="lightbox" data-gallery="gallery-{{ $gallery->id }}"><img src="{{ url($image) }}" alt="" class="card-img"></a>
                        </div>
                    @endforeach
                    </div>
                @endif
                
            </div>
        </div>
    </section>
@endsection
