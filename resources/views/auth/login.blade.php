@extends('layouts.app')

@section('content')
<section id="content">
    <div class="jumbotron content">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10">
                    
                    <div class="card">
                        <div class="card-header bg-transparent"><h6 class="mb-0">{{ trans('account.authorization') }}</h6></div>
                        <div class="card-body card-text">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <form action="{{ route('login') }}" role="form" method="POST">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-shield" aria-hidden="true"></i></div></div>
                                                        <input type="text" class="form-control{{ $errors->has('idno') ? ' is-invalid' : '' }}" id="idno" name="idno" value="{{ old('idno') }}" title="{{ trans('account.idno_number') }}" placeholder="{{ trans('account.idno_number') }}" required autofocus>
                                                    </div>
                                                    @if ($errors->has('idno'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('idno') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div></div>
                                                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" value="" title="{{ trans('account.password') }}" placeholder="{{ trans('account.password') }}" required>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('password') }}</div>
                                                    @endif
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input">
                                                    <label class="custom-control-label" for="remember-me">{{ trans('account.remember_me') }}</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block mt-2">{{ trans('account.buttons.login') }}</button>
                                                <a href="{{ route('register') }}" class="btn btn-link btn-block">{{ trans('account.buttons.forgot_password') }}</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                  <p class="lead">{{ trans('account.register') }}</p>
                                  <ul class="list-reg list-unstyled">
                                      <li><i class="fa fa-check text-success" aria-hidden="true"></i> {{ trans('account.text_5') }}</li>
                                      <li><i class="fa fa-check text-success" aria-hidden="true"></i> {{ trans('account.text_6') }}</li>
                                      <li><i class="fa fa-check text-success" aria-hidden="true"></i> {{ trans('account.text_7') }}</li>
                                      <li><i class="fa fa-check text-success" aria-hidden="true"></i> &middot;&middot;&middot;</li>
                                  </ul>
                                  <a href="{{ route('register') }}" class="btn btn-primary">{{ trans('account.buttons.registration') }}</a>
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
