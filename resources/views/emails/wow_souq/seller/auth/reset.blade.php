@component('mail::message')
# Introduction

WOW Souq Seller Reset Password.

<p>Your Reset Code Is : {{$code}}</p>

@component('mail::button', ['url' => url(route('wowsouq.seller.get.reset.password'))])
    New Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
