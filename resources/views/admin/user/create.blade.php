@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><h3><a href="{{ route('user.index') }}">Users</a> :: Create User Profile</h3></div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h2>
                        <ul class="validation_error">
                            @foreach( $errors->all() as $error )
                                <li class="alert alert-danger">{{ $error }}</li>
                            @endforeach
                            @if (session('alert'))
                                <div class="alert alert-danger">{{ session('alert') }}</div>
                            @endif
                        </ul>
                    </h2>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name :</label>
                                <input type="text" name="name" class="form-control col-md-9 col-sm-9 col-xs-12" required >
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email :</label>
                                <input type="email" class="form-control col-md-9 col-sm-9 col-xs-12" name="email" required>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password :</label>
                                <input type="password" class="form-control col-md-9 col-sm-9 col-xs-12" name="password" required>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Role :</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="role_id" required>
                                        @foreach ($roles as $parent_id => $name)
                                            <option value="{{ $parent_id }}">{{ strtoupper($name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="x_panel">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Image :</label>
                                <div class="x_panel">
                                    <input type="file" class="image_user col-md-9 col-sm-9 col-xs-12" name="image_user">
                                </div>
                                <div id="image-holder"></div>
                            </div>

                            <div class="x_panel">
                                <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.image_user').on('change', function () {
        if (typeof(FileReader) != 'undefined') {
            var image_holder = $('#image-holder');
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $('<img />', {
                    'src': e.target.result,
                    'class': 'thumb-image'
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
        else {
            alert('This browser does not support FileReader.');
        }
    });

    $('.alert').fadeTo(3000, 3000).slideUp(3000, function () {
        $('.alert').slideUp(3000);
    });
</script>

@endsection
