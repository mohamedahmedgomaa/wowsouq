@extends('wow_souq.layouts.app')
@inject('model', 'App\Model\Client')

@section('wow_souq')
    @include('partials.validations_errors')
    <!--================Home Banner Area =================-->
    {{--    {{Storage::url(settings()->image)}}--}}

    <section class="home_banner_area mb-40"
             style="background-image: url('{{Storage::url(settings()->image_register_client)}}'); margin-bottom: 0;background-size: cover;">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="border border-dark"
                     style="margin-top: 50px;margin-bottom: 50px;margin-left: 50px;padding-top: 30px;padding-bottom: 40px;padding-left: 50px;width: 450px;background-color: rgba(0,0,0,0.5);border-radius: 20px">

                    <div class="text-center" style="margin: 0">
                        {{--                        <img src="{{Storage::url(settings()->image)}}" style="width: 100px">--}}
                        <h2 style="color: #ffffff;margin-right: 30px">{{trans('web.register')}}</h2>
                    </div>

                    <form method="post" action="{{ route('wowsouq.client.register') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        {{--                    {!! Form::model($model, ['action' => 'WowSouq\Client\AuthController@register', 'files' => true]) !!}--}}

                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.name')}}</label>
                                    <input type="text" name="name" placeholder="{{trans('web.name')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.name')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row" style="margin-top: 10px">
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


                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.phone')}}</label>
                                    <input type="number" name="phone" placeholder="{{trans('web.phone')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.phone')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>


                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label for="image" style="color: #ffffff">{{trans('web.image')}}</label>
                                    <input type="file" style="color: #ffffff" class="form-control-file" name="image">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.age')}}</label>
                                    <input type="number" name="age" placeholder="{{trans('web.age')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.age')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>


                        <label for="gender" style="color: #ffffff;margin-top: 20px"
                               class="">{{trans('web.gender')}}</label>
                        <div class="form-group">
                            <div class="row" style="color: #ffffff">
                                <div class="col-lg-5" style="display: inline">
                                    {!! Form::radio('gender', 'male', true) !!} {{trans('web.male')}}
                                </div>
                                <div class="col-lg-5" style="display: inline">
                                    {!! Form::radio('gender', 'female') !!}  {{trans('web.female')}}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-10" style="margin-top: 30px;font-size: large;">
                            <button type="submit"
                                    class="genric-btn primary-border circle">{{trans('web.register')}}</button>
                        </div>
                        {{--                    <div class="col-lg-3" style="margin-top: 20px;font-size: large">--}}
                        {{--                        <a href="{{url('client/register')}}" class="genric-btn primary circle"--}}
                        {{--                           style="width: 300px;margin-left: 15px">{{trans('web.login')}}</a>--}}
                        {{--                    </div>--}}
                    </form>
                    {{--                    {!! Form::close() !!}--}}
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

@endsection
