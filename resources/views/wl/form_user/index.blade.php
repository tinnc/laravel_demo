@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
  <div class="">
      <div class="page-title">
          <div class="title_left">
            <h3>Users</h3>
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
      <div class="clearfix"></div>
      <div class="row">
          <div class="x_panel">
              <div class="x_content">
                  <a href="{{ route('user.create') }}" class="btn btn-primary">Create</a>
                <div class="x_title">
                  <h2>
                    @if (session('alert'))
                      <div class="alert alert-danger" id="alert_danger">{{ session('alert') }}</div>
                    @endif
                  </h2>
                </div>
                </div>
                <!-- start project list -->
                <table class="table table-striped projects">
                  <thead>
                    <tr>
                      <th style="width: 5%">Id</th>
                      <th style="width: 10%; text-align: center;">Name</th>
                      <th style="width: 10%; text-align: center;">Email</th>
                      <th style="width: 30%; text-align: center;">Image</th>
                      <th style="width: 25%; text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                        <tr style="text-align: center; vertical-align: middle;">
                          <td>
                            <a href="{{ route('user.show', $user ) }}"><small>{{ $user->id }}</small></a>
                          </td>
                          <td>
                            <a href="{{ route('user.show', $user ) }}"><small>{{ $user->name }}</small></a>
                          </td>
                          <td>
                            <small>{{ $user->email }}</small>
                          </td>
                          <td style="text-align: center; vertical-align: middle;">
                                <img src="{{ asset("images/user_image/{$user->image}" ) }}" alt="new" style="width:70px; height:70px;">
                          </td>
                          <td>
                          {{ Form::open([
                                'route' => ['user.destroy',$user->id],
                                'method' => 'delete',
                          ]) }}
                              <a href="{{ route('user.show', $user) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a>
                              <a href="{{ route('user.edit', $user) }}"  class="btn btn-info btn-xs" ><i class="fa fa-pencil" id="info"></i></a>
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
                <div class="title_right">{{ $pages }}</div>
          </div>
      </div>
    </div>
  </div>
</div>
<script>
$("#alert_danger").fadeTo(1500, 700).slideUp(700, function(){
    $("#alert_danger").slideUp(700);
});
</script>
@endsection
