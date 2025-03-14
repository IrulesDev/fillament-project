<x-mail::message>
<img src="{{ asset('public/images/IrulesDevText.png') }}" alt="{{ config('app.name') }} Logo" style="width: 150px; height: auto;">

# Email Verification

Hello {{ $user->name }},

Please click the button below to verify your email address.

<x-mail::button :url="url('/verify-email?token=' . $user->verification_token)">
Verify Email
</x-mail::button>

If you did not create an account, no further action is required.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
