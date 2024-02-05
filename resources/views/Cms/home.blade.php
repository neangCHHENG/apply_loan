@extends('Cms.master-page')
@section('content')
    <section class="row">
        <div class="home pt-5" style='background-image: url({{ asset('FrontEnd/Image//20240124-MJQE-Final-Slide.jpg') }})';>
            <div class="container-xl pt-5">
                <h1 class="pt-5">{{ App::getLocale() == 'en' ? 'Apply Loan' : 'ស្នើសុំប្រាក់កម្ចី' }}</h1>
            </div>
        </div><br>
    </section>
    <section class="container-xl">
        <div class="row">
            <div class="col-md-8 col-sm-12 ">
                <form class="row apply_loan p-3 pb-5" action="">
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
                        <label for="">Purpose of Loan</label><br>
                        <select class="form-control" name="purpose_loan" id="purpose_loan">
                            <option value="Business ">Business </option>
                            <option value="Real Estate Loan">Real Estate Loan</option>
                            <option value="Auto Loan">Auto Loan</option>
                            <option value="Investment">Investment</option>
                            <option value="Wedding ">Wedding </option>
                            <option value="Holiday">Holiday</option>
                            <option value="others...">others...</option>
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
                        <label for="">{{ App::getLocale() == 'en' ? 'Phone Number' : 'លេខទូរសព្ទ' }}</label><br>
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
                        <label for="">{{ App::getLocale() == 'en' ? 'State/Province' : 'រដ្ឋ/ខេត្ត' }}</label><br>
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

                </form>
                <button type="button" id="btnSaveApplyLoan" class="btn-send btn btn-lg"
                    style="min-width: 100px; justify-content: center; float:right">
                    {{ App::getLocale() == 'en' ? 'Apply now' : 'ដាក់ពាក្យ​ឥឡូវនេះ' }}
                </button><br><br>
            </div>
            <div class="col-md-4 col-sm-12" style="background-color: #fff">
                <div class="row p-2 pt-5 pb-5">
                    <div class="owl-carousel owl-theme" id="owl-carousel-adverti">
                        @foreach ($data['slide'] as $key => $value)
                            <img src="{{ $value->thumbnail }}">
                        @endforeach
                    </div>
                    <h5>{{ App::getLocale() == 'en' ? 'CONTACT US' : 'ទំនាក់ទំនង' }}</h5>
                    <?php
                    foreach ($menuFooterItems as $menuFooterItem) {
                        if ($menuFooterItem->type == 'address' || $menuFooterItem->type == 'phone' || $menuFooterItem->type == 'email') {
                            $value = App::getLocale() == 'en' ? $menuFooterItem->value_en : $menuFooterItem->value_kh;
                            $str = '';
                            echo $str = $str . '<p>' . $value . '</p><br>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
@endsection
