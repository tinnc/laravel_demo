@extends('layouts.template_demo')

@section('content')
<div class="x_content">
  <p>Products</p>
  <!-- start project list -->
  <table class="table table-striped projects">
    <thead>
      <tr>
        <th style="width: 20%">Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Status</th>
        <th>Summary</th>
        <th style="width: 10%">Image</th>
        <th style="width: 15%; text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($products))
        @foreach($products as $product)
        @endforeach
      @endif
    </tbody>
  </table>
  <!-- end project list -->
@endsection
