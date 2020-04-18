@extends('wow_souq.layouts.app')

@section('wow_souq')

    <!--================Home Banner Area =================-->

    <section class="home_banner_area mb-40"
             style="background-image: url('{{Storage::url(settings()->image_login_client)}}'); margin-bottom: 0;background-size: cover">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="border border-dark"
                     style="margin-top: 50px;margin-bottom: 50px;margin-left: 50px;padding-top: 30px;padding-bottom: 40px;padding-left: 50px;width: 450px;background-color: rgba(0,0,0,0.5);border-radius: 20px">

                    <div class="text-center" style="margin: 0">
{{--                        <img src="{{Storage::url(settings()->image)}}" style="width: 100px">--}}
                        <h2 style="color: #ffffff;margin-right: 30px">{{trans('web.login')}}</h2>
                    </div>

                    <form method="post" action="{{ route('wowsouq.client.login') }}">
                        {!! csrf_field() !!}

                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.email')}}</label>
                                    <input type="email" name="email" placeholder=""
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans("web.email")}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.password')}}</label>
                                    <input type="password" name="password" placeholder="{{trans('web.password')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.password')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 20px">
                            <div>
                                <div class="checkbox">
                                    <label style="color: #ffffff">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="margin-top: 20px;font-size: 17px">
                            <button type="submit"
                                    class="genric-btn primary-border circle">{{trans('web.login')}}</button>
                            <a href="#" class="genric-btn link circle"
                               style="margin-left: 50px;">{{trans('web.I forgot my password')}}</a>
                        </div>
                        <div class="col-lg-3" style="margin-top: 20px;font-size: large">
                            <a href="{{url('client/register')}}" class="genric-btn primary circle"
                               style="width: 300px;margin-left: 15px">{{trans('web.createNewAccount')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

@endsection
