<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Appy Loan Form</title>
</head>

<body style="color: black;">
    <p>Dear {{ $fullname }},</p>
    <p>All information provided will be kept confidential.</p>
    <div class="col-md-8 col-sm-12">
        <div class="row apply_loan p-3 pb-5">
            <h5>Loan Details:ព័ត៌មានលម្អិតអំពីប្រាក់កម្ចី</h5><br>
            <div class="col-md-6 col-sm-12 form-group">
                <label>Loan Amount-ចំនួនប្រាក់កម្ចី :{{ $loanamount }}</label><br>
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label>Monthly Income-ចំណូល​ប្រចាំខែ :{{ $monthlyincome }}</label><br>
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label>Purpose of Loan-គោលបំណងនៃប្រាក់កម្ចី :{{ $purposeloan }}</label><br>
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label>Loan year-ឆ្នាំខ្ចី :{{ $loanyear }}</label><br>
            </div>
            <h5>Personal Details:ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន</h5><br>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">Full Name-ឈ្មោះ​ពេញ :{{ $fullname }}</label><br>
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">Email-អ៊ីមែល :{{ $email }}</label><br>
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">Phone Number-លេខទូរសព្ទ :{{ $phonenumber }}</label><br>
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">Marital Status-ស្ថានភាពអាពាហ៍ពិពាហ៍ :{{ $maritalstatus }}</label><br>
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">Date of Birth-ថ្ងៃខែ​ឆ្នាំ​កំណើត :{{ $datebirth }}</label><br>
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">Number Of Dependents-ចំនួននាក់អាស្រ័យ :{{ $numberdependents }}</label><br>
            </div>
            <h5>{{ App::getLocale() == 'en' ? 'Address Details' : 'ព័ត៌មានលម្អិតអំពីអាសយដ្ឋាន' }}</h5>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">House No/Name-ផ្ទះលេខ/ឈ្មោះ :{{ $houseno }}</label><br>
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">Street-ផ្លូវ :{{ $street }}</label><br>
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="">State/Province-រដ្ឋ/ខេត្ត :{{ $province }}</label><br>
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label for="">City-ទីក្រុង :{{ $city }}</label><br>
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label for="">Country-ប្រទេស :{{ $country }}</label><br>
            </div>
        </div>
    </div>
</body>
{{-- <h1>Hello</h1> --}}

</html>
