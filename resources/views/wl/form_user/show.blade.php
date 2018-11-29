@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><a href="{{ route('user.index') }}">Home</a> :: User Profile</h3>
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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                        <h2>ID: {!! $user->id !!} - Name: {!! $user->name !!}</h2>
                        <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            {{--  --}}
                                @if (!isset($user))
                                    User :: Null
                                @else
                                <div class="">
                                    <ul class="validation_error"></ul>
                                    {{ Form::open([]) }}
                                        <div class="x_panel">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email :</label>
                                            <b>{{$user->email}}</b>
                                        </div>
                                        <div class="x_panel">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Image :</label>
                                            <div id="image-holder"><img src="{{ asset("images/user_image/{$user->image}") }}" style="width:150px;height:150px"/></div>
                                        </div>
                                        <div class="x_panel">
                                            <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                                            <a href="{{ route('user.edit', $user) }}" class="btn btn-success">Edit</a>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
