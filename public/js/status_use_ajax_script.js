$(() => {
    var sta = $("input[type=radio]:checked");
    $.get("{{ route('user.edit-json', $user) }}")
        .done((result) => {
            var data = JSON.parse(result);
            if (data.status) {
                sta = 'active';
                $('#tab_active')
                    .removeClass('btn-default')
                    .addClass('btn-primary');
                $('#tab_deactivate')
                    .removeClass('btn-warning text-white')
                    .addClass('btn-default');
            } else {
                sta = 'deactivate';
                $('#tab_deactivate')
                    .removeClass('btn-default')
                    .addClass('btn-warning text-white');
                $('#tab_active')
                    .removeClass('btn-primary')
                    .addClass('btn-default');
            };
        });
});
var status_user = 0;
var data_post = {};
$(".btn-group").on("click", function() {
    if ($("input[type=radio]:checked").val().localeCompare('deactivate') == 0) {
        // $("#log").text("deactivate");
        status_user = 0;
        $('#tab_deactivate')
            .removeClass('btn-default')
            .addClass('btn-warning text-white');
        $('#tab_active')
            .removeClass('btn-primary')
            .addClass('btn-default');
    } else {
        status_user = 1;
        // $("#log").text("active");
        $('#tab_active')
            .removeClass('btn-default')
            .addClass('btn-primary');
        $('#tab_deactivate')
            .removeClass('btn-warning text-white')
            .addClass('btn-default');
    }

    data_post = {
        _token: '{{csrf_token()}}',
        status_update_user: status_user
    }
    $.ajax({
        type: 'POST', // Use POST with X-HTTP-Method-Override or a straight PUT if appropriate.
        dataType: 'json', // Set datatype - affects Accept header
        url: "{{ route('user.update-json', $user) }}", // A valid URL
        headers: { "X-HTTP-Method-Override": "PUT" }, // X-HTTP-Method-Override set to PUT.
        data: data_post, // Some data e.g. Valid JSON as a string
        success: function(data) {
            // console.log( data );
        },
        error: function(data, textStatus, errorThrown) {
            // console.log( data );
        },
    })
});