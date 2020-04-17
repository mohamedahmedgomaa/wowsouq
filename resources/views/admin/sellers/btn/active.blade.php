<div class="btn-group" style="width: 140px">
    @if($status == 'activated')
        <button type="button" data-toggle="dropdown" class="btn btn-success">{{trans('admin.activated')}}</button>
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
        </button>
    @elseif($status == 'not_activated')
        <button type="button" data-toggle="dropdown" class="btn btn-danger">{{trans('admin.not_activated')}}</button>
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
        </button>
    @elseif($status == 'forbidden')
        <button type="button" data-toggle="dropdown" class="btn btn-bitbucket">{{trans('admin.forbidden')}}</button>
        <button type="button" class="btn btn-bitbucket dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
        </button>
    @endif
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ url('admin/seller/activated/'. $id ) }}">{{trans('admin.activate')}}</a></li>
        <li><a href="{{ url('admin/seller/not-activated/'. $id ) }}">{{trans('admin.not_activate')}}</a></li>
        <li><a href="{{ url('admin/seller/forbidden/'. $id ) }}">{{trans('admin.forbidding')}}</a></li>
    </ul>
</div>
