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
                
                @if ($is_calculator)
                    @include('calculator')
                @endif
            </div>
        </div>
    </section>
@endsection
