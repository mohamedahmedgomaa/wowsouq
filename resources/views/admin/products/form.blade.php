@inject('categories', 'App\Model\Category')
@inject('sellers', 'App\Model\Seller')

<div class="form-group">
    <label for="name">{{trans('admin.name')}}</label>
    {!! Form::text('name', null , ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    <label for="description">{{trans('admin.description')}}</label>
    {!! Form::textarea('description', null , ['class' => 'form-control']) !!}
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
    <label for="price">{{trans('admin.price')}}</label>
    {!! Form::text('price', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="offer">{{trans('admin.offer')}}</label>
    {!! Form::text('offer', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="number_product">{{trans('admin.number_product')}}</label>
    {!! Form::number('number_product', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="category_id">{{trans('admin.category')}}</label>
    {!! Form::select('category_id',$categories->pluck('name_ar', 'id') , old('category_id'),
     ['class'=>'form-control select2', 'placeholder' => '..............']) !!}
</div>

<div class="form-group">
    <label for="seller_id">{{trans('admin.seller')}}</label>
    {!! Form::select('seller_id',$sellers->pluck('name', 'id') , old('seller_id'),
     ['class'=>'form-control select2', 'placeholder' => '..............']) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">{{trans('admin.submit')}}</button>
</div>
