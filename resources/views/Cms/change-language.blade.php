@extends('Cms.master-page')
@section('content')
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 w-100">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                data-bs-auto-close="outside">
                {{ Config::get('languages')[App::getLocale()] }}
            </a>
            <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">
                <li>
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('lang.switch', 'en', 'kh') }}"> {{ $language }}</a>
                        @endif
                    @endforeach
                </li>
            </ul>
        </li>
    </ul>

    <div class="container">
        <div class="row justify-content-center">
            <h3>{{ $slugLanguage }}</h3>
        </div>
    </div>
@endsection
