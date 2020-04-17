
<div class="form-group">
    <label for="name">{{trans('admin.name_en')}}</label>
    {!! Form::text('name', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="name_ar">{{trans('admin.name_ar')}}</label>
    {!! Form::text('name_ar', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="routes">{{trans('admin.routes')}}</label>
    {!! Form::text('routes', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">{{trans('admin.submit')}}</button>
</div>

