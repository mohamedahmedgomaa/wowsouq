@component('mail::message')
# Introduction

WOW Souq Seller Reset Password.

<p>Your reset code is : {{$code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
