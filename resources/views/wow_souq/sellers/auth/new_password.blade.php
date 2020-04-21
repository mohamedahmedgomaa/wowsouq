@extends('wow_souq.layouts.app')

@section('wow_souq')

    <!--================Home Banner Area =================-->
    @include('flash::message')
    @include('partials.validations_errors')
    <section class="home_banner_area mb-40"
             style="background-image: url('{{Storage::url(settings()->image_login_seller)}}'); margin-bottom: 0;background-size: cover">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="border border-dark"
                     style="margin-top: 50px;margin-bottom: 50px;margin-left: 50px;padding-top: 30px;padding-bottom: 40px;padding-left: 50px;width: 450px;background-color: rgba(0,0,0,0.5);border-radius: 20px">

                    <div class="text-center" style="margin: 0">
                        <h2 style="color: #ffffff;margin-right: 30px">{{trans('web.new_password')}}</h2>
                    </div>

                    <form method="post" action="{{ route('wowsouq.seller.reset.password') }}">
                        {!! csrf_field() !!}

                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.pin_code')}}</label>
                                    <input type="text" name="pin_code" placeholder="{{trans('web.pin_code')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans("web.pin_code")}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.email')}}</label>
                                    <input type="email" name="email" placeholder="{{trans('web.email')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans("web.email")}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row" style="margin-top: 10px">
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

                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff"
                                           for="password_confirmation">{{trans('web.password_confirmation')}}</label>
                                    <input type="password" name="password_confirmation"
                                           placeholder="{{trans('web.password_confirmation')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.password_confirmation')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12" style="margin-top: 20px;font-size: 17px">
                            <button type="submit"
                                    class="genric-btn danger circle">{{trans('web.submit')}}</button>
                            <a href="{{url('seller/reset/code')}}" class="genric-btn primary-border circle"
                               style="margin-left: 10px;"
                               data-toggle="modal" data-target="#resetCodeSeller">{{trans('web.reset_code')}}</a>
                        </div>
                        <div class="col-lg-3" style="margin-top: 20px;font-size: large">
                            <a href="{{url('seller/login')}}" class="genric-btn primary circle"
                               style="width: 300px;margin-left: 15px">{{trans('web.login')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->



    <!-- Modal -->
    <div id="resetCodeSeller" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4>{{trans('web.resetCode')}}</h4>
                </div>
                <form method="post" action="{{ route('wowsouq.seller.reset.code') }}">
                    {!! csrf_field() !!}

                    <div class="modal-body">
                        <div class="banner_content row">
                            <div class="col-lg-12">
                                <div class="mt-10">
                                    <label>{{trans('web.email')}}</label>
                                    <input type="email" name="email" placeholder="{{trans("web.email")}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans("web.email")}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info circle" data-dismiss="modal">{{ trans('admin.no') }}</button>
                        <button type="submit"
                                class="genric-btn danger circle">{{trans('web.submit')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
