function addtocart(id_san_pham) {
    //alert(123);
    //url = "http://localhost:81/web-laravel/add_to_cart";
    //alert(url);
    $.ajax({
        url: 'http://localhost:81/web-laravel/add_to_cart',
        type: "get",
        data: { 'id_sp': id_san_pham },
        success: function(data) {
            //alert(data);
            $(".so_luong_gio_hang_fixed").html(data);
            $(".so_luong_gio_hang").html(data);
            $(".so_luong_gio_hang_fixed").show();
            $(".so_luong_gio_hang").show();
            $("#link_gio_hang").attr("onclick", "");
            $("#link_gio_hang_fixed").attr("onclick", "");
            if (data) {
                //alert(data);
                $(".gio_hang_fixed img").attr("src", "http://localhost:81/web-laravel/images/cart_full.png");
                $(".gio_hang img").attr("src", "http://localhost:81/web-laravel/images/cart_full.png")
            }
        }
    });
}

function empty_cart() {
    alert("Hiện chưa có sản phẩm nào trong giỏ hàng!");
    return false;
}