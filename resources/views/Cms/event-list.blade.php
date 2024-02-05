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
                        {{ App::getLocale() == 'en' ? 'Our Achievement' : ' ប្រវត្តិជោគជ័យ' }}
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <div class="container-xl">
        <div class="row"
            style="margin-right: calc(var(--bs-gutter-x) * -.5); margin-left: calc(var(--bs-gutter-x) * -.5)">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <!-- blog -->
                @foreach ($data as $key => $value)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $key }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $key }}" aria-expanded="false"
                                aria-controls="collapse{{ $key }}">
                                {{ App::getLocale() == 'en' ? $value->title_en : $value->title_kh }}
                            </button>
                        </h2>
                        <div id="collapse{{ $key }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {!! App::getLocale() == 'en' ? $value->description_en : $value->description_kh !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <br>
                <!-- blog -->
            </div>
            <nav aria-label="" class="d-flex justify-content-center">
                {{ $data->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
