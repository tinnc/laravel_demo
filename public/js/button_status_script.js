const ACTIVE = 1;

$(() => {
    var data_post = {};
    $('.btn-group').on('click', function() {
        var suffix = $(this).attr('id').match(/\d+/)[0];
        var btn_status = $('#btn_status_' + suffix);

        if (!btn_status.attr('disabled')) {
            var option_deactivate = $('#tab_deactivate_' + suffix);
            var option_active = $('#tab_active_' + suffix);
            var cnfrm = confirm("Are you change status ?")

            if (cnfrm != true) {
                return false;
            }

            btn_status.on('change', function() {
                var radio_value = $('input[name=status_id_' + suffix + ']:checked').val();
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
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data, textStatus, errorThrown) {
                        // console.log( data );
                    },
                })

            })
        } else {
            alert("Action denied !")
        }
    })
});