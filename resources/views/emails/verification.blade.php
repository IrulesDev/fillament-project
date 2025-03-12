<x-mail::message>
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
