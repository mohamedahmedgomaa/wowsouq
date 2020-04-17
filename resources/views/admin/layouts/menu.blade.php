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
            <li><a href="{{url(route('admin.create'))}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
        </ul>
    </li>
    {{--    @endif--}}

    <li class="treeview {{ active_menu('client')[0] }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.clients') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('client')[1] }}">
            <li class=""><a href="{{ url('admin/client') }}"><i class="fa fa-flag"></i>{{ trans('admin.clients') }}</a>
            </li>
            <li class=""><a href="{{ url('admin/clients/trashed') }}"><i class="fa fa-flag"></i>{{ trans('admin.trashedClient') }}</a>
            </li>
            <li class=""><a href="{{ url(route('client.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('seller')[0] }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.sellers') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('seller')[1] }}">
            <li class=""><a href="{{ url('admin/seller') }}"><i class="fa fa-flag"></i>{{ trans('admin.sellers') }}</a>
            </li>
            <li class=""><a href="{{ url('admin/sellers/trashed') }}"><i class="fa fa-flag"></i>{{ trans('admin.trashedSeller') }}</a>
            </li>
            <li class=""><a href="{{ url(route('seller.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('role')[0] }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.roles') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('role')[1] }}">
            <li class=""><a href="{{ url('admin/role') }}"><i class="fa fa-flag"></i>{{ trans('admin.roles') }}</a>
            </li>
            <li class=""><a href="{{ url(route('role.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('permission')[0] }}">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.permissions') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('permission')[1] }}">
            <li class=""><a href="{{ url('admin/permission') }}"><i class="fa fa-flag"></i>{{ trans('admin.permissions') }}</a>
            </li>
            <li class=""><a href="{{ url(route('permission.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('category')[0] }}">
        <a href="#">
            <i class="fa fa-filter"></i> <span>{{ trans('admin.categories') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('category')[1] }}">
            <li class=""><a href="{{ url('admin/category') }}"><i class="fa fa-flag"></i>{{ trans('admin.categories') }}</a>
            </li>
            <li class=""><a href="{{ url(route('category.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('product')[0] }}">
        <a href="#">
            <i class="fa fa-product-hunt"></i> <span>{{ trans('admin.products') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('product')[1] }}">
            <li class=""><a href="{{ url('admin/product') }}"><i class="fa fa-flag"></i>{{ trans('admin.products') }}</a>
            </li>
            <li class=""><a href="{{ url(route('product.create')) }}"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                </a></li>
        </ul>
    </li>

    <li class="treeview {{ active_menu('order')[0] }}">
        <a href="#">
            <i class="fa fa-first-order"></i> <span>{{ trans('admin.orders') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('order')[1] }}">
            <li class=""><a href="{{ url('admin/order') }}"><i class="fa fa-first-order"></i>{{ trans('admin.orders') }}</a>
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
            <i class="fa fa-comments"></i> <span>{{ trans('admin.comments') }}</span>
            <span class="pull-right-container">
            </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('comment')[1] }}">
            <li class=""><a href="{{ url('admin/comment') }}"><i class="fa fa-flag"></i>{{ trans('admin.comments') }}</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{url(route('getChangePassword'))}}"><i class="fa fa-map-pin text-red"></i>
            <span>{{trans('admin.changePassword')}}</span></a>
    </li>

</ul>
