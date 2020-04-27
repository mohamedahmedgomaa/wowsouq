@inject('products', 'App\Model\Product')


<div class="form-group">
    <label for="image">{{trans('admin.image')}}</label>
    <input type="file" class="form-control-file" name="image">
    @if ($model->image != null)
        <img src="{{Storage::url($model->image)}}" alt="000000" class="img-thumbnail"
             width="50px" height="50px">
    @endif
</div>

<div class="form-group">
    <label for="product_id">{{trans('admin.product')}}</label>
    {!! Form::select('product_id',$products->pluck('name', 'id') , old('product_id'),
     ['class'=>'form-control select2', 'placeholder' => '..............']) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">{{trans('admin.submit')}}</button>
</div>
