<!-- Trigger the modal with a button -->
<button type="button" class="alert alert-info" data-toggle="modal"
        data-target="#message_contact{{ $id }}">{{trans('admin.message')}}</button>

<!-- Modal -->
<div id="message_contact{{ $id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5>{{trans('admin.message')}}</h5>
            </div>
            <div class="modal-body">
                {{$message}}
            </div>
        </div>

    </div>
</div>
