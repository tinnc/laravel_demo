@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><h3><a href="{{ route('user.index') }}">Users</a> :: User Profile</h3></div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ID: {!! $user->id !!} - Name: {!! $user->name !!}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if (!isset($user))
                        User :: Null
                    @else
                        <form>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender :</label>
                                <b>{{ $user->gender ? 'Female' : 'Male' }}</b>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email :</label>
                                <b>{{ $user->email }}</b>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday :</label>
                                <b>{{ $user->birthday_format }}</b>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone :</label>
                                <b>{{ $user->phone_number_format }}</b>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Image :</label>
                                <div id="image-holder">
                                    <img src="{{ asset('images/user_image/' . $user->image_format) }}" style="width:150px; height:150px">
                                </div>
                            </div>

                            <div class="x_panel">
                                <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-success">Edit</a>
                            </div>

                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
