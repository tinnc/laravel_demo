@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
      <div class="page-title">
          <div class="title_left">
            <h3>Products</h3>
          </div>
          <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go!</button>
                      </span>
                  </div>
              </div>
          </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
          <div class="x_panel">
              <div class="x_content">
                  <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>
                <div class="x_title"><h2></h2></div>
                </div>
                <!-- start project list -->
                <table class="table table-striped projects">
                  <thead>
                    <tr>
                      <th style="width: 20%">Name</th>
                      <th style="text-align: center;">Type</th>
                      <th style="width: 15% ;text-align: center;">Price</th>
                      <th style="text-align: center;">Status</th>
                      <th style="text-align: center;">Summary</th>
                      <th style="width: 10% ; text-align: center;">Image</th>
                      <th style="width: 15%; text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($products as $product)
                        <tr>
                          <td>
                            <a href="{{ route('product.show', $product->alias ) }}"><small>{{ $product->name }}</small></a>
                          </td>
                          <td>
                            <small>{{ $product->category ? $product->category->name : '' }}</small>
                          </td>
                          <td align="right">
                            <small>{{ number_format($product->price) }} VNĐ</small>
                          </td>
                          <td align="middle">
                            <small>{{$product->status ? 'Stocking' : 'Out of stock'}}</small>
                          </td>
                          <td>
                            <label style="text-overflow: ellipsis;height:75px; width: 200px;border: 1px solid;padding: 2px 5px;overflow: hidden;">
                              <small>{{$product->summary}}</small>
                            </label>
                          </td>
                          <td>
                            <img src="{{ asset("images/san_pham/{$product->image}" ) }}" class="avatar" alt="product" style="width:70px; height:70px">
                          </td>
                          <td align="center">
                          {{ Form::open([
                                'route' => ['product.destroy',$product->id],
                                'method' => 'delete',
                          ]) }}
                              <a href="{{ route('product.show', $product->alias) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a>
                              <a href="{{ route('product.edit', [$product->alias,  $product->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                              {!! Form::button('<i class="fa fa-trash-o"></i>', [
                                'class'=>'btn btn-danger btn-xs',
                                'type'=>'submit',
                              ]) !!}
                          {{ Form::close() }}
                          </td>
                        </tr>
                      @endforeach
                    {{-- @endif --}}
                  </tbody>
                </table>
                <!-- end project list -->
                <div class="title_right">{{ $products->links() }}</div>
          </div>
      </div>
    </div>
</div>
@endsection
