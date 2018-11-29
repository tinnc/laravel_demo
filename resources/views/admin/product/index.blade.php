@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><a href="{{ route('product.index') }}"><h3>Products</h3></a></div>
        <div class="title_right">
            <form method="POST" action="{{ route('product.search') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input name="name" type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                                <button id="btn_search" class="btn btn-default" type="submit">Go!</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="x_panel">
            <div class="x_content">
                <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>
                <div class="x_title"></div>
            </div>
            <table class="table table-striped projects index_user">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Summary</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><a href="{{ route('product.show', $product->alias ) }}"><small>{{ $product->name }}</small></a></td>
                            <td><small>{{ $product->category ? $product->category->name : '' }}</small></td>
                            <td><small>{{ number_format($product->price) }} VNĐ</small></td>
                            <td><small>{{ $product->status ? 'Stocking' : 'Out of stock' }}</small></td>
                            <td>
                                <label style="text-overflow: ellipsis;height:75px; width: 200px;border: 1px solid;padding: 2px 5px;overflow: hidden">
                                    <small>{{$product->summary}}</small>
                                </label>
                            </td>
                            <td><img src="{{ asset('images/san_pham/' . $product->image_format) }}" alt="product" style="width:70px; height:70px"></td>
                            <td>
                                {{ Form::open(['route' => ['product.destroy', $product->id], 'method' => 'delete']) }}
                                    {{-- <a href="{{ route('product.show', $product->alias) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a> --}}
                                    <a href="{{ route('product.edit', [$product->alias,  $product->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                    {{-- {!! Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-danger btn-xs','type' => 'submit']) !!} --}}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="title_right">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection
