@extends('layouts.app')

@section('content')
    <!-- Content -->
    <section id="content">
        <div class="jumbotron content">
            <div class="container">
                <ol class="breadcrumb mb-0 pl-0">
                    {!! breadcrumb($content) !!}
                    <li class="breadcrumb-item active"></li>
                </ol>
                <h4 class="text-primary">{{ $content->name }}</h4>
                <hr class="my-4">

                <p>{!! $content->descr !!}</p>
                    
                @if ($commercials->count())
                    <div class="apartments">
                        <ol class="apartment-list owl-carousel owl-theme">
                            @foreach($commercials as $commercial)
                                <li>
                                    <div class="card">
                                        <a href="{{ url($commercial->image) }}" data-toggle="lightbox" data-gallery="gallery-{{ $commercial->id }}"><img class="card-img-top p-2" src="{{ url($commercial->image) }}" alt="" height="230"></a>
                                        <div class="card-body">
                                            <h5 class="card-title"><span class="text-dark">{{ trans('apartment.building') }}:</span> {{ $commercial->building->name }}</h5>
                                            <p class="card-text">
                                                {!! $commercial->descr !!}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @else
                    <div class="bd-callout bd-callout-danger">
                        <h4><i class="fa fa-exclamation mr-2" aria-hidden="true"></i> {{ trans('apartment.sale') }}</h4>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
