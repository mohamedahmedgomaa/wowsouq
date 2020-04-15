
@push('js')
     <?php
    $lat = !empty(old('lat')) ? old('lat'):'30.06303689611116';
    $lng = !empty(old('lng')) ? old('lng'):'31.23264503479004';
    ?>
    <script>
        $('#us1').locationpicker({
            location: {
                latitude: {{ $lat }},
                longitude: {{ $lng }},
            },
            radius: 300,
            markerIcon: "{{ url('design/adminlte/dist/img/map-marker-2-xl.png') }}",
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                // radiusInput: $('#us2-radius'),
                locationNameInput: $('#address')
            }

        });
    </script>
@endpush
<input type="hidden" value="{{ $lat }}" id="lat" name="latitude">
<input type="hidden" value="{{ $lng }}" id="lng" name="longitude">

<div class="form-group">
    <label for="name">{{trans('admin.name')}}</label>
    {!! Form::text('name', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="email">{{trans('admin.email')}}</label>
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="password">{{trans('admin.password')}}</label>
    {!! Form::password('password', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="password_confirmation">{{trans('admin.confirmation_password')}}</label>
    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="phone">{{trans('admin.phone')}}</label>
    {!! Form::number('phone', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="image">{{trans('admin.image')}}</label>
    <input type="file" class="form-control-file" name="image">
    @if ($model->image != null)
        <img src="{{Storage::url($model->image)}}" alt="000000" class="img-thumbnail"
             width="50px" height="50px">
    @endif
</div>

<div class="form-group">
    <label for="delivery">{{trans('admin.delivery')}}</label>
    {!! Form::number('delivery', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', trans('admin.address')) !!}
    {!! Form::text('address', old('address'), ['class'=>'form-control address']) !!}
</div>

<div class="form-group">
    <div id="us1" style="width: 100%; height: 400px;"></div>
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">{{trans('admin.submit')}}</button>
</div>

