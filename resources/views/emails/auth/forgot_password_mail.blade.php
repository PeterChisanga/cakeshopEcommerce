<x-mail::message>
<h2>Cakeshop</h2>

Hello {{$name}},

<x-mail::button :url="route('password.reset', $reset_code)">
Click here to reset your password
</x-mail::button>

<p>Alternatively, you can copy and paste the following URL into your browser:</p>
<p><a href="{{ route('password.reset', $reset_code) }}">{{ route('password.reset', $reset_code) }}</a></p>
<p>If you did not request a password reset, please ignore this email.</p>
Best regards,<br>
Cakeshop
</x-mail::message>
