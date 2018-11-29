@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><a href="{{ route('user.index') }}">Home</a> :: User Profile Create</h3>
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
                        <div class="x_content">
                            <div class="x_title">
                                    <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                                <div class="clearfix"></div>
                            </div>
                            <h2>
                                @if (session('alert'))
                                <div class="alert alert-danger" id="alert_danger">{{ session('alert') }}</div>
                                @endif
                                <!-- validation error -->
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <!-- END validation error -->
                            </h2>
                            <div class="x_content">
                                {{--  --}}
                                    <!-- validation error -->
                                    <div class="">
                                        <ul class="validation_error"></ul>
                                        {!! Form::open(['route'=> [
                                            'user.store'],
                                            'files'=>true,
                                        ]) !!}
                                            <div class="x_panel">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name :</label>
                                                {!! Form::text('name', null, [
                                                    'required',
                                                    'placeholder'=>'Name',
                                                    'class'=>"form-control col-md-9 col-sm-9 col-xs-12"
                                                ]) !!}
                                            </div>
                                            <div class="x_panel">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email :</label>
                                                    {!! Form::text('email', null, [
                                                        'required',
                                                        'placeholder'=>'Email',
                                                        'class'=>"form-control col-md-9 col-sm-9 col-xs-12"
                                                    ]) !!}
                                            </div>
                                            <div class="x_panel">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Password :</label>
                                                    {!! Form::text('password', null, [
                                                        'required',
                                                        'placeholder'=>'Password',
                                                        'class'=>'form-control col-md-9 col-sm-9 col-xs-12'
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
                                                <div id="image-holder"></div>
                                            </div>
                                            <div class="x_panel">
                                                <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                                                {!! Form::submit('Save', [
                                                    'class'=>'btn btn-success',
                                                    'type'=>'submit'
                                                ]) !!}
                                            </div>
                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".image_user").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("#image-holder");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });

    $("#alert_danger").fadeTo(1500, 700).slideUp(700, function(){
    $("#alert_danger").slideUp(700);
    });
</script>
@endsection
