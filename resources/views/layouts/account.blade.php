@extends('layouts.app')

@section('content')
    <!-- Content -->
    <section id="content">
        <div class="jumbotron content">
            <div class="container">
			    <nav class="navbar navbar-expand-md pb-0">
			        <span class="navbar-brand">{{ $user->full_name }}</span>
			        <ul class="navbar-nav nav-pills mr-auto">
			            <li class="nav-item">
			            	<router-link to="/profile" class="nav-link" data-toggle="tooltip" title="{{ trans('account.menu.profile') }}"><i class="fa fa-user-o" aria-hidden="true"></i></router-link>
			            </li>
			            <li class="nav-item">
			            	<router-link to="/settings" class="nav-link" data-toggle="tooltip" title="{{ trans('account.menu.settings') }}"><i class="fa fa-cogs" aria-hidden="true"></i></router-link>
			            </li>
			            <li class="nav-item">
			            	<router-link to="/notices" class="nav-link" data-toggle="tooltip" title="{{ trans('account.menu.notifications') }}"><i class="fa fa-bell-o" aria-hidden="true"></i><!-- <span class="badge badge-pill badge-danger">1</span> --></router-link>
			            </li>
			            <li class="nav-item">
			            	<router-link to="/messages" class="nav-link" data-toggle="tooltip" title="{{ trans('account.menu.messages') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i><!-- <span class="badge badge-pill badge-danger">2</span> --></router-link>
			            </li>
			        </ul>
			        <form action="{{ route('logout') }}" method="POST" class="form-inline mt-2 mt-md-0">
			        	{{ csrf_field() }}
			            <button class="btn btn-link" type="submit" data-toggle="tooltip" title="{{ trans('account.menu.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
			        </form>
			    </nav>
			    <nav class="navbar navbar-expand-md pt-0">
			    	<span class="navbar-brand">{{ trans('account.contract') }}:</span>
					<div class="btn-group btn-group-toggle" id="dpmContracts" data-toggle="buttons">
						@foreach ($user->contracts as $index => $contract)
							<label class="btn btn-primary mr-1 @if ($index == 0) active @endif" data-contract-id="{{ $contract->id }}">
								<input type="radio" name="contracts" @if ($index == 0) checked @endif autocomplete="off"> {{ $contract->number }}
							</label>
						@endforeach
					</div>
			    </nav>
			    <hr class="m-0">

			    <div class="container-fluid">
			        <div class="row">
				        <nav class="col-sm-3 col-md-2 bg-light px-0">
					        <div class="text-center">
					        	<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#accountSidebar" aria-controls="accountSidebar" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i></button>
					    	</div>
				        	<div class="d-none d-sm-block navbar-collapse account-sidebar" id="accountSidebar">
					            <ul class="nav nav-pills flex-column">
						            <li class="nav-item">
						                <router-link to="/" class="nav-link" exact>{{ trans('account.menu.general_info') }}</router-link>
						            </li>
						            <li class="nav-item">
						                <router-link to="/leasing" class="nav-link">{{ trans('account.menu.leasing_payments') }}</router-link>
						            </li>
						            <li class="nav-item">
						            	<router-link to="/services" class="nav-link">{{ trans('account.menu.public_service') }}</router-link>
						            </li>
					            </ul>
				        	</div>
						</nav>
				        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
				        	@if (empty($user->email) && empty($user->phone))
				        	<div class="alert alert-warning alert-dismissible fade show" role="alert">
							    {!! trans('account.text_alert') !!}
							    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							@endif
				        	<transition>
								<keep-alive>
									<router-view></router-view>
								</keep-alive>
							</transition>
				        </main>
			        </div>
				</div>

            </div>
        </div>
    </section>
@endsection

@section('script')
	<script>
        @if ($user)
        	let api_token = '{{ $user->api_token }}';
        	localStorage.setItem('api_token', api_token);
        	window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + api_token;
        @endif
	</script>
@endsection