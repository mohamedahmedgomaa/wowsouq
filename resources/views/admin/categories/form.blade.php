
<div class="form-group">
    <label for="name_ar">{{trans('admin.name_ar')}}</label>
    {!! Form::text('name_ar', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="name_en">{{trans('admin.name_en')}}</label>
    {!! Form::text('name_en', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="description_ar">{{trans('admin.description_ar')}}</label>
    {!! Form::textarea('description_ar', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="description_en">{{trans('admin.description_en')}}</label>
    {!! Form::textarea('description_en', null , ['class' => 'form-control']) !!}
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
    <button class="btn btn-primary" type="submit">{{trans('admin.submit')}}</button>
</div>

