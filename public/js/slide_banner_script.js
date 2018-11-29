$(document).ready(function() {
    //alert(123);
    interval_banner = setInterval(function() {
        change_images_banner();
    }, 6000);
    bien_dem_banner = 0;
    so_luong_banner = $(".slide_items").length;
    chieu_cao_slide = $(".slide_item_0 img").height();
    //alert(chieu_cao_slide);
    //set chieu cao cua slide
    $("#slider_banner").css("height", chieu_cao_slide + "px");

    function startloop_banner() {
        interval_banner = setInterval(function() {
            change_images_banner();
        }, 6000);
    }

    function stoploop_banner() {
        window.clearInterval(interval_banner);
    }
    $("#slider_banner").hover(
        function() {
            //alert("pause");
            stoploop_banner(); // pause the loop
        },
        function() {
            //alert("unpause");
            startloop_banner(); //scroll()
        });

    function change_images_banner() {
        //alert(".slide_item_"+bien_dem);
        if (bien_dem_banner >= so_luong_banner) {
            bien_dem_banner = 0;
        }
        $(".slide_item_" + bien_dem_banner).show("fast");
        for (i = 0; i <= so_luong_banner; i++) {
            if (i != bien_dem_banner && i != bien_dem_banner + 1) {
                $(".slide_item_" + i).hide("fast");
            }
        }
        //alert(bien_dem_banner);
        bien_dem_banner += 1;
    }

    function change_images_banner_prev() {
        if (bien_dem_banner < 0) {
            bien_dem_banner = so_luong_banner - 1;
        } else if (bien_dem_banner >= so_luong_banner) {
            bien_dem_banner = so_luong_banner - 2;
        }
        $(".slide_item_" + bien_dem_banner).show("fast");
        for (i = 0; i <= so_luong_banner; i++) {
            if (i != bien_dem_banner) {
                $(".slide_item_" + i).hide("fast");
            }
        }
        //alert(bien_dem_banner);
        bien_dem_banner -= 1;
    }
    $(".next_banner").click(function() {
        change_images_banner();
    })
    $(".prev_banner").click(function() {
        change_images_banner_prev();
    })
});