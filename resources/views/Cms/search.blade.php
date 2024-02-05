@extends('Cms.master-page')

@section('content')
    <section class="header-title">
        <div class="container-xl pt-5 pb-5">
            <h2 class="fw-bold pt-5 pb-5">
                {{ App::getLocale() == 'en' ? 'FIND JOB' : 'ស្វែងរកការងារ' }}
            </h2><br>
        </div>
    </section>

    <section class="container-xl p-4 mt-lg-5">
        <h3>{{ App::getLocale() == 'en' ? 'TOP UP YOUR JOB' : 'បញ្ចូលការងាររបស់អ្នក' }}</h3>
        <span>{{ App::getLocale() == 'en' ? 'Most featured jobs listed' : 'ការងារពិសេសបំផុតដែលបានរាយបញ្ជី' }}</span><br><br>
        <div class="row">
            <div class="col-md-4 col-sm-12 find-job">
                <form action="{{ url(App::getLocale() == 'en' ? 'en/search' : 'search') }}" method="GET">
                    <div class="p-5" style="background-color: #fff; display:inline-block; border-radius: 6px">
                        <div class="col-md-12 col-sm-12 m-0 p-0">
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name='title' autocomplete="off"
                                    placeholder="{{ App::getLocale() == 'en' ? 'Job title, Keywords...' : 'ស្វែងរកចំណងជើង...' }}" />
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 m-0 p-0">
                            <div class="form-group">
                                <select class="form-control select2" id="specialism" name='specialism'>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 m-0 p-0">
                            <div class="form-group">
                                <select class="form-control select2" id="locations" name='locations'>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 m-0 p-0">
                            <div class="form-group">
                                <select class="form-control select2" id="vacancy_type" name='vacancy_type'>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 m-0 p-0">
                            <div class="form-group">
                                <div class="search-btn">
                                    <input type="submit" class="form-control cs-bgcolor" name="cs_"
                                        value="{{ App::getLocale() == 'en' ? 'Find Job' : 'ស្វែងរកការងារ' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 col-sm-12">
                @foreach ($data as $key => $value)
                    <div class="row p-5 w-100 categories-job" style="border: 1px solid #e8e8e8;">
                        <div class="col-md-3 col-sm-12">
                            <div class="ribbon">
                                @if ($value->urgent == 1)
                                    <span>{{ App::getLocale() == 'en' ? 'Urgent' : 'បន្ទាន់' }}</span>
                                @else
                                @endif
                            </div>
                            <a
                                href="{{ url(App::getLocale() == 'en' ? 'en/articles/' . $value->id : 'articles/' . $value->id) }}">
                                @if ($value->thumbnail == null)
                                    <img class="img-thumbnail" src="{{ $value->thumbnail_com }}" alt="">
                                @else
                                    <img class="img-thumbnail" src="{{ $value->thumbnail }}" alt="">
                                @endif
                            </a>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <a class="caption-job"
                                href="{{ url(App::getLocale() == 'en' ? 'en/articles/' . $value->id : 'articles/' . $value->id) }}">
                                <p>
                                    <b>{{ App::getLocale() == 'en' ? $value->position_en : $value->position_kh }}</b>
                                </p>
                                <span>
                                    {{ App::getLocale() == 'en' ? $value->department_en . ', ' . $value->company_en : $value->department_kh . ', ' . $value->company_kh }}
                                </span>
                                <br>
                                <span>{{ App::getLocale() == 'en' ? $value->location_en . ', on' : $value->location_kh . ', ' }}</b>
                                    @php
                                        $currentDateTime = new DateTime();
                                        $startDate = new DateTime($value->start_date);
                                        $dateDifference = $startDate->diff($currentDateTime);
                                        $daysDifference = $dateDifference->days;

                                        if ($daysDifference == 1) {
                                            $dayDd = $daysDifference . (App::getLocale() == 'en' ? ' day ago' : ' ថ្ងៃ​មុន');
                                            print "$dayDd";
                                        } else {
                                            $dayDd = $daysDifference . (App::getLocale() == 'en' ? ' days ago' : ' ថ្ងៃ​មុន');
                                            print "$dayDd";
                                        }
                                    @endphp
                                </span><br>
                                <span class="vacancy-type">
                                    {{ App::getLocale() == 'en' ? $value->vacancy_en : $value->vacancy_kh }}
                                </span>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-12 text-center">
                            <i class="fa fa-heart" aria-hidden="true"></i><br>
                            <b class="pt-5" style="display: inline-block;color:#e00808">
                                {{ $value->offered_salary }}</b>
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
        <nav aria-label="" class="d-flex justify-content-center">
            {{ $data->links('pagination::bootstrap-4') }}
        </nav>

    </section>
    <script>
        $(document).ready(function() {
            getSpecialismList();
            getLocationList();
            getVacancytypeList();
        });

        function getLocationList() {
            $.ajax({
                url: "{{ url('/admin/searchSpecialism/getLocationList') }}",
                type: "GET",

                success: function(response) {
                    if (response.result == "error") {
                        sweetToast(response.msg, response.result);
                        return;
                    }
                    var typeStr = "<option><span>Select location</span></option>";
                    for (var i = 0; i < response.data.length; i++) {
                        typeStr +=
                            '<option value="' +
                            response.data[i].id +
                            '">' +
                            response.data[i].title_kh +
                            "-" +
                            response.data[i].title_en +
                            "</option>";
                    }
                    $("#locations").html(typeStr);
                },
                error: function(e) {
                    if (e.status == 401) {
                        //unauthenticate not login
                        Msg("Login is Required", "error");
                    }
                },
            });
        }

        function getSpecialismList() {
            $.ajax({
                url: "{{ url('/admin/searchSpecialism/getSpecialismList') }}",
                type: "GET",
                success: function(response) {
                    if (response.result == "error") {
                        sweetToast(response.msg, response.result);
                        return;
                    }
                    var typeStr = "<option><span>Select specialisms</span></option>";
                    for (var i = 0; i < response.data.length; i++) {
                        typeStr +=
                            '<option value="' +
                            response.data[i].id +
                            '">' +
                            response.data[i].title_kh +
                            "-" +
                            response.data[i].title_en +
                            "</option>";
                    }
                    $("#specialism").html(typeStr);
                },
                error: function(e) {
                    if (e.status == 401) {
                        //unauthenticate not login
                        Msg("Login is Required", "error");
                    }
                },
            });
        }

        function getVacancytypeList() {
            $.ajax({
                url: "{{ url('/admin/searchVacancytype/getVacancytypeList') }}",
                type: "GET",
                success: function(response) {
                    if (response.result == "error") {
                        sweetToast(response.msg, response.result);
                        return;
                    }
                    var typeStr = "<option><span>Select vacancy type</span></option>";
                    for (var i = 0; i < response.data.length; i++) {
                        typeStr +=
                            '<option value="' +
                            response.data[i].id +
                            '">' +
                            response.data[i].title_kh +
                            "-" +
                            response.data[i].title_en +
                            "</option>";
                    }
                    $("#vacancy_type").html(typeStr);
                },
                error: function(e) {
                    if (e.status == 401) {
                        //unauthenticate not login
                        Msg("Login is Required", "error");
                    }
                },
            });
        }
    </script>
@endsection
