<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="{{asset('wow_souq/img/logo.png')}}" type="image/png"/>
    <title>{{trans('web.wow_souq')}}</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{asset('wow_souq/css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/vendors/linericon/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/css/themify-icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/css/flaticon.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/vendors/owl-carousel/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/vendors/lightbox/simpleLightbox.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/vendors/nice-select/css/nice-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/vendors/animate-css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/vendors/jquery-ui/jquery-ui.css')}}"/>
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('wow_souq/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('wow_souq/css/responsive.css')}}"/>
</head>

<body> {{--style="background-color: #FAFAFA"--}}

<!--================Header Menu Area =================-->
<header class="header_area">
    <div class="top_menu">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="float-right">
                        <ul class="right_side">
                            <li>
                                <a href="{{url('/seller/register')}}">
                                    {{trans('web.Selling on Wow Souq')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{url('contact')}}">
                                    Contact Us
                                </a>
                            </li>
                            @if (auth('clients')->user() == null)
                                <li>
                                    <a href="{{url('client/login')}}">
                                        {{trans('web.login_client')}}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('wowsouq.client.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{trans('web.logout_client')}}
                                    </a>
                                    <form id="logout-form" action="{{ route('wowsouq.client.logout') }}" method="POST">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                            @if (auth('sellers')->user() == null)
                                <li>
                                    <a href="{{url('seller/login')}}">
                                        {{trans('web.login_seller')}}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('wowsouq.seller.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{trans('web.logout_seller')}}
                                    </a>
                                    <form id="logout-form" action="{{ route('wowsouq.seller.logout') }}" method="POST">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{url('/')}}">
                    <img src="{{asset('wow_souq/img/logo.png')}}" style="width: 100px" alt=""/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                    <div class="row w-100 mr-0">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{url('/')}}">Home</a>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="{{asset('wow_souq')}}/#" class="nav-link dropdown-toggle"
                                       data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false">{{trans('web.topProduct')}}</a>
                                    <ul class="dropdown-menu">
                                        @foreach($top_products as $top_product)
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{url('product', $top_product->id)}}">{{$top_product->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="{{asset('wow_souq')}}/#" class="nav-link dropdown-toggle"
                                       data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false">{{trans('web.categories')}}</a>
                                    <ul class="dropdown-menu">
                                        @foreach($categories as $category)
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">{{$category->name_ar}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="{{asset('wow_souq')}}/#" class="nav-link dropdown-toggle"
                                       data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false">Pages</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{asset('wow_souq')}}/tracking.html">Tracking</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{asset('wow_souq')}}/elements.html">Elements</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('contact')}}">Contact</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-5 pr-0">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                <li class="nav-item">
                                    <a href="{{asset('wow_souq')}}/#" class="icons">
                                        <i class="ti-search" aria-hidden="true"></i>
                                    </a>
                                </li>

                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a href="{{asset('wow_souq')}}/#" class="icons">--}}
                                {{--                                        <i class="ti-shopping-cart"></i>--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}
                                @if (auth('clients')->user() != null)
                                    <li class="nav-item">
                                        <a href="{{ route('client.shoppingCart') }}" class="icons">
                                            <i class="ti-shopping-cart"></i>
                                            <span
                                                class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth('clients')->user() != null && auth('sellers')->user() != null)
                                    <li class="nav-item">
                                        <a class="icons" data-toggle="modal" data-target="#profile">
                                            <i class="ti-user" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @elseif (auth('clients')->user() != null && auth('sellers')->user() == null)
                                    <li class="nav-item">
                                        <a href="{{asset('wow_souq')}}/#" class="icons">
                                            <i class="ti-user" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @elseif (auth('sellers')->user() != null && auth('clients')->user() == null)
                                    <li class="nav-item">
                                        <a href="{{url('seller/profile')}}" class="icons">
                                            <i class="ti-user" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (auth('clients')->user() != null)
                                    <li class="nav-item">
                                        <a href="{{url('client/like')}}" class="icons">
                                            <i class="ti-heart" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (auth('sellers')->user() != null)
                                    <li class="nav-item">
                                        <a href="{{url('seller/product/create')}}" style="font-size: 28px"
                                           class="icons">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<!--================Header Menu Area =================-->


<!-- Modal profile -->
<div id="profile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('web.profile') }}</h4>
            </div>
            <div class="modal-body" style="font-size: 20px">
                <a href="{{url('client/profile')}}"
                   class="genric-btn primary circle">{{trans('web.clientProfileEdit')}}</a>
                <a href="{{url('seller/profile')}}" class="genric-btn info circle"
                   style="margin-left: 25px">{{trans('web.sellerProfileEdit')}}</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.no') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal profile -->


<div>
    @yield('wow_souq')
</div>


<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Top Products</h4>
                <ul>
                    <li><a href="#">Managed Website</a></li>
                    <li><a href="#">Manage Reputation</a></li>
                    <li><a href="#">Power Tools</a></li>
                    <li><a href="#">Marketing Service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="#">Brand Assets</a></li>
                    <li><a href="#">Investor Relations</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Features</h4>
                <ul>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="#">Brand Assets</a></li>
                    <li><a href="#">Investor Relations</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Resources</h4>
                <ul>
                    <li><a href="#">Guides</a></li>
                    <li><a href="#">Research</a></li>
                    <li><a href="#">Experts</a></li>
                    <li><a href="#">Agencies</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 single-footer-widget">
                <h4>Newsletter</h4>
                <p>You can trust us. we only send promo offers,</p>
                <div class="form-wrap" id="mc_embed_signup">
                    <form target="_blank"
                          action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                          method="get" class="form-inline">
                        <input class="form-control" name="EMAIL" placeholder="Your Email Address"
                               onfocus="this.placeholder = ''"
                               onblur="this.placeholder = 'Your Email Address '" required="" type="email">
                        <button class="click-btn btn btn-default">Subscribe</button>
                        <div style="position: absolute; left: -5000px;">
                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                        </div>

                        <div class="info"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom row align-items-center">
            <p class="footer-text m-0 col-lg-8 col-md-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                    href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            <div class="col-lg-4 col-md-12 footer-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-behance"></i></a>
            </div>
        </div>
    </div>
</footer>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('wow_souq')}}/js/jquery-3.2.1.min.js"></script>
<script src="{{asset('wow_souq')}}/js/popper.js"></script>
<script src="{{asset('wow_souq')}}/js/bootstrap.min.js"></script>
<script src="{{asset('wow_souq')}}/js/stellar.js"></script>
<script src="{{asset('wow_souq')}}/vendors/lightbox/simpleLightbox.min.js"></script>
<script src="{{asset('wow_souq')}}/vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="{{asset('wow_souq')}}/vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="{{asset('wow_souq')}}/vendors/isotope/isotope-min.js"></script>
<script src="{{asset('wow_souq')}}/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="{{asset('wow_souq')}}/js/jquery.ajaxchimp.min.js"></script>
<script src="{{asset('wow_souq')}}/vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="{{asset('wow_souq')}}/vendors/counter-up/jquery.counterup.js"></script>
<script src="{{asset('wow_souq')}}/js/mail-script.js"></script>
<script src="{{asset('wow_souq')}}/js/theme.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
    });
</script>


</body>

</html>
