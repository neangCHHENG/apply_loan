@extends('Cms.master-page')
@section('content')
    <section class="row">
        <div class="home pt-5" style='background-image: url({{ asset('FrontEnd/Image//20240124-MJQE-Final-Slide.jpg') }})';>
            <div class="container-xl pt-5">
                <h1>{{ App::getLocale() == 'en' ? 'Apply Loan' : 'ស្នើសុំប្រាក់កម្ចី' }}</h1>
            </div>
        </div><br>
    </section>
    <section class="container-xl">
        <div class="row">
            <div class="col-md-8 col-sm-12 ">
                <div class=" p-3 pb-5 apply_loan">
                    <form class="row" method="post" action="" id="applyLoanForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <!--create token-->
                        <h5>{{ App::getLocale() == 'en' ? 'Loan Details' : 'ព័ត៌មានលម្អិតអំពីប្រាក់កម្ចី' }}</h5><br>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'Loan Amount' : 'ចំនួនប្រាក់កម្ចី' }}</label><br>
                            <input class="form-control" type="number" name="loan_amount" id="loan_amount"
                                placeholder="{{ App::getLocale() == 'en' ? 'Loan Amount' : 'ចំនួនប្រាក់កម្ចី' }}">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'Monthly Income' : 'ចំណូល​ប្រចាំខែ' }}</label><br>
                            <input class="form-control" type="number" name="monthly_income" id="monthly_income"
                                placeholder="{{ App::getLocale() == 'en' ? 'Monthly Income' : 'ចំណូល​ប្រចាំខែ' }}">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'Purpose of Loan' : 'គោលបំណងនៃប្រាក់កម្ចី' }}</label><br>
                            <select class="form-control" name="purpose_loan" id="purpose_loan">
                                <option value="Business ">{{ App::getLocale() == 'en' ? 'Business' : 'អាជីវកម្ម' }}</option>
                                <option value="Real Estate Loan">
                                    {{ App::getLocale() == 'en' ? 'Real Estate Loan' : 'ប្រាក់កម្ចីអចលនទ្រព្យ' }}</option>
                                <option value="Auto Loan">
                                    {{ App::getLocale() == 'en' ? 'Auto Loan' : 'ប្រាក់កម្ចីដោយស្វ័យប្រវត្តិ' }}</option>
                                <option value="Investment">{{ App::getLocale() == 'en' ? 'Investment' : 'ការវិនិយោគ' }}
                                </option>
                                <option value="Wedding ">{{ App::getLocale() == 'en' ? 'Wedding' : 'អាពាហ៍ពិពាហ៍' }}
                                </option>
                                <option value="Holiday">{{ App::getLocale() == 'en' ? 'Holiday' : 'ថ្ងៃឈប់សម្រាក' }}
                                </option>
                                <option value="others">{{ App::getLocale() == 'en' ? 'others...' : 'អ្នកផ្សេងទៀត...' }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="">{{ App::getLocale() == 'en' ? 'Loan year' : 'ឆ្នាំខ្ចី' }}</label><br>
                            <select class="form-control" name="loan_year" id="loan_year">
                                <option value="2 months">{{ App::getLocale() == 'en' ? '2 months' : '២ ខែ' }}</option>
                                <option value="4 months">{{ App::getLocale() == 'en' ? '4 months' : '៤ ខែ' }}</option>
                                <option value="6 months">{{ App::getLocale() == 'en' ? '6 months' : '៦ ខែ' }}</option>
                                <option value="1 year">{{ App::getLocale() == 'en' ? '1 year' : '១ ឆ្នាំ' }}</option>
                                <option value="2 years">{{ App::getLocale() == 'en' ? '2 years' : '២ ឆ្នាំ' }}</option>
                                <option value="3 years">{{ App::getLocale() == 'en' ? '3 years' : '៣ ឆ្នាំ' }}</option>
                                <option value="4 years">{{ App::getLocale() == 'en' ? '4 years' : '៤ ឆ្នាំ' }}</option>
                                <option value="5 years">{{ App::getLocale() == 'en' ? '5 years' : '៥ ឆ្នាំ' }}</option>
                                <option value="6 years">{{ App::getLocale() == 'en' ? '6 years' : '៦ ឆ្នាំ' }}</option>
                            </select>
                        </div>
                        <h5>{{ App::getLocale() == 'en' ? 'Personal Details' : 'ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន' }}</h5><br>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="">{{ App::getLocale() == 'en' ? 'Full Name' : 'ឈ្មោះ​ពេញ' }}</label><br>
                            <input class="form-control" type="text" name="full_name" id="full_name"
                                placeholder="{{ App::getLocale() == 'en' ? 'Full Name' : 'ឈ្មោះ​ពេញ' }}">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="">{{ App::getLocale() == 'en' ? 'Email' : 'អ៊ីមែល' }}</label><br>
                            <input class="form-control" type="email" name="email" id="email"
                                placeholder="{{ App::getLocale() == 'en' ? 'Email' : 'អ៊ីមែល' }}">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'Phone Number' : 'លេខទូរសព្ទ' }}</label><br>
                            <input class="form-control" type="text" name="phone_number" id="phone_number"
                                placeholder="{{ App::getLocale() == 'en' ? 'Phone Number' : 'លេខទូរសព្ទ' }}">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'Marital Status' : 'ស្ថានភាពអាពាហ៍ពិពាហ៍' }}</label><br>
                            <select class="form-control" name="marital_status" id="marital_status">
                                <option value="Single ">{{ App::getLocale() == 'en' ? 'Single' : 'នៅលីវ' }}</option>
                                <option value="Married">{{ App::getLocale() == 'en' ? 'Married' : 'រៀបការ' }}</option>
                                <option value="Partners ">{{ App::getLocale() == 'en' ? 'Partners' : 'ដៃគូ' }}</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'Date of Birth' : 'ថ្ងៃខែ​ឆ្នាំ​កំណើត' }}</label><br>
                            <input class="form-control" type="date" name="date_birth" id="date_birth"
                                placeholder="{{ App::getLocale() == 'en' ? 'Date of Birth' : 'ថ្ងៃខែ​ឆ្នាំ​កំណើត' }}">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'Number Of Dependents' : 'ចំនួននាក់អាស្រ័យ' }}</label><br>
                            <select class="form-control" name="number_dependents" id="number_dependents">
                                <option value="0 Dependent">
                                    {{ App::getLocale() == 'en' ? '0 Dependent' : 'មិនមាននាក់អាស្រ័យ' }}</option>
                                <option value="1 Dependent">
                                    {{ App::getLocale() == 'en' ? '1 Dependent' : 'ចំនួន១នាក់អាស្រ័យ' }}</option>
                                <option value="2 Dependent ">
                                    {{ App::getLocale() == 'en' ? '2 Dependents' : 'ចំនួន២នាក់អាស្រ័យ' }} </option>
                                <option value="3 Dependent ">
                                    {{ App::getLocale() == 'en' ? '3 Dependents' : 'ចំនួន៣នាក់អាស្រ័យ' }}</option>
                                <option value="4 Dependent ">
                                    {{ App::getLocale() == 'en' ? '4 Dependents' : 'ចំនួន៤នាក់អាស្រ័យ' }}</option>
                                <option value="5 + Dependent ">
                                    {{ App::getLocale() == 'en' ? '5+ Dependents' : 'ចំនួន៥+នាក់អាស្រ័យ' }}</option>
                            </select>
                        </div>
                        <h5>{{ App::getLocale() == 'en' ? 'Address Details' : 'ព័ត៌មានលម្អិតអំពីអាសយដ្ឋាន' }}</h5>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'House No/Name' : 'ផ្ទះលេខ/ឈ្មោះ' }}</label><br>
                            <input class="form-control" type="text" name="house_no" id="house_no"
                                placeholder="{{ App::getLocale() == 'en' ? 'House No/Name' : 'ផ្ទះលេខ/ឈ្មោះ' }}">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="">{{ App::getLocale() == 'en' ? 'Street' : 'ផ្លូវ' }}</label><br>
                            <input class="form-control" type="text" name="street" id="street"
                                placeholder="{{ App::getLocale() == 'en' ? 'Street' : 'ផ្លូវ' }}">
                        </div>
                        <div class="col-md-4 col-sm-12 form-group">
                            <label
                                for="">{{ App::getLocale() == 'en' ? 'State/Province' : 'រដ្ឋ/ខេត្ត' }}</label><br>
                            <input class="form-control" type="text" name="province" id="province"
                                placeholder="{{ App::getLocale() == 'en' ? 'State/Province' : 'រដ្ឋ/ខេត្ត' }}">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="">{{ App::getLocale() == 'en' ? 'City' : 'ទីក្រុង' }}</label><br>
                            <input class="form-control" type="text" name="city" id="city"
                                placeholder="{{ App::getLocale() == 'en' ? 'City' : 'ទីក្រុង' }}">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="">{{ App::getLocale() == 'en' ? 'Country' : 'ប្រទេស' }}</label><br>
                            <input class="form-control" type="text" name="country" id="country"
                                placeholder="{{ App::getLocale() == 'en' ? 'Country' : 'ប្រទេស' }}">
                        </div>

                    </form><br>
                    <hr>
                    <div class="row">
                        <div class="col-md-7 col-sm-12">
                            <h5>{{ App::getLocale() == 'en' ? 'Loan Calculator' : 'ការគណនាប្រាក់កម្ចី' }}</h5>
                            <div class="row">
                                <label>{{ App::getLocale() == 'en' ? 'Loan Amount' : 'ចំនួនប្រាក់កម្ចី' }}</label>
                                <input class="slider-rang" type="range" min="1000" max="50000" value="5000">
                                <label>{{ App::getLocale() == 'en' ? '$ 5000' : 'ដុល្លា ៥០០០' }}</label>
                            </div><br>
                            <div class="row">
                                <label>{{ App::getLocale() == 'en' ? 'Term (Months)' : 'រយៈពេល (ខែ)' }}</label>
                                <input class="slider-rang" type="range" min="1" max="71" value="12">
                                <label>{{ App::getLocale() == 'en' ? '12 Months' : '១២ ខែ' }}</label>
                            </div>

                        </div>
                        <div class="col-md-5 col-sm-12 p-0" style="background:#f9f9f9">
                            <h5 class="p-3 text-center m-0" style="background-color: #006790;color:#fff">
                                {{ App::getLocale() == 'en' ? 'How much You Need' : 'ចំនួនដែលអ្នកត្រូវការ' }}
                            </h5>
                            <br>
                            <div class="p-3">
                                <p><strong>{{ App::getLocale() == 'en' ? 'Monthly EMI' : 'EMI ប្រចាំខែ' }}</strong> <b
                                        class="pull-right">$ 4,026.55</b></p>
                                <hr>
                                <p><strong>{{ App::getLocale() == 'en' ? 'Interest Amount' : 'ចំនួនទឹកប្រាក់ការប្រាក់' }}</strong>
                                    <b class="pull-right">$ 1,237.13</b>
                                </p>
                                <hr>
                                <p><strong>{{ App::getLocale() == 'en' ? 'Total payment' : 'ការទូទាត់សរុប' }}</strong> <b
                                        class="pull-right">$ 96,637.13</b></p><br>
                                <button type="button" id="btnSave" class="btn-send btn btn-lg"
                                    style="min-width: 100%;">
                                    {{ App::getLocale() == 'en' ? 'Apply now' : 'ដាក់ពាក្យ​ឥឡូវនេះ' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12" style="background-color: #fff">
                <div class="row p-2 pt-5 pb-5">
                    <div class="owl-carousel owl-theme" id="owl-carousel-adverti">
                        @foreach ($data['slide'] as $key => $value)
                            <img src="{{ $value->thumbnail }}">
                        @endforeach
                    </div>
                    <h5 class="pb-3">{{ App::getLocale() == 'en' ? 'For more information' : 'សម្រាប់ព័ត៌មានបន្ថែម' }}
                    </h5>
                    <?php
                    foreach ($menuFooterItems as $menuFooterItem) {
                        if ($menuFooterItem->type == 'phone' || $menuFooterItem->type == 'email' || $menuFooterItem->type == 'workTime') {
                            $value = App::getLocale() == 'en' ? $menuFooterItem->value_en : $menuFooterItem->value_kh;
                            $str = '<p><img style="height:20px;margin-right:5px" src="' . $menuFooterItem->image . '">' . $value . '</p><br>';
                            echo $str;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script>
        function valueFilCont(val = null) {
            let loan_amount;
            let monthly_income;
            let purpose_loan;
            let loan_year;
            let full_name;
            let email;
            let phone_number;
            let marital_status;
            let date_birth;
            let number_dependents;
            let house_no;
            let street;
            let province;
            let city;
            let country;
            if (val === null) {
                loan_amount = $('#loan_amount').val();
                monthly_income = $('#monthly_income').val();
                purpose_loan = $('#purpose_loan').val();
                loan_year = $('#loan_year').val();
                full_name = $('#full_name').val();
                email = $('#email').val();
                phone_number = $('#phone_number').val();
                marital_status = $('#marital_status').val();
                date_birth = $('#date_birth').val();
                number_dependents = $('#number_dependents').val();
                house_no = $('#house_no').val();
                street = $('#street').val();
                province = $('#province').val();
                city = $('#city').val();
                country = $('#country').val();

            }
            if (val === 'clear') {
                $('#loan_amount').val('');
                $('#monthly_income').val('');
                $('#purpose_loan').val('');
                $('#loan_year').val('');
                $('#full_name').val('');
                $('#email').val('');
                $('#phone_number').val('');
                $('#marital_status').val('');
                $('#date_birth').val('');
                $('#number_dependents').val('');
                $('#house_no').val('');
                $('#street').val('');
                $('#province').val('');
                $('#city').val('');
                $('#country').val('');

            }

            return {
                'loan_amount': loan_amount,
                'monthly_income': monthly_income,
                'purpose_loan': purpose_loan,
                'loan_year': loan_year,
                'full_name': full_name,
                'email': email,
                'phone_number': phone_number,
                'marital_status': marital_status,
                'date_birth': date_birth,
                'number_dependents': number_dependents,
                'house_no': house_no,
                'street': street,
                'province': province,
                'city': city,
                'country': country,
            };
        }
        var btnSave = true;
        $('#btnSave').on('click', () => {
            let formData = new FormData();
            formData.append("loan_amount", $('#loan_amount').val());
            formData.append("monthly_income", $('#monthly_income').val());
            formData.append("purpose_loan", $('#purpose_loan').val());
            formData.append("loan_year", $('#loan_year').val());
            formData.append("full_name", $('#full_name').val());
            formData.append("email", $('#email').val());
            formData.append("phone_number", $('#phone_number').val());
            formData.append("marital_status", $('#marital_status').val());
            formData.append("date_birth", $('#date_birth').val());
            formData.append("number_dependents", $('#number_dependents').val());
            formData.append("house_no", $('#house_no').val());
            formData.append("street", $('#street').val());
            formData.append("province", $('#province').val());
            formData.append("city", $('#city').val());
            formData.append("country", $('#country').val());

            $.ajax({
                url: "{{ url('/admin/apply-loan/applyLoanSubmit') }}/",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $("#csrf").val()
                },
                beforeSend: function() {

                },
                success: function(response) {
                    if (response.status == "error") {
                        // valueFilCont('clear');
                        validationMgs(response);
                    } else {
                        valueFilCont('clear');
                        showMessage('success', 'Sent Successfully');
                    }
                },
                error: function(e) {
                    showMessage('Error Saving User', 'error');
                }
            });
        });

        function sweetToast(message, icon) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: icon,
                title: message,
            });
        }

        function validationMgs(response) {
            let msg = '';
            for (let x in response.result) {
                msg += response.result[x][0];
            }
            return sweetToast(msg, response.icon);
        }

        function showMessage(type, message) {
            Swal.fire({
                position: "top-end",
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endsection
