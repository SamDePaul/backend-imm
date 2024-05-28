<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body>
    <h1>Hello !</h1>  <p>Thank you for signing up with our application.</p>
    <p>To verify your email address and activate your account, please click the link below:</p>
    <p>{{ $data['otp']}}</></p>
    <p>This link is valid for 24 hours. If you don't verify your email within this timeframe, please request a new verification code.</p>
    <p>Sincerely,</p>
    <p>Your Application Name</p>
</body>
</html>
