@extends('wow_souq.layouts.app')

@section('wow_souq')

    <!--================Home Banner Area =================-->
    @include('flash::message')
    <section class="home_banner_area mb-40"
             style="background-image: url('{{Storage::url(settings()->image_login_client)}}'); margin-bottom: 0;background-size: cover">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="border border-dark"
                     style="margin-top: 50px;margin-bottom: 50px;margin-left: 50px;padding-top: 30px;padding-bottom: 40px;padding-left: 50px;width: 450px;background-color: rgba(0,0,0,0.5);border-radius: 20px">

                    <div class="text-center" style="margin: 0">
                        <h2 style="color: #ffffff;margin-right: 30px">{{trans('web.forget_password')}}</h2>
                    </div>

                    <form method="post" action="{{ route('wowsouq.client.forget.password') }}">
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

                        <div class="col-lg-12" style="margin-top: 20px;font-size: 17px">
                            <button type="submit"
                                    class="genric-btn danger circle">{{trans('web.submit')}}</button>
                            <a href="{{url('client/login')}}" class="genric-btn primary-border circle"
                               style="margin-left: 50px;">{{trans('web.login')}}</a>
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
