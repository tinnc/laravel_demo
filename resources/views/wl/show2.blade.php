@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">

    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3><a href="{{ route('product.index') }}">Home</a> :: Product Detail</h3>
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
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>{!! $product->name !!}</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="product-image">
                  <img src="{{ asset("images/san_pham/{$product->image}" ) }}" alt="..." />
                </div>
              </div>

              <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                <h3 class="prod_title">{{ $product->name }}</h3>

                <p>{{ $product->summary }}</p>
                <br />

                <div class="">
                  <h2>Available Colors</h2>
                  <ul class="list-inline prod_color">
                    <li>
                      <p>Green</p>
                      <div class="color bg-green"></div>
                    </li>
                    <li>
                      <p>Blue</p>
                      <div class="color bg-blue"></div>
                    </li>
                    <li>
                      <p>Red</p>
                      <div class="color bg-red"></div>
                    </li>
                    <li>
                      <p>Orange</p>
                      <div class="color bg-orange"></div>
                    </li>

                  </ul>
                </div>
                <br />

                <div class="">
                  <h2>Size <small>Please select one</small></h2>
                  <ul class="list-inline prod_size">
                    <li>
                      <button type="button" class="btn btn-default btn-xs">Small</button>
                    </li>
                    <li>
                      <button type="button" class="btn btn-default btn-xs">Medium</button>
                    </li>
                    <li>
                      <button type="button" class="btn btn-default btn-xs">Large</button>
                    </li>
                    <li>
                      <button type="button" class="btn btn-default btn-xs">Xtra-Large</button>
                    </li>
                  </ul>
                </div>
                <br />

                <div class="">
                  <div class="product_price">
                    <h1 class="price">{!! number_format($product->price)  !!} vnd</h1>
                    <span class="price-tax"></span>
                    <br>
                  </div>
                </div>

                <div class="">
                  <button type="button" class="btn btn-default btn-lg">Add to Cart</button>
                  <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
                </div>

                <div class="product_social">
                  <ul class="list-inline">
                    <li><a href="#"><i class="fa fa-facebook-square"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-twitter-square"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-envelope-square"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-rss-square"></i></a>
                    </li>
                  </ul>
                </div>

              </div>


              <div class="col-md-12">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Detail</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Discount</a>
                    </li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                      <p>{!! $product->detail !!}</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                      <p>{!! $product->discount ? $product->discount : 'updating...' !!}</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- footer content -->
    <footer>
      <div class="copyright-info">
        <p class="pull-right">Laravel 5.6<a href="#"></a>
        </p>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->

  </div>
@endsection
