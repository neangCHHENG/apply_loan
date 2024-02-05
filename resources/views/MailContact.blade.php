<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Contact Form</title>
</head>

<body style="color: black;">
    <p>Dear {{ $name }},</p>
    <p>All information provided will be kept confidential.</p>
    <p>
        <strong>Username: {{ $name }}</strong><br />
        <strong>Password: 123456</strong><br />
        <strong>Please go to: </strong><a href="https://mjqjobs.com/login">mjqjobs.com/login</a><br>
        <strong>After logging in, please go to system settings to change your password and your profile image.</strong>
    </p>
    <p><a href="{{ asset('FrontEnd/Image/guildUserSignUp.PNG') }}">View Image</a></p>
</body>

</html>
