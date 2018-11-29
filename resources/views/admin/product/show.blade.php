@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="{{ route('product.index') }}">Products</a> :: Product Detail</h3>
        </div>
    </div>
    <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>ID: {!! $product->id !!} - Name: {!! $product->name !!}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (!isset($product))
                            Product :: Null
                        @else

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type :</label>
                                <b>{{$product->category->name}}</b>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status :</label>
                                <b>{{$product->status ? 'Stocking' : 'Out of stock'}}</b>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Image :</label>
                                <div id="image-holder"><img src="{{ asset('images/san_pham/' . $product->image) }}" style="width:150px; height:150px"/></div>
                            </div>

                            <div class="x_panel">
                                <div class="x_title">
                                    <h5>Detail :</h5>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content"> <small>{!!$product->detail!!}</small></div>
                            </div>

                            <div class="x_panel">
                                <div class="x_title">
                                    <h5>Summary :</h5>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">{!!$product->summary!!}</div>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Price :</label>
                                {{number_format($product->price)}}
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount :</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">{{$product->discount ? $product->discount : 'Updating...'}}</div>
                            </div>

                            <div class="x_panel">
                                <a href="{{ route('product.index') }}" class="btn btn-primary">Cancel</a>
                                <a href="{{ route('product.edit', [$product->alias, $product->id]) }}" class="btn btn-success">Edit</a>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
