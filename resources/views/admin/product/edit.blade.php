@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="{{ route('product.index') }}">Products</a> :: Product Update</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Update :: {!! $product->name !!}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if (!isset($product))
                        Product :: Null
                    @else
                        <ul class="validation_error"></ul>
                        {{ Form::open(['route' => ['product.update',  $product->alias, $product->id], 'method' => 'put', 'files' => true]) }}

                            <div class="x_panel">
                                {!! Form::label('name', 'Name :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-1']) !!}
                                {!! Form::text('name', $product->name, ['required', 'placeholder' => 'Name', 'class' => 'col-md-9 col-sm-9 col-xs-9']) !!}
                            </div>

                            <div class="x_panel">
                                {!! Form::label('category', 'Category :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                {!! Form::select('category_id', $category_id, sprintf($product->category_id), ['class' => 'col-md-3 col-sm-3 col-xs-12']) !!}
                            </div>

                            <div class="x_panel">
                                {!! Form::label('image', 'Image :', ['class' => 'x_title control-label col-md-12 col-sm-12 col-xs-12']) !!}
                                {!! Form::file('image_product', ['accept' => '.png,.jpg,.gif', 'class' => 'image_product col-md-9 col-sm-9 col-xs-12 x_panel']) !!}
                                <div id="image-holder" style="text-align: center;">
                                    <img src="{{ asset('images/san_pham/' . $product->image) }}"/>
                                </div>
                            </div>

                            <div class="x_panel">
                                {!! Form::label('detail', 'Detail :', ['class' => 'x_title control-label col-md-12 col-sm-12 col-xs-12']) !!}
                                <div class="x_content">
                                    {!! Form::textarea('detail', $product->detail, [
                                                                    'id' => 'detail',
                                                                    'placeholder' => 'Detail',
                                                                    'cols' => '70', 'rows' => '3',
                                                                    'style' => 'visibility: hidden; display: none',
                                                                    'class' => 'ckeditor col-md-9 col-sm-9 col-xs-12'])
                                    !!}
                                </div>
                            </div>

                            <div class="x_panel">
                                {!! Form::label('summary', 'Summary :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-1']) !!}
                                {!! Form::textarea('summary', $product->summary, [
                                                                'id' => 'summary',
                                                                'placeholder' => 'Summary',
                                                                'cols' => '70', 'rows' => '3',
                                                                'class' => 'col-md-9 col-sm-9 col-xs-9'])
                                !!}
                            </div>

                            <div class="x_panel">
                                {!! Form::label('price', 'Price :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-1']) !!}
                                {!! Form::number('price', $product->price, [
                                                            'required',
                                                            'placeholder' => 'Price',
                                                            'class' => 'col-md-2 col-sm-2 col-xs-2'])
                                !!}
                                {!! Form::label('vnd', 'VNĐ', ['class' => 'control-label col-md-2 col-sm-2 col-xs-1']) !!}
                            </div>

                            <div class="x_panel">
                                {!! Form::label('discount', 'Discount :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-1']) !!}
                                {!! Form::textarea('discount', $product->discount, [
                                                                'class' => 'col-md-9 col-sm-9 col-xs-12',
                                                                'id' => 'discount',
                                                                'placeholder' => 'Discount',
                                                                'cols' => '70', ' rows' => '3'])
                                !!}
                            </div>

                            <div class="x_panel">
                                <a href="{{ route('product.index') }}" class="btn btn-primary">Cancel</a>
                                {!! Form::submit('Save', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                            </div>

                        {{ Form::close() }}


                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{ Html::script ('ckeditor/ckeditor.js') }}

<script type="text/javascript">CKEDITOR.replace( 'detail', { customConfig: '{{ asset("ckeditor/baiviet_config.js") }}' } ); </script>

<script>
    $('.image_product').on('change', function () {
        if (typeof(FileReader) != 'undefined') {
            var image_holder = $( '#image-holder' );
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $( '<img />', {
                    'src': e.target.result,
                    'class': 'thumb-image'
                } ).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
        else {
            alert('This browser does not support FileReader.');
        }
    });
</script>

@endsection
