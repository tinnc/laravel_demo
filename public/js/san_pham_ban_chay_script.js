$(document).ready(function() {
    //alert(123);
    interval = setInterval(function() { change_images_next(); }, 6000);
    bien_dem = 0;
    so_luong = 6;

    function startloop() {
        interval = setInterval(function() { change_images_next(); }, 6000);
    }

    function pauseLoop() {
        window.clearInterval(interval);
    }

    $(".wrapper").hover(
        function() {
            //alert("pause");
            pauseLoop(); // pause the loop
        },
        function() {
            //alert("unpause");
            startloop(); //scroll()
        });

    function change_images_next() {
        //alert("#best_sale_product_"+bien_dem);
        if (bien_dem >= so_luong - 1) {
            bien_dem = 0;
        }
        $("#best_sale_product_" + bien_dem).show("slow");
        $("#best_sale_product_" + (bien_dem + 1)).show("slow");
        for (i = 0; i < so_luong; i++) {
            if (i != bien_dem && i != bien_dem + 1) {
                $("#best_sale_product_" + i).hide("slow");
            }
        }
        bien_dem += 2;
    }

    function change_images_prev() {
        //alert("#best_sale_product_"+bien_dem);
        if (bien_dem <= 0) {
            bien_dem = so_luong - 1;
        }
        $("#best_sale_product_" + bien_dem).show("slow");
        $("#best_sale_product_" + (bien_dem - 1)).show("slow");
        for (i = 0; i < so_luong; i++) {
            if (i != bien_dem && i != bien_dem - 1) {
                $("#best_sale_product_" + i).hide("slow");
            }
        }
        bien_dem -= 2;
    }
    $(".prev_button_slide_best_sale").click(function() {
        change_images_prev();
    })
    $(".next_button_slide_best_sale").click(function() {
        change_images_next();
    })
    $(".wrapper").hover(function() {
            $(".prev_button_slide_best_sale").show();
            $(".next_button_slide_best_sale").show();
        },
        function() {
            $(".prev_button_slide_best_sale").hide();
            $(".next_button_slide_best_sale").hide();
        })
});