<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal55">
    {{trans('admin.addWallet')}}
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal55" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add to the wallet ({{ $wallet }} $)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('clients.wallet',$id) }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="wallet">{{trans('admin.wallet')}}</label>
                        {!! Form::number('wallet', null , ['class' => 'form-control']) !!}
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{trans('admin.saveChanges')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
