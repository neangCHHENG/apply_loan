@extends('Cms.master-page')
@section('content')
    <div class="container-xl p-0">
        <h2 class="text-center fw-bold mt-lg-5 mt-2 color-dark-purple">
            {{ App::getLocale() == 'en' ? $data->title_en : $data->title_kh }}
        </h2>
    </div>
    <div class="container-xl p-5 my-lg-5 my-4 p-md-5 p-3 bg-white">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class='item mb-3 w-100'>
                    <div class='card card-no-img'>
                        <div class='card-body'>
                            <div class='date'>
                                <i class='fa-solid fa-calendar-days'></i>
                                <span>{{ App::getLocale() == 'en' ? $data->date_en : $data->date_kh }}</span>
                            </div>
                            {!! App::getLocale() == 'en' ? $data->description_en : $data->description_kh !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
