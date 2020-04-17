
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
