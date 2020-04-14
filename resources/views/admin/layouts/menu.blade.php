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
            <i class="fa fa-users"></i> <span>{{ trans('admin.admin') }}</span>
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
            <i class="fa fa-flag"></i> <span>{{ trans('admin.client') }}</span>
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

    {{--    <li>--}}
    {{--        --}}{{--        <a href="{{url(route('donation.index'))}}"><i class="fa fa-heart text-red"></i> <span>التبرعات</span></a>--}}
    {{--    </li>--}}

</ul>
