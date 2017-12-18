<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="page-{{ Request::route()->getName() }}">
<div id="app">
    <header class="py-2 fixed-top">
        <div class="container-fluid">
            <div class="row">
                <div id="logo" class="col-sm-3">
                    <a href="{{ route('home') }}"><img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', '') }}" title="{{ config('app.name', '') }}"></a>
                </div>
                <nav class="mr-5 ml-auto d-flex align-items-center">
                    <div>
                        <a href="#" class="sidebar-toggle" data-toggle="sidebar" data-target="#sidebarMenu"><i class="fi flaticon-menu-2"></i></a>
                        <div id="sidebarMenu" class="sidebar-menu">
                            <div class="bg-opacity"></div>
                            <div class="lang-bar">
                                <span>&middot;</span>
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if (LaravelLocalization::getCurrentLocale() == $localeCode)
                                        <span class="active">{{ $localeCode }}</span>
                                    @else
                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $localeCode }}
                                        </a>
                                    @endif
                                    <span>&middot;</span>
                                @endforeach
                            </div>
                            <ul class="nav flex-column">
                                <li class="nav-item dropdown">
                                    <label class="nav-link m-0" data-toggle="tree-toggle">Квартиры</label>
                                    <ul class="nav flex-column mx-3 rounded">
                                        @foreach ($apartment_types as $apartment_type)
                                            <li class="nav-item"><a class="nav-link" href="{{ route('apartment', [$apartment_type->id]) }}">{{ $apartment_type->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @foreach ($main_menu as $menu)
                                    <li class="nav-item dropdown">
                                        @if ($menu->submenus->count())
                                            <label class="nav-link m-0" data-toggle="tree-toggle">{{ $menu->name }}</label>
                                            {!! submenu($menu) !!}
                                        @else
                                            <a href="{{ route('content', [$menu->id]) }}" class="nav-link">{{ $menu->name }}</a>
                                        @endif
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <a href="{{ route('account', ['subdomain' => 'my']) }}" class="nav-link">My Coliseum</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    
    @yield('content')

    <footer class="pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h5>&nbsp;</h5>
                    <hr class="divider" />
                    <p>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ url('about') }}">О доме</a>
                            </li>

                            @foreach ($main_menu_footer as $menu_footer)
                                <li class="nav-item"><a href="{{ route('content', [$menu_footer->id]) }}">{{ $menu_footer->name }}</a></li>
                            @endforeach

                            <li class="nav-item">
                                <a href="{{ route('gallery') }}">Фотогалерея</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('video') }}">Видеогалерея</a>
                            </li>
                        </ul>
                    </p>
                </div>
                <div class="col-lg-5">
                    <h5>&nbsp;</h5>
                    <hr class="divider" />
                    <p>
                        <nav class="navbar navbar-expand social">
                            <ul class="navbar-nav">
                                <li class="d-flex align-items-center">
                                    <a href="https://www.facebook.com/ColiseumPalaceMD/" class="fa fa-facebook-square mr-2" title="Facebook" target="_blank"></a>
                                    <div class="fb-page" data-href="https://www.facebook.com/ColiseumPalaceMD/" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/ColiseumPalaceMD/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ColiseumPalaceMD/">Coliseum Palace</a></blockquote></div>
                                </li>
                            </ul>
                        </nav>
                    </p>
                </div>
                <div class="col-lg-4">
                    @if ($contacts_footer)
                        <h4 class="font-weight-bold">{{ $contacts_footer->name }}</h4>
                        <hr class="divider" />
                        <address>
                            {!! $contacts_footer->descr !!}
                        </address>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 small">
                    &copy; '2017 Coliseum Palace. All Rights Reserved.
                </div>
            </div>
        </div>
        <div id="google-map"></div>
    </footer>
</div>

    <div id="back-top">
        <a href="#"><i class="fi flaticon-upload fi-3x" aria-hidden="true"></i></a>
    </div>

    <!-- Scripts -->
    <script src="//maps.google.com/maps/api/js?key=AIzaSyCTuUv0Fhg16xNNYB3KL4vwOrSDgw-IK4o&region=MD"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    
    @yield('script')


    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.10";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
