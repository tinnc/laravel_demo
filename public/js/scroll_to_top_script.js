$(document).scroll(function() {
    if ($(document).scrollTop() > 300) {
        $(".button_go_to_top").show();
    } else {

        $(".button_go_to_top").hide();
    }

    if ($(document).scrollTop() > 50) {
        $(".gio_hang_fixed").show();
    } else {
        $(".gio_hang_fixed").hide();
    }
});

$(".button_go_to_top").click(function() {
    $(".button_go_to_top").css("background", "url('http://localhost:81/web-laravel/images/button_top_active.gif') no-repeat");
    $(".button_go_to_top").css("background-size", "70px");
    $("html, body").animate({ scrollTop: 0 }, 1500, function() {
        $(".button_go_to_top").aminate({
                bot: "+=500px"
            }, 1000,
            function() {
                $(".button_go_to_top").css("bottom", "10px");

            });
        $(".button_go_to_top").css("background", "url('http://localhost:81/web-laravel/images/4_xanh.png') no-repeat");
        $(".button_go_to_top").css("background-size", "70px");
        $(".button_go_to_top").hide();
    });
});

$(".button_go_to_top").hover(function() {
        $(".button_go_to_top").css("background", "url('http://localhost:81/web-laravel/images/button_top_hover.gif') no-repeat");
        $(".button_go_to_top").css("background-size", "70px");
    },
    function() {
        $(".button_go_to_top").css("background", "url('http://localhost:81/web-laravel/images/4_xanh.png') no-repeat");
        $(".button_go_to_top").css("background-size", "70px");
    });