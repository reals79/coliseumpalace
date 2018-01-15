@extends('layouts.app')

@section('content')
<section id="content">
    <div class="jumbotron content">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header bg-transparent"><h6 class="mb-0">{{ trans('account.registration') }}</h6></div>
                        <div class="card-body card-text">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <register></register>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
