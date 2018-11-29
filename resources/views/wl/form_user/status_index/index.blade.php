@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><h3>Users</h3></div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn"><button class="btn btn-default" type="button">Go!</button></span>
                </div>
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
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align: center;">Name</th>
                        <th style="width: 10%; text-align: center;">Birthday</th>
                        <th style="width: 5%; text-align: center;">Role</th>
                        <th style="width: 15%; text-align: center;">Phone</th>
                        <th style="width: 10%; text-align: center;">Email</th>
                        <th style="width: 20%; text-align: center;">Image</th>
                        <th style="width: 20%;text-align: center;">Status</th>
                        <th style="width: 10%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr style="text-align: center; vertical-align: middle;">
                            <td><a href="{{ route('user.show', $user ) }}"><small>{{ $user->name }}</small></a></td>
                            <td><small>{{ $user->birthday_format }}</small></td>
                            <td><small>{{ $user->role ? $user->role->name : '' }}</small></td>
                            <td><small>{{ $user->phone_number_format }}</small></td>
                            <td><small>{{ $user->email }}</small></td>
                            <td style="text-align: center; vertical-align: middle;">
                                <img src="{{ asset('images/user_image/' . $user->image_format) }}" alt="image user" style="width:70px; height:70px;">
                            </td>
                            <td>
                                @if (strcmp(Auth::user()->id, $user->id) == 0)
                                        <div id="btn_status_{{ $user->id }}" class="btn-group" data-toggle="buttons">
                                            <small id="tab_active_{{ $user->id }}" class="{{ $user->status ? 'btn btn-success btn-xs text-white' : 'btn btn-outline-success btn-xs text-success' }}">
                                                <input type="radio" name="status_id_{{ $user->id }}" value="1" checked="{{ $user->status ? 'checked' : '' }}">Active
                                            </small>
                                            <small id="tab_deactivate_{{$user->id}}" class="{{ $user->status ? 'btn btn-outline-warning btn-xs text-warning' : 'btn btn-warning btn-xs text-white' }}">
                                                <input type="radio" name="status_id_{{ $user->id }}" value="0" checked="{{ $user->status ? '' : 'checked' }}">Deactivate
                                            </small>
                                        </div>
                                @else
                                        <div id="btn_status_{{ $user->id }}" class="btn-group" data-toggle="buttons" disabled="disabled">
                                            <small id="tab_active_{{ $user->id }}" class="{{ $user->status ? 'btn btn-success btn-xs text-white' : 'btn btn-outline-success btn-xs text-success' }}">
                                                <input type="radio" name="status_id_{{ $user->id }}" value="1" checked="{{ $user->status ? 'checked' : '' }}">Active
                                            </small>
                                            <small id="tab_deactivate_{{$user->id}}" class="{{ $user->status ? 'btn btn-outline-warning btn-xs text-warning' : 'btn btn-warning btn-xs text-white' }}">
                                                <input type="radio" name="status_id_{{ $user->id }}" value="0" checked="{{ $user->status ? '' : 'checked' }}">Deactivate
                                            </small>
                                        </div>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.destroy', $user) }}">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="{{ route('user.show', $user) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a>
                                    @if (strcmp(Auth::user()->id, $user->id) != 0)
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                    @else
                                        <a href="{{ route('user.edit', $user) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="dialog"></div>
            <div class="title_right">{{ $users->links() }}</div>
        </div>
    </div>
</div>

<script>
    $('#alert_danger').fadeTo(3000, 3000).slideUp(3000, function () {
        $('#alert_danger').slideUp(3000);
    });
</script>

<script>
    const   ACTIVE          = 1;

    $(() => {
        var data_post = {};
        $('.btn-group').on('click', function () {
            var suffix = $(this).attr('id').match(/\d+/)[0];
            var btn_status = $('#btn_status_' + suffix);

            if (!btn_status.attr('disabled')) {
                var option_deactivate = $('#tab_deactivate_' + suffix);
                var option_active = $('#tab_active_' + suffix);
                var cnfrm  = confirm("Are you change status ?")

                if (cnfrm != true)
                {
                    return false;
                }

                btn_status.on('change', function () {
                    var radio_value  = $('input[name=status_id_'+suffix+']:checked').val();
                    if (radio_value == ACTIVE) {
                        option_active
                            .removeClass('btn-outline-success text-success')
                            .addClass('btn-success text-white');
                        option_deactivate
                            .removeClass('btn-warning text-white')
                            .addClass('btn-outline-warning text-warning');
                    } else {
                        option_deactivate
                            .removeClass('btn-outline-warning text-warning')
                            .addClass('btn-warning text-white');
                        option_active
                            .removeClass('btn-success text-white')
                            .addClass('btn-outline-success text-success');
                    }

                    data_post = {
                        _token: '{{csrf_token()}}',
                        status_update_user: radio_value
                    }

                    $.ajax({
                        type: 'POST', // Use POST with X-HTTP-Method-Override or a straight PUT if appropriate.
                        dataType: 'json', // Set datatype - affects Accept header
                        url: "{{ route('user.ajax-update', Auth::user()->id) }}", // A valid URL
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            "X-HTTP-Method-Override": "PUT"
                        },
                        // headers: { "X-HTTP-Method-Override": "PUT" }, // X-HTTP-Method-Override set to PUT.
                        data: data_post, // Some data e.g. Valid JSON as a string
                        success: function( data ) {
                            console.log( data );
                        },
                        error: function( data, textStatus, errorThrown ) {
                            // console.log( data );
                        },
                    })

                })
            } else {
                alert("Action denied !")
            }
        })
    });
</script>
@endsection
