@extends('wow_souq.layouts.app')
@inject('model', 'App\Model\Client')

@section('wow_souq')
    @include('partials.validations_errors')
    <!--================Home Banner Area =================-->
    {{--    {{Storage::url(settings()->image)}}--}}
    @include('flash::message')
    <section class="home_banner_area mb-40"
             style="background-image: url('{{Storage::url(settings()->image_profile_client)}}'); margin-bottom: 0;background-size: cover;">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="border border-dark"
                     style="margin-top: 50px;margin-bottom: 50px;margin-left: 33%;padding-top: 30px;padding-bottom: 40px;padding-left: 50px;width: 450px;background-color: rgba(0,0,0,0.7);border-radius: 20px">

                    <div class="text-center" style="margin: 0">
                        <h2 style="color: #ffffff;margin-right: 30px">{{trans('web.profile')}}</h2>
                    </div>

                    <form method="post" action="{{ route('wowsouq.client.profile') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div class="text-center" style="margin-right: 50px">
                        <img src="{{Storage::url(auth('clients')->user()->image)}}" alt="000000" class="img-thumbnail"
                             style="width: 100px;height: 100px;margin-top: 10px">
                        </div>
                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label for="image" style="color: #ffffff">{{trans('web.image')}}</label>
                                    <input type="file" style="color: #ffffff" class="form-control-file" name="image">

                                </div>
                            </div>
                        </div>

                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.name')}}</label>
                                    <input type="text" name="name" value="{{auth('clients')->user()->name}}" placeholder="{{trans('web.name')}}"
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
                                    <input type="email" name="email" value="{{auth('clients')->user()->email}}" placeholder=""
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
                                           class="single-input-accent">
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
                                           class="single-input-accent">
                                </div>
                            </div>
                        </div>


                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.phone')}}</label>
                                    <input type="number" name="phone" value="{{auth('clients')->user()->phone}}" placeholder="{{trans('web.phone')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.phone')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.age')}}</label>
                                    <input type="number" name="age" value="{{auth('clients')->user()->age}}" placeholder="{{trans('web.age')}}"
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
                                    class="genric-btn primary-border circle">{{trans('web.edit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

@endsection
