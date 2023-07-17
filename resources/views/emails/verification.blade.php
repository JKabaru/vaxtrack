<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Account Verification</title>
</head>
<body>
    <h2>Account Verification</h2>
    
    <p>Hello, {{ $user->name }},</p>
    
    <p>Your account is pending verification. Please click the link below to verify your email address:</p>
    
    <p>
        <a href="{{ $verificationUrl }}">Verify Email Address</a>
    </p>
    
    <p>If you did not create an account, no further action is required.</p>
    
    <p>Thank you!</p>

    <!-- Add the link to the user's specific dashboard -->
    <p>
        If you have already verified your email, you can access your dashboard by clicking the link below:
        <a href="{{ $verificationUrl }}">Go to Dashboard</a>
    </p>
</body>
</html>


