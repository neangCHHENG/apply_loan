@extends('Cms.master-page')
@section('content')
    <script src='//static.anyflip.com/plugin/LightBox/js/anyflp-light-box-api-min.js'></script>
    <section class="content-header">
        <div class="wrapper">
            <div class="thumbnail">
                @if ($data->thumbnailimgBack == null)
                    <img src="{{ asset('FrontEnd/Image/background/bg-015.jpg') }}">
                @else
                    <img src="{{ $data->thumbnailimgBack }}">
                @endif
            </div>
            <div class="container-xl content-title" style="max-width: 1096px;">
                <div class="row">
                    <div class="p-0">
                        <h2 class="text-white titleMJQE" style="text-shadow: 2px 2px #45454575;">
                            {{ App::getLocale() == 'en' ? $data->title_en : $data->title_kh }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="single-article">
        <div class="container-xl p-5 bg-white" style="max-width: 1096px;">
            <div class="row">
                <div class="justify-content-center">
                    <?php
                    $str = '';
                    if (App::getLocale() == 'en') {
                        $article_editor = $data->article_editor_en;
                    } else {
                        $article_editor = $data->article_editor_kh;
                    }
                    echo $str = $str . $article_editor;
                    ?>
                </div>
            </div>
        </div>
    </section>
@endsection
