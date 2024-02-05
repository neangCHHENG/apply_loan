@extends('Cms.master-page')
@section('content')
    <section class="content-header">
        <div class="wrapper">
            <div class="thumbnail">
                @if ($data['dataDetail']->thumbnailimgBack == null)
                    <img src="{{ asset('FrontEnd/Image/background/bg-015.jpg') }}" alt="thumbnail">
                @else
                    <img src="{{ $data['dataDetail']->thumbnailimgBack }}" alt="thumbnail">
                @endif
            </div>
            <div class="container-xl content-title" style="max-width: 1096px;">
                <div class="row">
                    <div class="p-0">
                        <h2 class="text-white titleMJQE" style="text-shadow: 2px 2px #45454575;">
                            {{ App::getLocale() == 'en' ? $data['dataDetail']->title_en : $data['dataDetail']->title_kh }}
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
                        $article_editor = $data['dataDetail']->article_editor_en;
                    } else {
                        $article_editor = $data['dataDetail']->article_editor_kh;
                    }
                    $str = $str . $article_editor;
                    $str =
                        $str .
                        "</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </p>";
                    echo $str;

                    ?>
                    <div>
                        @if (count($data['relateArticle']) > 0)
                            <h4 class="text-center py-5 ">{{ App::getLocale() == 'en' ? 'Teacher' : 'គ្រូបង្រៀន' }}
                            </h4>
                            <div class="row relateArticle">
                                @foreach ($data['relateArticle'] as $key => $value)
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <div class="card card-related-teacher">
                                            <div class="card-body row">
                                                <div class="col-md-5 col-sm-12 thumbnial">
                                                    <div class="thumbnial-wrapper">
                                                        <div class="thumbnial-inner img1by1">
                                                            <img src="{{ $value->thumbnail }}"
                                                                alt="{{ $value->thumbnail }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-sm-12 info">
                                                    <h5>{{ App::getLocale() == 'en' ? $value->title_en : $value->title_kh }}
                                                    </h5>
                                                    <div>
                                                        <div>
                                                            <div><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                                                {{ App::getLocale() == 'en' ? $value->introduction_en : $value->introduction_kh }}
                                                            </div>

                                                            <div>
                                                                <?php
                                                                $str = '';
                                                                if (App::getLocale() == 'en') {
                                                                    $article_editor = $value->article_editor_en;
                                                                } else {
                                                                    $article_editor = $value->article_editor_kh;
                                                                }
                                                                echo $str = $str . $article_editor;
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $data['relateArticle']->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
