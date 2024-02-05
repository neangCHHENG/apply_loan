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
                        {{ App::getLocale() == 'en' ? $data['category']->name_en : $data['category']->name_kh }}
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <div class="container-xl p-5 bg-white single-category" style="max-width: 1096px;">
        <div class="row" style="justify-content: center;">
            @foreach ($data['article'] as $key => $value)
                <div class="col-lg-4 col-md-4 col-sm-6 cardv1 mb-3">
                    <div class="card border-1">
                        <a
                            href="{{ url(App::getLocale() == 'kh' ? 'articles/' . $value->slug_en : 'en/articles/' . $value->slug_en) }}">
                            <div class="card-header p-0" style="height: 315px;">
                                @if ($value->thumbnail == null)
                                    <img src="{{ asset('FrontEnd/Image/background/noimage.jpg') }}"
                                        class="card-img-top img-overlay">
                                @else
                                    <img src="{{ asset($value->thumbnail) }}" class="card-img-top img-overlay">
                                @endif
                            </div>
                            <div class="card-body">
                                <a style="text-align: center; padding:10px"
                                    href="{{ url(App::getLocale() == 'kh' ? 'articles/' . $value->slug_en : 'en/articles/' . $value->slug_en) }}"
                                    class="news-link">
                                    <span
                                        style="font-size: 12px">{{ \Carbon\Carbon::parse($value->schedule)->format('M d, Y') }}</span>
                                    <h4>{{ Str::limit(App::getLocale() == 'en' ? $value->title_en : $value->title_kh, 60) }}
                                    </h4>
                                    <p>{{ Str::limit(App::getLocale() == 'en' ? $value->introduction_en : $value->introduction_kh, 70) }}
                                    </p>
                                </a>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <nav aria-label="" class="d-flex justify-content-center">
            {{ $data['article']->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
