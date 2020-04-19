@extends('wow_souq.layouts.app')

@section('wow_souq')

    @include('partials.validations_errors')
    @include('flash::message')

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div
                    class="banner_content d-md-flex justify-content-between align-items-center"
                >
                    <div class="mb-3 mb-md-0">
                        <h2>Contact Us</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="contact.html">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- ================ contact section start ================= -->
    <section class="section_gap">
        <div class="container">


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <form class="form-contact contact_form" action="{{route('contacts')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                              placeholder="{{trans('web.message')}}"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                           placeholder="{{trans('web.name')}}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="phone" id="phone" type="number"
                                           placeholder="{{ trans('web.phone(optional)') }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email"
                                           placeholder="{{ trans('web.email') }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="gender"
                                       class="">{{trans('web.type')}}</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4" style="display: inline">
                                            {!! Form::radio('type', 'complaint', true) !!} {{trans('web.complaint')}}
                                        </div>
                                        <div class="col-lg-4" style="display: inline">
                                            {!! Form::radio('type', 'suggestion') !!}  {{trans('web.suggestion')}}
                                        </div>
                                        <div class="col-lg-4" style="display: inline">
                                            {!! Form::radio('type', 'enquiry') !!}  {{trans('web.enquiry')}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group mt-lg-3">
                            <button type="submit" class="main_btn">{{trans('web.Send Message')}}</button>
                        </div>
                    </form>


                </div>

                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Egypt</h3>
                            {{--                            <p></p>--}}
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3><a href="tel:454545654">{{settings()->phone}}</a></h3>
                            {{--                            <p>Mon to Fri 9am to 6pm</p>--}}
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><a href="mailto:support@colorlib.com">{{settings()->email}}</a></h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
