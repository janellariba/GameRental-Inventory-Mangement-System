
{{-- The Hyper Link Can Rename but Do not Remove :) --}}
<div>
    <h1>Email Verification</h1>
    <p>We received a request to reset your password for your account. To proceed, verify your email by clicking the link below:</p>
    <a href="{{route("reset.password", $token)}}">Reset Password</a>
    <p>This link will expire in 24 hours. For your security, please do not share this link with anyone.</p>

    <p>Thank you! <br>from GameRental Team</p>
</div>
