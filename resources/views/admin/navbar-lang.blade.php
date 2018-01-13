@if ($user)
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fa fa-globe fa-fw"></i> {{{ LaravelLocalization::getSupportedLocales()[session('admin.locale')]['native'] }}} <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu" style="min-width: 100px;">
            @foreach (LaravelLocalization::getSupportedLocales() as $locale => $localeData)
                <li>
                    <a href="{{{ route('admin.wildcard', 'locale/switch') }}}?locale={{{ $locale }}}">
                        <div>
                            <nobr><i class="fa fa-globe fa-fw"></i> {{{ $localeData['native'] }}}</nobr>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endif