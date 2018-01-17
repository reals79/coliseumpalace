<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ app()->getLocale() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - AdWords: 937737027 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-937737027"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-937737027'); </script>
</head>
<body class="page-{{ Request::route()->getName() }}">
<div id="app">
    <header class="py-2 fixed-top">
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-expand-lg pr-0">
                    <div id="logo" class="navbar-brand">
                        <a href="{{ route('home') }}" class="no-decor"><img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', '') }}" title="{{ config('app.name', '') }}"></a>
                    </div>
                    <div id="sidebarMenu" class="sidebar-menu d-flex align-items-center ml-auto">
                        <div class="bg-opacity"></div>
                        <div>
                            <a href="#" class="navbar-toggler no-decor" data-target="#sidebarMenu"><i class="fi flaticon-menu-2 fi-1x mr-1"></i></a>
                        </div>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <div class="nav-link lang-bar no-decor">
                                    <span>&middot;</span>
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        @if (LaravelLocalization::getCurrentLocale() == $localeCode)
                                            <span class="active">{{ $localeCode }}</span>
                                        @else
                                            <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $localeCode }}
                                            </a>
                                        @endif
                                        <span>&middot;</span>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('about') }}" class="nav-link">{{ trans('app.menu.about') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <label class="nav-link dropdown-toggle mb-0" data-toggle="dropdown">{{ trans('app.menu.appartments') }}</label>
                                <ul class="dropdown-menu">
                                    @foreach ($apartment_types as $apartment_type)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('apartment', [$apartment_type->id]) }}">{{ $apartment_type->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @foreach ($main_menu as $menu)
                                @if ($menu->submenus->count())
                                    <li class="nav-item dropdown">
                                    <label class="nav-link dropdown-toggle mb-0" data-toggle="dropdown">{{ $menu->name }}</label>
                                    {!! submenu($menu) !!}
                                @else
                                    <li class="nav-item">
                                    <a href="{{ route('content', [$menu->id]) }}" class="nav-link">{{ $menu->name }}</a>
                                @endif
                                </li>
                            @endforeach
                            <li class="nav-item">
                                <a href="{{ route('gallery') }}" class="nav-link">{{ trans('app.menu.photo_gallery') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('account', ['subdomain' => 'my']) }}" class="nav-link">{{ trans('app.menu.my_coliseum') }}</a>
                            </li>
                        </ul>
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
                                <a href="{{ url('about') }}">{{ trans('app.menu.about') }}</a>
                            </li>

                            @foreach ($main_menu_footer as $menu_footer)
                                <li class="nav-item"><a href="{{ route('content', [$menu_footer->id]) }}">{{ $menu_footer->name }}</a></li>
                            @endforeach

                            <li class="nav-item">
                                <a href="{{ route('gallery') }}">{{ trans('app.menu.photo_gallery') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('video') }}">{{ trans('app.menu.video_gallery') }}</a>
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
                                    <a href="https://www.facebook.com/ColiseumPalaceMD/" class="fa fa-facebook-square mr-2 no-decor" title="Facebook" target="_blank"></a>
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

    <div id="fab-wrapper">
        <a href="tel:+37379740707" class="fab no-decor"><i class="fa fa-phone" aria-hidden="true"></i></a>
    </div>
    <div id="back-top">
        <a href="#" class="no-decor"><i class="fi flaticon-upload fi-2x" aria-hidden="true"></i></a>
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
      js.src = "//connect.facebook.net/{{ LaravelLocalization::getCurrentLocaleRegional() }}/sdk.js#xfbml=1&version=v2.10";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5a33ab5af4461b0b4ef88e6d/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
