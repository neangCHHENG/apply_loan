@extends('Cms.master-page')
@section('content')
    <section class="home">
        @foreach ($data['slide'] as $key => $value)
            @if ($key == 1)
            @break
        @endif
        <div class="p-5 home" style='background-image: url("{{ $value->thumbnail }}");'>
            <div class="container-xl" style="position: relative">
                <h1>Apply Loan</h1>
            </div>
        </div><br>
    @endforeach
</section>
<section class="container-xl p-4">
    <div class="row">
        <h3>{{ App::getLocale() == 'en' ? 'Browse Jobs by Categories' : 'ស្វែងរកការងារតាមប្រភេទផ្នែក' }}</h3>
        @foreach ($data['department'] as $key => $value)
            <div class="col-lg-3 col-md-4 col-sm-6 mt-3">
                <div class="card px-3 h-100 categories-job mb-5" style="flex-direction: row; align-items: center">
                    <div class="col-sm-4 border-0">
                        <img src="{{ $value->thumbnail }}" alt="slide">
                    </div>
                    <div class="col-sm-8 p-0 pt-3">
                        <b>{{ App::getLocale() == 'en' ? $value->title_en : $value->title_kh }}</b><br>
                        <span>
                            @if ($value->job_count == 1)
                                {{ $value->job_count }} {{ App::getLocale() == 'en' ? 'job available' : 'ការងារ' }}
                            @else
                                {{ $value->job_count }} {{ App::getLocale() == 'en' ? 'jobs available' : 'ការងារ' }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container-xl p-4 mt-lg-5">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-xs-8 col-7">
            <h3>{{ App::getLocale() == 'en' ? 'TOP UP YOUR JOB' : 'បញ្ចូលការងាររបស់អ្នក' }}</h3>
            <span>{{ App::getLocale() == 'en' ? 'Most featured jobs listed' : 'ការងារពិសេសបំផុតដែលបានរាយបញ្ជី' }}</span><br><br>
        </div>
        <div class=" col-lg-4 col-md-4 col-sm-4 col-5 text-end">
            <a class="a-style" href="{{ url(App::getLocale() == 'en' ? 'en/find-jobs/' : 'find-jobs/') }}">
                {{ App::getLocale() == 'en' ? 'More Jobs ' : 'ការងារច្រើនទៀត ' }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
    <div class="row">
        @foreach ($data['jobList'] as $key => $value)
            <div class="col-lg-6 col-md-12 col-sm-12 mb-5">
                <div class="card categories-job w-100 " style="border: 1px solid #e8e8e8; ">
                    <div class="row p-4">
                        <div class="col-md-3 col-sm-3 col-12">

                            <div class="thumbnial-wrapper"
                                style="border: 1px solid #dadada; padding: 5px; border-radius: 4px; margin: 0 auto">
                                <div class="ribbon">
                                    @if ($value->urgent == 1)
                                        <span>{{ App::getLocale() == 'en' ? 'Urgent' : 'បន្ទាន់' }}</span>
                                    @else
                                    @endif
                                </div>

                                <a
                                    href="{{ url(App::getLocale() == 'en' ? '/en/articles/' . $value->id : '/articles/' . $value->id) }}">
                                    @if ($value->thumbnail == null)
                                        <div class="thumbnial-inner img1by1">
                                            <img class="img-fluid" src="{{ $value->thumbnail_com }}" alt="">
                                        </div>
                                    @else
                                        <div class="thumbnial-inner img1by1">
                                            <img class="img-fluid" src="{{ $value->thumbnail }}" alt="">
                                        </div>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mt-sm-0 col-8 mt-5 p-xs-0">
                            <a class="caption-job"
                                href="{{ url(App::getLocale() == 'en' ? '/en/articles/' . $value->id : '/articles/' . $value->id) }}">
                                <p>
                                    <b>{{ App::getLocale() == 'en' ? $value->position_en : $value->position_kh }}</b>
                                </p>
                                <span>
                                    {{ App::getLocale() == 'en' ? $value->company_en : $value->company_kh }}
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
                                </span>
                                <br>
                                <span class="vacancy-type">
                                    {{ App::getLocale() == 'en' ? $value->vacancy_en : $value->vacancy_kh }}
                                </span>

                            </a>
                        </div>
                        <div class="col-md-3 col-sm-3 col-4 mt-sm-0 mt-5 text-center p-xs-0">
                            <i class="fa fa-heart" aria-hidden="true"></i><br>
                            <b class="pt-5 fz-xs-12" style="display: inline-block;color:#e00808">
                                {{ $value->offered_salary }}</b>
                        </div>
                    </div>
                </div>
            </div><br>
        @endforeach
    </div>
</section>
<section class="container-xl p-4 mt-lg-5">
    <div class="row">
        <h3>{{ App::getLocale() == 'en' ? 'Our Company' : 'ក្រុមហ៊ុនរបស់យើង' }}</h3><br>
        {{-- ourCompany img --}}
        <?php
        $ourCompany = '';
        foreach ($menuFooterItems as $key => $value) {
            if ($value->key == 'ourCompany') {
                $ourCompany = $value->image;
            }
        }
        ?>
        <img class="w-100" src="{{ $ourCompany }}" alt="ourCompany.png">
        {{-- ourCompany img --}}
    </div>
</section>

<section class="container-xl mt-lg-5 p-4">
    <div class="row">
        <h3>{{ App::getLocale() == 'en' ? 'Our Benefits' : 'អត្ថប្រយោជន៍របស់យើង' }}</h3><br>
        @foreach ($data['benefit'] as $key => $value)
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                <div class="card w-100 h-100 categories-job" style="border: 1px solid #e8e8e8;">
                    <div class="row p-3 ">
                        <a class="caption-job">
                            <h3 style="color: #006790 !important; text-align:center">{{ $key + 1 }}.<br /> <b
                                    style="font-size: 15px;color:black">
                                    {{ App::getLocale() == 'en' ? $value->title_en : $value->title_kh }}
                                </b>
                            </h3>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section><br><br>
<script>
    $(document).ready(function() {
        getSpecialismList();
        getLocationList();
    });

    window.onload = function() {
        let popup = $('#popupValue').val();
        if (popup) {
            setTimeout(function() {
                $("#popup").addClass("active");
            }, 10);
        }
    }

    function closePopup() {
        $("#popup").removeClass("active");
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
                var typeStr =
                    "<option><span>All Specialisms </span></option>";

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

    function getLocationList() {
        $.ajax({
            url: "{{ url('/admin/searchSpecialism/getLocationList') }}",
            type: "GET",
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }

                var typeStr = "<option value=''>All Locations</option>";

                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value='" + response.data[i].id + "'>" + response.data[i].title_kh +
                        "-" + response.data[i].title_en + "</option>";
                }

                $("#locations").html(typeStr);
            },
            error: function(e) {
                if (e.status == 401) {
                    // unauthenticated, not logged in
                    Msg("Login is Required", "error");
                }
            },
        });
    }
</script>
@endsection
