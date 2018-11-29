@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><a href="{{ route('user.index') }}">Home</a> :: User Profile Update</h3>
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
                        <h2><small>Update Profile:: </small>{!! $user->name !!} / <small>ID:: </small> {!! $user->id !!}</h2>
                        <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            {{--  --}}
                                @if (!isset($user))
                                    User :: Null
                                @else
                                <div class="">
                                    <ul class="validation_error"></ul>
                                    {{ Form::open([
                                        'route' => ['user.update',  $user],
                                        'method' => 'put',
                                        'files' => true
                                    ]) }}
                                        <div class="x_panel">
                                            {!! Form::label('name', 'Name', [
                                                'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
                                            ]) !!}
                                            {!! Form::text('name', $user->name, [
                                                'required', 'placeholder'=>'Name',
                                                'class'=>'form-control col-md-9 col-sm-9 col-xs-12 form-control'
                                            ]) !!}
                                        </div>
                                        <div class="x_panel">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email :</label>
                                            {!! Form::text('email', $user->email, [
                                                'required', 'placeholder'=>'Email',
                                                'class'=>'form-control col-md-9 col-sm-9 col-xs-12 form-control'
                                            ]) !!}
                                        </div>
                                        <div class="x_panel">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Image :</label>
                                            <div class="x_panel">
                                                {!! Form::file('image_user', [
                                                    'accept'=>'.png,.jpg,.gif',
                                                    "class"=>'image_user col-md-9 col-sm-9 col-xs-12'
                                                ])!!}
                                            </div>
                                            <div id="image-holder"><img src="{{ asset("images/user_image/{$user->image}" ) }}" /></div>
                                        </div>
                                        <div class="x_panel">
                                            <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                                            {!! Form::submit('Save', [
                                                'class'=>'btn btn-success',
                                                'type'=>'submit'
                                            ]) !!}
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
