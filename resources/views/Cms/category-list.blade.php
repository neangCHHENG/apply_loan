@extends('Cms.master-page')
@section('content')
    <div class="container-xl p-0">
        <h2 class="text-center fw-bold mt-lg-5 mt-2 color-dark-purple">Categories</h2>
    </div>
    <div class="container-xl p-0 my-lg-5 my-4 p-md-5 p-3 bg-white">
        <div class="row justify-content-center">
            @foreach ($data as $key => $value)
                <div class="col-lg-10" style="background-color: #f0f3f3; border-radius: 5px; margin: 8px; padding: 25px">
                    <h4 style="float: left;">{{ App::getLocale() == 'en' ? $value->name_en : $value->name_kh }}</h4>
                    <a class='btn btn-dark-purple'
                        href='{{ url(App::getLocale() == 'kh' ? '/article-list' : '/en/article-list') . '/' . $value->id }}'
                        style="float: right;">{{ App::getLocale() == 'en' ? 'Show article' : 'បង្ហាញអត្តបទ' }}</a>
                </div>
            @endforeach
            <nav aria-label="" class="d-flex justify-content-center">
                {{ $data->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
