@extends('Cms.master-page')
@section('content')
    <section class="mb-0 content-header">
        <div class="wrapper" style="height: 56vh">
            <div class="thumbnail">
                <img src="{{ asset('FrontEnd/Image/background/bg-015.jpg') }}">
            </div>
            <div class="col-md-5 col-sm-12 content-title" style="margin-bottom: auto">
                <div class="container-xl p-0 text-center">
                    <h2 class="text-white titleMJQE" style="text-shadow: 2px 2px #45454575;">
                        {{ App::getLocale() == 'en' ? 'PAGE NOT FOUND' : 'រកមិនឃើញទំព័រ' }}
                    </h2>
                    <form class="menu-search my-4" action="{{ url(App::getLocale() == 'kh' ? 'search' : 'en/search') }}"
                        method="GET">
                        <input class="input-search" type="search" name="search" id="search"
                            placeholder="{{ App::getLocale() == 'en' ? 'Search' : 'ស្វែងរក' }}">
                        &nbsp;<button id="btn-search" type="submit"
                            class="btn btn-sm btn-general btn-secondary-contained">{{ App::getLocale() == 'en' ? 'Search' : 'ស្វែងរក' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
