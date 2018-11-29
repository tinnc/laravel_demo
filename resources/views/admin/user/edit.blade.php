@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><h3><a href="{{ route('user.index') }}">Users</a> :: User Profile Update</h3></div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2><small><b>Id User</b></small> <label>: {!! $user->id !!}</label></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (!isset($user))
                    User :: Null
                @else
                    <h2>
                        <ul class="validation_error">
                            @foreach ($errors->all() as $error)
                                <li class="alert alert-danger" >{{ $error }}</li>
                            @endforeach
                        </ul>
                    </h2>
                    {{ Form::open(['route' => ['user.update',  $user],'method' => 'put','files' => true]) }}

                        <div class="x_panel">
                            {!! Form::label('name', 'Name :', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            {!! Form::text('name', $user->name, ['required', 'placeholder' => 'Name', 'class' => 'form-control col-md-9 col-sm-9 col-xs-12 form-control']) !!}
                        </div>

                        <div class="x_panel">
                            {!! Form::label('gender', 'Gender :', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div id="btn_gender" class="btn-group" data-toggle="buttons">
                                <label id="tab_male" class="btn btn-default">
                                    {!! Form::radio('gender', '0', $user->gender ? $user->gender : true) !!} Male
                                </label>
                                <label id="tab_female" class="btn btn-default">
                                    {!! Form::radio('gender', '1', $user->gender ? $user->gender : false) !!} Female
                                </label>
                            </div>
                        </div>

                        <div class="x_panel">
                            {!! Form::label('email', 'Email :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            {!! Form::text('email', $user->email, ['required', 'placeholder' => 'Email', 'class' => 'form-control col-md-9 col-sm-9 col-xs-12 form-control']) !!}
                        </div>

                        <div class="x_panel">
                            {!! Form::label('status', 'Status :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div id="btn_status" class="btn-group" data-toggle="buttons">
                                <label id="tab_deactivate" class="btn btn-default">
                                    {!! Form::radio('status_id', '0', $user->status ? $user->status : true) !!} Deactivate
                                </label>
                                <label id="tab_active" class="btn btn-default">
                                    {!! Form::radio( 'status_id', '1', $user->status ? $user->status : false ) !!} Active
                                </label>
                            </div>
                        </div>

                        <div class="x_panel">
                            {!! Form::label('birthday', 'Birthday :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            {!! Form::date('birthday', $user->birthday ? $user->birthday : null, ['required', 'class' => 'text-right']) !!}
                        </div>

                        <div class="x_panel">
                            {!! Form::label('phone', 'Phone :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="form-inline">
                                <select name='phone[area_code]' size="1" class='col-md-3 col-sm-9 col-xs-12 form-control' style="width:110px; height:34px; padding:6px; font-size:13px" required>
                                    @foreach($area_code as $key => $code)
                                        @if (isset($user->phone_number) && (str_before($user->phone_number, '-') == $code['code']))
                                            <option value="{{ $code['code'] }}" selected="selected">{{ $key }} (+{{ $code['code'] }})</option>
                                        @elseif ($code['code'] == 84)
                                            <option value="{{ $code['code'] }}" selected="selected">{{ $key }} (+{{ $code['code'] }})</option>
                                        @endif
                                        <option value="{{ $code['code'] }}"> {{ $key }} (+{{ $code['code'] }}) </option>
                                    @endforeach
                                </select>
                                {!! Form::number('phone[phone_number]', $user->phone_number ? str_after( $user->phone_number, '-' ) : null, ['required', 'placeholder' => 'Phone Number', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="x_panel">
                            {!! Form::label('image', 'Image :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="x_panel">
                                {!! Form::file('image_user', ['accept' => '.png,.jpg,.gif', 'class' => 'image_user col-md-9 col-sm-9 col-xs-12']) !!}
                            </div>
                            <div id="image-holder">
                                <img src="{{ asset('images/user_image/' . $user->image_format) }}" alt="image user" style="width:70px; height:70px;"/>
                            </div>
                        </div>

                        <div class="x_panel">
                            <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                            {!! Form::submit('Save', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                        </div>

                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const   MALE            = 0;
    const   FEMALE          = 1;
    const   DEACTIVATE      = 0;
    const   ACTIVE          = 1;

    $(() => {
        if ($('#btn_gender input[type=radio]:checked').val() == FEMALE) {
            $('#tab_female')
                .removeClass('btn-default')
                .addClass('btn-primary');
            $('#tab_male')
                .removeClass('btn-primary')
                .addClass('btn-default');
        } else {
            $('#tab_male')
                .removeClass('btn-default')
                .addClass('btn-primary');
            $('#tab_female')
                .removeClass('btn-primary')
                .addClass('btn-default');
        };

        $.get("{{ route('user.ajax-edit', $user) }}")
            .done((result) => {
                var data = JSON.parse(result);
                if (data.status == ACTIVE) {
                    $('#tab_active')
                        .removeClass('btn-default')
                        .addClass('btn-primary');
                    $('#tab_deactivate')
                        .removeClass('btn-warning text-white')
                        .addClass('btn-default');
                } else {
                    $('#tab_deactivate')
                        .removeClass('btn-default')
                        .addClass('btn-warning text-white');
                    $('#tab_active')
                        .removeClass('btn-primary')
                        .addClass('btn-default');
                };
            });
    });

    var data_post = {};
    $('.btn-group').on('click', function () {
        if ($('#btn_gender input[type=radio]:checked').val() == FEMALE) {
            $('#tab_female')
                .removeClass('btn-default')
                .addClass('btn-primary');
            $('#tab_male')
                .removeClass('btn-primary')
                .addClass('btn-default');
        } else {
            $('#tab_male')
                .removeClass('btn-default')
                .addClass('btn-primary');
            $('#tab_female')
                .removeClass('btn-primary')
                .addClass('btn-default');
        }

        if ($('#btn_status input[type=radio]:checked').val() == DEACTIVATE) {
            $('#tab_deactivate')
                .removeClass('btn-default')
                .addClass('btn-warning text-white');
            $('#tab_active')
                .removeClass('btn-primary')
                .addClass('btn-default');
        } else {
            $('#tab_active')
                .removeClass('btn-default')
                .addClass('btn-primary');
            $('#tab_deactivate')
                .removeClass('btn-warning text-white')
                .addClass('btn-default');
        }

        data_post = {
            _token: '{{csrf_token()}}',
            status_update_user: $('#btn_status input[type=radio]:checked').val()
        }

        $.ajax({
            type: 'POST', // Use POST with X-HTTP-Method-Override or a straight PUT if appropriate.
            dataType: 'json', // Set datatype - affects Accept header
            url: "{{ route('user.ajax-update', $user) }}", // A valid URL
            headers: { "X-HTTP-Method-Override": "PUT" }, // X-HTTP-Method-Override set to PUT.
            data: data_post, // Some data e.g. Valid JSON as a string
            success: function( data ) {
                // console.log( data );
            },
            error: function( data, textStatus, errorThrown ) {
                // console.log( data );
            },
        })
    });
</script>

<script>
    $('.image_user').on('change', function () {
        if (typeof(FileReader) != 'undefined') {
            var image_holder = $( '#image-holder' );
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $( '<img />', {
                    'src': e.target.result,
                    'class': 'thumb-image'
                } ).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
        else {
            alert('This browser does not support FileReader.');
        }
    });
</script>

<script>
    $('.alert').fadeTo(3000, 3000).slideUp(3000, function () {
        $('.alert').slideUp(3000);
    });
</script>

@endsection
