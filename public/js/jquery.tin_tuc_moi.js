function scroll_tin_tuc()
{
    //alert($(".block_tin_tuc").length);
    $(".div_chieu_dai_thuc_module").animate({
        top: "-=" + ($(".div_chieu_dai_thuc_module").height() - $(".div_all_tin_tuc").height()),
    }, 15000, function() {
        $(".div_chieu_dai_thuc_module").animate({
            top: 0,
        },2000);
    });
}
$(document).ready(function(){
    scroll_tin_tuc();
    setInterval(function(){
        scroll_tin_tuc();
    },17000);
});