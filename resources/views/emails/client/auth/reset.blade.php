@component('mail::message')
# Introduction

WOW Souq Client Reset Password.

<p>Your Reset Code Is : {{$code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
