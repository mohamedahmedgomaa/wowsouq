

<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">

    {{--    @if(auth()->user()->hasRole('admin'))--}}

    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>{{trans('admin.dashboard')}}</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{url('/admin')}}"><i class="fa fa-circle-o"></i>{{trans('admin.dashboard')}} </a></li>
{{--            <li><a href="{{url('admin/settings')}}"><i class="fa fa-circle-o"></i> {{trans('admin.settings')}}</a></li>--}}
        </ul>
    </li>
{{--    @endif--}}

{{--    @if(auth()->user()->hasRole('laravel'))--}}
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i> <span>{{trans('admin.admins')}}</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{url(route('admin.index'))}}"><i class="fa fa-user"></i> {{trans('admin.admins')}}</a></li>
            <li><a href="{{url(route('admin.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.create')}}</a></li>
        </ul>
    </li>
{{--    @endif--}}

{{--    <li class="treeview">--}}
{{--        <a href="#">--}}
{{--            <i class="fa fa-list"></i> <span>{{trans('admin.roles')}}</span>--}}
{{--        </a>--}}
{{--        <ul class="treeview-menu">--}}
{{--            <li><a href="{{url(route('role.index'))}}"><i class="fa fa-list"></i> {{trans('admin.roles')}}</a></li>--}}
{{--            <li><a href="{{url(route('role.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.create')}}</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}


{{--    <li class="treeview">--}}
{{--        <a href="#">--}}
{{--            <i class="fa fa-flag-o"></i> <span>{{trans('admin.cities')}}</span>--}}
{{--        </a>--}}
{{--        <ul class="treeview-menu">--}}
{{--            <li><a href="{{url(route('city.index'))}}"><i class="fa fa-flag-o"></i> {{trans('admin.cities')}}</a></li>--}}
{{--            <li><a href="{{url(route('city.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.create')}}</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}

{{--    <li class="treeview">--}}
{{--        <a href="#">--}}
{{--            <i class="fa fa-map-marker"></i> <span>{{trans('admin.neighborhoods')}}</span>--}}
{{--        </a>--}}
{{--        <ul class="treeview-menu">--}}
{{--            <li><a href="{{url(route('neighborhood.index'))}}"><i--}}
{{--                            class="fa fa-map-marker"></i> {{trans('admin.neighborhoods')}}</a></li>--}}
{{--            <li><a href="{{url(route('neighborhood.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.create')}}</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}

{{--    <li class="treeview">--}}
{{--        <a href="#">--}}
{{--            <i class="fa fa-filter"></i> <span>{{trans('admin.categories')}}</span>--}}
{{--        </a>--}}
{{--        <ul class="treeview-menu">--}}
{{--            <li><a href="{{url(route('category.index'))}}"><i class="fa fa-filter"></i> {{trans('admin.categories')}}--}}
{{--                </a></li>--}}
{{--            <li><a href="{{url(route('category.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.create')}}</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}

{{--    <li class="treeview">--}}
{{--        <a href="#">--}}
{{--            <i class="fa fa-phone"></i> <span>{{trans('admin.contacts')}} </span>--}}
{{--        </a>--}}
{{--        <ul class="treeview-menu">--}}
{{--            <li><a href="{{url(route('contact.index'))}}"><i--}}
{{--                            class="fa fa-phone text-red"></i>{{trans('admin.contacts')}}</a></li>--}}
{{--            <li><a href="{{url(route('contact.complaint'))}}"><i--}}
{{--                            class="fa fa-compass text-blue"></i> {{trans('admin.complaint')}}</a></li>--}}
{{--            <li><a href="{{url(route('contact.suggestion'))}}"><i--}}
{{--                            class="fa fa-sun-o text-green"></i> {{trans('admin.suggestion')}}</a></li>--}}
{{--            <li><a href="{{url(route('contact.enquiry'))}}"><i--}}
{{--                            class="fa fa-envelope text-warning"></i> {{trans('admin.enquiry')}}</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}

{{--    <li class="treeview">--}}
{{--        <a href="#">--}}
{{--            <i class="fa fa-paper-plane"></i> <span>{{trans('admin.payments')}}</span>--}}
{{--        </a>--}}
{{--        <ul class="treeview-menu">--}}
{{--            <li><a href="{{url(route('payment.index'))}}"><i--}}
{{--                            class="fa fa-paint-brush"></i>{{trans('admin.payments')}}</a></li>--}}
{{--            <li><a href="{{url(route('payment.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.create')}}--}}
{{--                </a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}

{{--    <li class="treeview">--}}
{{--        <a href="#">--}}
{{--            <i class="fa fa-paypal"></i> <span>{{trans('admin.PaymentMethods')}}</span>--}}
{{--        </a>--}}
{{--        <ul class="treeview-menu">--}}
{{--            <li><a href="{{url(route('PaymentMethod.index'))}}"><i--}}
{{--                            class="fa fa-paypal"></i>{{trans('admin.PaymentMethods')}}</a></li>--}}
{{--            <li><a href="{{url(route('PaymentMethod.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.create')}}--}}
{{--                </a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}

{{--    <li>--}}
{{--        --}}{{--        <a href="{{url(route('donation.index'))}}"><i class="fa fa-heart text-red"></i> <span>التبرعات</span></a>--}}
{{--    </li>--}}

{{--    <li>--}}
{{--        <a href="{{url(route('client.index'))}}"><i class="fa fa-user text-red"></i>--}}
{{--            <span>{{trans('admin.clients')}}</span></a>--}}
{{--    </li>--}}

{{--    <li>--}}
{{--        <a href="{{url(route('restaurant.index'))}}"><i class="fa fa-user text-red"></i>--}}
{{--            <span>{{trans('admin.restaurants')}}</span></a>--}}
{{--    </li>--}}

{{--    <li>--}}
{{--        <a href="{{url(route('comment.index'))}}"><i class="fa fa-comments text-red"></i>--}}
{{--            <span>{{trans('admin.comments')}}</span></a>--}}
{{--    </li>--}}

{{--    <li>--}}
{{--        <a href="{{url(route('offer.index'))}}"><i class="fa fa-hard-of-hearing text-blue"></i>--}}
{{--            <span>{{trans('admin.offers')}}</span></a>--}}
{{--    </li>--}}

{{--    <li>--}}
{{--        <a href="{{url(route('order.index'))}}"><i class="fa fa-first-order text-gray"></i>--}}
{{--            <span>{{trans('admin.orders')}}</span></a>--}}
{{--    </li>--}}

{{--    <li>--}}
{{--        <a href="{{url(route('product.index'))}}"><i class="fa fa-product-hunt text-green"></i>--}}
{{--            <span>{{trans('admin.products')}}</span></a>--}}
{{--    </li>--}}

{{--    <li>--}}
{{--        <a href="{{url(route('getChangePassword'))}}"><i class="fa fa-map-pin text-red"></i>--}}
{{--            <span>تغيير كلمه المرور</span></a>--}}
{{--    </li>--}}

</ul>
