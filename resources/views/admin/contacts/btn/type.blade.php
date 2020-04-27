@if ($type == 'complaint')
    <div class="alert alert-danger" style="text-align: center;font-size: 16px">
        {{trans('admin.complaint')}}
    </div>
@elseif ($type == 'suggestion')
    <div class="alert alert-success" style="text-align: center;font-size: 16px">
        {{trans('admin.suggestion')}}
    </div>
@elseif ($type == 'enquiry')
    <div class="alert alert-info" style="text-align: center;font-size: 16px">
        {{trans('admin.enquiry')}}
    </div>
@endif
