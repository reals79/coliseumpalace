@extends('layouts.app')

@section('content')
    <!-- Content -->
    <section id="content">
        <div class="jumbotron content">
            <div class="container">
			    <nav class="navbar navbar-expand-md">
			        <span class="navbar-brand">{{ Auth::user()->full_name }}
			        	<br><small class="text-muted">Договор: <strong>{{ Auth::user()->contract }}</strong></small>
			        </span>
			        <ul class="navbar-nav nav-pills mr-auto">
			            <li class="nav-item">
			            	<router-link to="/profile" class="nav-link" data-toggle="tooltip" title="Профайл"><i class="fa fa-user-o" aria-hidden="true"></i></router-link>
			            </li>
			            <li class="nav-item">
			            	<router-link to="/settings" class="nav-link" data-toggle="tooltip" title="Настройки"><i class="fa fa-cogs" aria-hidden="true"></i></router-link>
			            </li>
			            <li class="nav-item">
			            	<router-link to="/alerts" class="nav-link" data-toggle="tooltip" title="Уведомления"><i class="fa fa-bell-o" aria-hidden="true"></i><span class="badge badge-pill badge-danger">1</span></router-link>
			            </li>
			            <li class="nav-item">
			            	<router-link to="/messages" class="nav-link" data-toggle="tooltip" title="Сообщения"><i class="fa fa-envelope-o" aria-hidden="true"></i><span class="badge badge-pill badge-danger">2</span></router-link>
			            </li>
			        </ul>
			        <form action="{{ route('logout') }}" method="POST" class="form-inline mt-2 mt-md-0">
			        	{{ csrf_field() }}
			            <button class="btn btn-link" type="submit" data-toggle="tooltip" title="Выход"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
			        </form>
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
						                <router-link to="/" class="nav-link" exact>Общая информация</router-link>
						            </li>
						            <li class="nav-item">
						                <router-link to="/leasing" class="nav-link">Лизинговые платежи</router-link>
						            </li>
						            <li class="nav-item">
						            	<router-link to="/services" class="nav-link">Комунальные услуги</router-link>
						            </li>
					            </ul>
				        	</div>
						</nav>
				        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
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