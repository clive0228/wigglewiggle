var loadflag = false;
var loading = function() {
    loadtimer = setInterval(function() {
        if(loadflag==false) {
            $("#heart_loading").animate({"width": "6%", "margin-left": "-3%"});
            loadflag = true;
        } else {
            $("#heart_loading").animate({"width": "8%", "margin-left": "-4%"});
            loadflag = false;
        }
    }, 600);
};
loading();

$(window).load(function(){
    $("#loading").hide();
    clearInterval(loadtimer);
});

$(document).ready(function(){
    var menuflag = false;
    var wid = $(window).width();
    $(window).resize(function(){
        wid = $(window).width();
    });
    $("#menu_btn").click(function(e){
        if(menuflag == false){
            e.preventDefault();
            if(wid > 512) {
                $(".menu").animate({"right": "85%"}, 400);
            } else {
                $(".menu").animate({"right": "70%"}, 400);
                $(".menu").css("position", "fixed");
            }
            menuflag = true;
            return false;
        }
    });
    $(document).click(function(){
        if(menuflag == true){
            $(".menu").animate({"right": "100%"}, 400);
            menuflag = false;
        }
    });

});