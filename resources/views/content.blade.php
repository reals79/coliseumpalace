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

                @if ($content->content_id == -4)
                    @foreach($contentsMain as $contentMain)
                        <?php
                            $contentMain->descr = preg_replace('/%apartments%/', $apartmentTypes, $contentMain->descr);
                        ?>
                        <div id="content-{{ $contentMain->id }}" class="card mt-5">
                            <div class="card-body">
                                <h4 class="card-title">{{ $contentMain->name }}</h4>
                                <p class="card-text">{!! $contentMain->descr !!}</p>
                                <div class="">
                                    <ol class="slide-list owl-carousel owl-theme">
                                        @foreach($contentMain->images as $image)
                                            <li>
                                                <img class="p-2" src="{{ url($image) }}" alt="" height="230">
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                
                @if (!empty($is_calculator))
                    @include('_partials.calculator')
                @endif
            </div>
        </div>
    </section>
@endsection
