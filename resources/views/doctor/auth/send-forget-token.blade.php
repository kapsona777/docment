<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    {!! clean($template) !!}
    <a href="{{ route('doctor.reset.password',$doctor->forget_password_token) }}">Reset Password</a>
</body>
</html>
