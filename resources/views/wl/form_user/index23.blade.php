@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3> Users </h3>
        </div>
        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button"> Go! </button>
              </span>
            </div>
          </div>
        </div>
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="x_panel">
            <div class="x_content">
              <a href="{{ route('user.create') }}" class="btn btn-primary"> Create </a>
              <div class="x_title">
                <h2>
                  @if (session('alert'))
                    <div class="alert alert-danger" id="alert_danger">{{ session('alert') }}</div>
                  @endif
                </h2>
              </div>
              <table class="table table-striped projects">

                <thead>
                  <tr>
                    <th style="width: 10%; text-align: center;"> Name </th>
                    <th style="width: 10%; text-align: center;"> Gender </th>
                    <th style="width: 10%; text-align: center;"> Birthday </th>
                    <th style="width: 10%; text-align: center;"> Role </th>
                    <th style="width: 15%; text-align: center;"> Phone </th>
                    <th style="width: 10%; text-align: center;"> Email </th>
                    <th style="width: 20%; text-align: center;"> Image </th>
                    <th style="width: 15%; text-align: center;"> Action </th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($users as $user)
                    <tr style="text-align: center; vertical-align: middle;">

                      <td>
                        <a href="{{ route('user.show', $user ) }}">
                          <small> {{ $user->name }} </small>
                        </a>
                      </td>

                      <td>
                        <small> {{ $user->gender ? 'Female' : 'Male' }} </small>
                      </td>

                      <td>
                        <small> {{ $user->birthday ? Carbon\Carbon::parse($user->birthday)->format('d-m-Y') : '' }} </small>
                      </td>

                      <td>
                        <small> {{ $user->role ? $user->role->name : '' }} </small>
                      </td>

                      <td>
                        <small> {!! $user->phone_number ? $user->phone_number : '' !!} </small>
                      </td>

                      <td>
                        <small> {{ $user->email }} </small>
                      </td>

                      <td style="text-align: center; vertical-align: middle;">
                        <img src="{{ asset("images/user_image/{$user->image}") }}" alt="image user" style="width:70px; height:70px;">
                      </td>

                      <td>
                        <form method="POST" action="{{ route('user.destroy', $user) }}">
                          <input name="_method" type="hidden" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">

                          <a href="{{ route('user.show', $user) }}" class="btn btn-primary btn-xs">
                            <i class="fa fa-folder"></i>
                          </a>

                          <a href="{{ route('user.edit', $user) }}"  class="btn btn-info btn-xs" >
                            <i class="fa fa-pencil"></i>
                          </a>

                          <button type="submit" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash-o"></i>
                          </button>

                        </form>
                      </td>

                    </tr>
                  @endforeach
                </tbody>

              </table>
          <div class="title_right"> {{ $pages }} </div>
        </div>
      </div>
    </div>
</div>

<script>
$("#alert_danger").fadeTo(3000, 3000).slideUp(3000, function () {
    $("#alert_danger").slideUp(3000);
});
</script>

@endsection
