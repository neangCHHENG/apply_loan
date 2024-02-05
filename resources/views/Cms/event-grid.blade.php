@extends('Cms.master-page')
@section('content')
    <section class="content-header">
        <div class="wrapper">
            <div class="thumbnail">
                <img src="{{ asset('FrontEnd/Image/background/bg-015.jpg') }}">
            </div>
            <div class="container-xl content-title" style="max-width: 1096px;">
                <div class=" p-0">
                    <h2 class="text-white titleMJQE" style="text-shadow: 2px 2px #45454575;">
                        {{ App::getLocale() == 'en' ? 'Event' : ' ព្រឹត្តិការណ៍សាលា' }}
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <div class="container-xl">
        <div class="row bg-white p-5" style="justify-content: center;">
            @foreach ($data as $key => $value)
                <div class="row col-md-6 col-sm-12 card-body">
                    <div class="p-2">
                        <div class="row" style="background: #003764;padding:15px;border-radius: 5px;">
                            <div class="col-md-2 col-sm-12" style="padding: 10px">
                                <div class="date date-home">
                                    <time class="event-short-date" datetime="2023-05-15">
                                        <span class="day"
                                            style="font-size: 15px">{{ \Carbon\Carbon::parse($value->start_date)->format('M') }}</span>
                                        <span
                                            class="day">{{ \Carbon\Carbon::parse($value->start_date)->format('d') }}</span>
                                    </time>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-12 m-0">
                                <div class="info">
                                    <p style="font-weight: bold !important;">
                                        {{ Str::limit(App::getLocale() == 'en' ? $value->title_en : $value->title_kh, 200) }}
                                    </p>
                                    <span style="font-size: 12px">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        {{ App::getLocale() == 'en' ? $value->date_en : $value->date_kh }}</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            @endforeach
            <br>
            <nav aria-label="" class="d-flex justify-content-center">
                {{ $data->links('pagination::bootstrap-4') }}
            </nav>
        </div>

    </div>
@endsection
