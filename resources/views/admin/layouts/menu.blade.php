<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    {{--    @if(auth()->user()->hasRole('admin'))--}}
    <li class="treeview {{ active_menu('settings')[0] }}">
        <a href="#">
            <i class="fa fa-list-ul"></i> <span>{{ trans('admin.dashboard') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('settings')[1] }}">
            <li><a href="{{ url('admin') }}"><i class="fa fa-cog"></i>{{ trans('admin.dashboard') }}</a></li>
            <li><a href="{{ url('admin/settings') }}"><i class="fa fa-cog"></i>{{ trans('admin.settings') }}</a></li>
        </ul>
    </li>

    {{--    @endif--}}

    {{--    @if(auth()->user()->hasRole('laravel'))--}}
    <li class="treeview {{ active_menu('admin')[0] }}">
        <a href="#">
            <i class="fa fa-user-secret"></i> <span>{{ trans('admin.admin') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('admin')[1] }}">
            <li><a href="{{ url('admin/admin') }}"><i class="fa fa-users"></i>{{ trans('admin.admin') }}</a></li>
            <li><a href="{{url(route('admin.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.create')}}</a></li>
        </ul>
    </li>
    {{--    @endif--}}

    <li class="treeview {{ active_menu('client')[0] }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.client') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('client')[1] }}">
            <li class=""><a href="{{ url('admin/client') }}"><i class="fa fa-flag"></i>{{ trans('admin.client') }}</a>
            </li>
            <li class=""><a href="{{ url(route('client.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('seller')[0] }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.seller') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('seller')[1] }}">
            <li class=""><a href="{{ url('admin/seller') }}"><i class="fa fa-flag"></i>{{ trans('admin.seller') }}</a>
            </li>
            <li class=""><a href="{{ url(route('seller.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('category')[0] }}">
        <a href="#">
            <i class="fa fa-filter"></i> <span>{{ trans('admin.category') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('category')[1] }}">
            <li class=""><a href="{{ url('admin/category') }}"><i class="fa fa-flag"></i>{{ trans('admin.category') }}</a>
            </li>
            <li class=""><a href="{{ url(route('category.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('product')[0] }}">
        <a href="#">
            <i class="fa fa-product-hunt"></i> <span>{{ trans('admin.product') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('product')[1] }}">
            <li class=""><a href="{{ url('admin/product') }}"><i class="fa fa-flag"></i>{{ trans('admin.product') }}</a>
            </li>
            <li class=""><a href="{{ url(route('product.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('order')[0] }}">
        <a href="#">
            <i class="fa fa-first-order"></i> <span>{{ trans('admin.order') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('order')[1] }}">
            <li class=""><a href="{{ url('admin/order') }}"><i class="fa fa-flag"></i>{{ trans('admin.order') }}</a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('payment-method')[0] }}">
        <a href="#">
            <i class="fa fa-paypal"></i> <span>{{ trans('admin.payment-method') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('payment-method')[1] }}">
            <li class=""><a href="{{ url('admin/payment-method') }}"><i class="fa fa-flag"></i>{{ trans('admin.payment-method') }}</a>
            </li>
            <li class=""><a href="{{ url(route('payment-method.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('comment')[0] }}">
        <a href="#">
            <i class="fa fa-comments"></i> <span>{{ trans('admin.comment') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('comment')[1] }}">
            <li class=""><a href="{{ url('admin/comment') }}"><i class="fa fa-flag"></i>{{ trans('admin.comment') }}</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{url(route('getChangePassword'))}}"><i class="fa fa-map-pin text-red"></i>
            <span>{{trans('admin.changePassword')}}</span></a>
    </li>

</ul>
