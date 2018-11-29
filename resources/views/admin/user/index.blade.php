@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><a href="{{ route('user.index') }}"><h3>Users</h3></a></div>
        <div class="title_right">
            <form method="GET" action="{{ route('user.index') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input name="name" type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                                <button id="btn_search" class="btn btn-default" type="submit">Go!</button>
                        </span>
                    </div>
                </div>
            </form>
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
            <table class="table table-striped projects index_user">
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><a href="{{ route('user.show', $user ) }}"><small>#{{ $user->id }}</small></a></td>
                            <td><small>{{ $user->name }}</small></td>
                            <td><small>{{ $user->gender_format }}</small></td>
                            <td><small>{{ $user->birthday_format }}</small></td>
                            <td><small>{{ $user->role_format }}</small></td>
                            <td><small>{{ $user->phone_number_format }}</small></td>
                            <td><small>{{ $user->email }}</small></td>
                            <td>
                                <img src="{{ asset('images/user_image/' . $user->image_format) }}" alt="image user" style="width:70px; height:70px;">
                            </td>
                            <td>
                                @if (Auth::user()->id == $user->id)
                                    <a href="#" class="status_class" id="id_user_{{ $user->id }}" data-status="{{ $user->status }}">
                                        <img id="id_img_{{ $user->id }}" src="{{ asset('images/user_image/' . $user->status_format) }}" alt="status user" style="width:25px; height:25px;">
                                    </a>
                                @else
                                    <img src="{{ asset('images/user_image/' . $user->status_format) }}" alt="status user" style="width:25px; height:25px;">
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.destroy', $user) }}">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @if (Auth::user()->id != $user->id)
                                        <button id="btn_delete" type="submit" class="btn btn-danger btn-xs" style="width:25px; height:25px;"><i class="fa fa-trash-o"></i></button>
                                    @else
                                        <a href="{{ route('user.edit', $user) }}" class="btn btn-info btn-xs" style="width:25px; height:25px;"><i class="fa fa-pencil"></i></a>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

    const ACTIVE        = 1;
    const DEACTIVATE    = 0;

    $(() => {

        var data_post = {};

        $('a.status_class').on('click', function () {

            var suffix = $(this).attr('id').match(/\d+/)[0];
            var a = $('#id_user_' + suffix);
            var img = $('#id_img_' + suffix);
            var value_a = a.attr('data-status');


            var cnfrm  = confirm("Do you want to change status ?")

            if (cnfrm != true)
            {
                return false;
            }

            if (value_a == ACTIVE) {
                a.attr('data-status', DEACTIVATE);
                img.attr('src', '{{ asset("images/user_image/banned.jpg") }}');
            } else {
                a.attr('data-status', ACTIVE);
                img.attr('src', '{{ asset("images/user_image/checked.jpg") }}');
            }

            data_post = {
                status_update_user: a.attr('data-status')
            }

            $.ajax({
                type: 'POST', // Use POST with X-HTTP-Method-Override or a straight PUT if appropriate.
                dataType: 'json', // Set datatype - affects Accept header
                url: "{{ route('user.ajax-update', Auth::user()->id) }}", // A valid URL
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "X-HTTP-Method-Override": "PUT"
                },
                data: data_post, // Some data e.g. Valid JSON as a string
                success: function(data) {
                    // console.log( data );
                },
                error: function(data, textStatus, errorThrown) {
                    // console.log( data );
                },
            });

        });

        $('#btn_delete').on('click', function (event) {

            var cnfrm  = confirm("Do you want to delete ?")

            if (cnfrm != true)
            {
                event.preventDefault();
            }

        });

    });
</script>
@endsection
