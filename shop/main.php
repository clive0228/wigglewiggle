<?php
include_once('../shop/_common.php');

define("_INDEX_", TRUE);

if (G5_IS_MOBILE) {
    include_once('./main_mobile.php');
    return;
}

?>
<!DOCTYPE html>
<html>
<head>
    <link href="../css/animate.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../js/vendors/rotate.js"></script>
    <script src="../js/vendors/main.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            var wid=$(window).width();


            var heartflag = false;
            $('.about').hover(function(){
                hearttimer = setInterval(function pulse(back) {
                   width = $("#aboutus").width();
                   if(heartflag == false) {
                        $("#aboutus").animate({"width": "7%", "margin-left": "-9.5%"}, 500);
                        heartflag = true;
                    } else {
                        $("#aboutus").animate({"width": "8%", "margin-left": "-10%"}, 500);
                        heartflag = false;
                    }
                }, 500);
            }, function(){
                clearInterval(hearttimer);
            });

            var signflag = false;
            $(".stockists").hover(function(){
                signtimer = setInterval(function(){
                    if(signflag == false) {
                        $("#building_w").hide();
                        $("#building_o").show();
                        signflag = true;
                    } else {
                        $("#building_o").hide();
                        $("#building_w").show();
                        signflag = false;
                    }
                }, 400);
            }, function(){
                clearInterval(signtimer);
            });

            var taxi_angle = 0;
            var lightflag = false;
            $(".insta").hover(function(){
                taxitimer = setInterval(function(){
                    taxi_angle -= 3;
                    $("#taxi_f_w").find("img").rotate(taxi_angle);
                    $("#taxi_r_w").find("img").rotate(taxi_angle);
                }, 10);
                smoketimer = setInterval(function(){
                    $("#smoke").animate({"left": "45.5%", "opacity": "0"}, 800);
                    $("#smoke").animate({"left": "37.5%"},100);
                    $("#smoke").animate({"opacity": "1"},100);

                }, 1001);
                lighttimer = setInterval(function(){
                    if(lightflag == false){
                        $("#taxi1").hide();
                        $("#taxi2").show();
                        lightflag = true;
                    } else {
                        $("#taxi1").show();
                        $("#taxi2").hide();
                        lightflag = false;
                    }
                }, 400);
            }, function(){
                clearInterval(smoketimer);
                clearInterval(taxitimer);
                clearInterval(lighttimer);
            });

            var thunderflag = false;
            var streetflag = false;
            $(".gallery").hover(function(){
                var animation1 = "swing";
                var target1 = $("#street_sign");
                animationDuration = 1500;
                thundertimer = setInterval(function(){
                    $("#thunder").animate({"opacity": "1"}, 300);
                    $("#thunder").animate({"opacity": "0"}, 300);
                },600);
                signtimer = setInterval(function(){
                    target1.removeAttr('class');
                    target1.addClass('animated '+ animation1);
                    setTimeout(function(){
                        target1.removeClass(animation1);
                    }, animationDuration);

                }, 1600);
                snowtimer = setInterval(function(){
                    $("#snow1").animate({"opacity": "1", "margin-top": "-18%"}, 1000);
                    $("#snow3").delay(300).animate({"opacity": "1", "margin-top": "-14%"}, 1000);
                    $("#snow4").delay(600).animate({"opacity": "1", "margin-top": "-13%"}, 1000);
                    $("#snow5").delay(900).animate({"opacity": "1", "margin-top": "-21%"}, 1000);
                    $("#snow6").delay(1200).animate({"opacity": "1", "margin-top": "-20%"}, 1000);
                    $("#snow2").delay(1500).animate({"opacity": "1", "margin-top": "-21%"}, 1000);
                    $("#snow7").delay(1800).animate({"opacity": "1", "margin-top": "-17%"}, 1000);
                    $(".snow").delay(2500).animate({"opacity": "0", "margin-top": "-27%"}, 10);
                }, 1000);
            }, function(){
                clearInterval(thundertimer);
                clearInterval(signtimer);
                clearInterval(snowtimer);
            });

            // var rotation = function(){
            //     $(".wheel").rotate({
            //         angle:0,
            //         animateTo:360,
            //         callback: rotation,
            //     });
            // }

            var cart_angle = 0;
            var cartflag = false;
            var floorflag = false;
            $(".product ").hover(function(){
                cartwheeltimer = setInterval(function(){
                    cart_angle -= 3;
                    $("#wheel_f").find("img").rotate(cart_angle);
                    $("#wheel_r").find("img").rotate(cart_angle);
                }, 10);
                carttimer = setInterval(function(){
                    if(cartflag == false) {
                        $("#puppy_w").hide();
                        $("#puppy_o").show();
                        $("#cart_w").hide();
                        $("#cart_o").show();
                        cartflag = true;
                    } else {
                        $("#puppy_o").hide();
                        $("#puppy_w").show();
                        $("#cart_o").hide();
                        $("#cart_w").show();
                        cartflag = false;
                    }
                }, 500);
                var step = 1;
                womantimer = setInterval(function(){
                    switch(step){
                        case 1:
                            $("#woman2").show();
                            $(".woman:not(#woman2)").hide();
                            step += 1;
                            break;
                        case 2:
                            $("#woman3").show();
                            $(".woman:not(#woman3)").hide();
                            step += 1;
                            break;
                        case 3:
                            $("#woman2").show();
                            $(".woman:not(#woman2)").hide();
                            step += 1;
                            break;
                        case 4:
                            $("#woman1").show();
                            $(".woman:not(#woman1)").hide();
                            step = 1;
                            break;
                    }
                },600);
            }, function(){
               clearInterval(cartwheeltimer);
               clearInterval(carttimer);
               clearInterval(womantimer);
            });
            $(".product").hover(function(){
                $("#floor1").show();
                $("#floor2").hide();
            }, function(){
                $("#floor2").show();
                $("#floor1").hide();
            });
            var hei = $(document).height();
            $(window).resize(function(){
                hei = $(document).height();
            });
            $(window).scroll(function(){
                if($(window).scrollTop() + $(window).height() == hei){
                    $("#bottom").animate({"top": "81%"}, 800);
                    $("#bottom").delay(1400).animate({"top": "101%"}, 800);

                }
            });
        });
    </script>

    <style type="text/css">
        body{ overflow-y: scroll; overflow-x: hidden;  background-color: #0F75BC; }
        body > div { position: absolute; }

        .about{
            cursor: url("http://artshare.speedgabia.com/wiggle_new_web/buynow.png"), default;
        }
        #statue{
            cursor: url("http://artshare.speedgabia.com/wiggle_new_web/buynow.png"), default;
            bottom: 50%;
            width: 16%;
            left: 50%;
            margin-left: -8%;
            margin-bottom: -16%;
        }
        #aboutus{
            width: 7%;
            bottom: 50%;
            left: 50%;
            margin-left: -9.5%;
            margin-bottom: 10.5%;
        }

        #building_o{ display: none; }
        .building{
            right: 1%;
            top: 50%;
            width: 21%;
            margin-top: -22%;
        }
        #house {
            width: 17%;
            top: 50%;
            right: 23%;
            margin-top: -14.2%;
        }

        .woman {
            width: 12%;
            right: 1%;
            bottom: 50%;
            z-index: 100;
            margin-bottom: -23.5%;
        }
        .cart {
            width: 22%;
            right: 11%;
            bottom: 50%;
            margin-bottom: -21.5%;
        }
        .puppy {
            width: 9%;
            right: 28%;
            bottom: 50%;
            margin-bottom: -22%;
        }
        .woman:not(#woman1){ display: none; }
        #puppy_o, #cart_o { display: none; }
        #wheel_r {
            width: 2.3%;
            right: 16.9%;
            bottom: 50%;
            margin-bottom: -21%;
        }
        #wheel_f {
            width: 2.3%;
            right: 21.3%;
            bottom: 50%;
            margin-bottom: -21%;
        }
        .floor{
            position: absolute;
            width: 37%;
            bottom: 2%;
            left: 50%;
            margin-left: 10%;
            z-index: -1;
        }

        .taxi {
            width: 40%;
            bottom: 50%;
            margin-bottom: -23%;
            left: 2%;
            z-index: 100;
        }
        #taxi2{
            display: none;
        }
        #taxi_f_w{
            width: 3.3%;
            bottom: 49%;
            z-index: 100;
            left: 20%;
            margin-bottom: -22.5%;
        }
        #taxi_r_w{
            width: 3.3%;
            bottom: 49%;
            z-index: 100;
            left: 8%;
            margin-bottom: -22.5%;
        }
        #smoke {
            width: 4%;
            bottom: 50%;
            margin-bottom: -22%;
            left: 37.5%;
        }

        .street{
            width: 33%;
            left: 4%;
            top: 50%;
            margin-top: -19%;
        }
        #street2{
            display: none;
        }
        #street_sign{
            width: 10%;
            left: 1.5%;
            top: 50%;
            margin-top: -16%;
        }
        #thunder {
            opacity: 0;
            width: 2%;
            left: 14%;
            top: 50%;
            margin-top: -20%;
        }
        .snow{
            width: 1%;
            left: 50%;
            top: 50%;
            margin-top: -27%;
        }
        #snow1{
            /*margin-top: -18%;*/
            margin-left: -19%;
        }
        #snow2{
            /*margin-top: -21%;*/
            margin-left: -25%;
        }
        #snow3{
            /*margin-top: -14%;*/
            margin-left: -15%;
        }
        #snow4{
            /*margin-top: -13%;*/
            margin-left: -26%;
        }
        #snow5{
            /*margin-top: -21%;*/
            margin-left: -15%;
        }
        #snow6{
            /*margin-top: -20%;*/
            margin-left: -21%;
        }
        #snow7{
            /*margin-top: -17%;*/
            margin-left: -25%;
        }

        #bottom{
            top: 101%;
            left: 0;
            width: 100%;
            height: 20%;
            background-color: #EC2E38;
            z-index: 998;
        }
        #contact{
            width: 27%;
            position: absolute;
            left: 50%;
            margin-left: -30%;
            top: 50%;
        }
        #top{
            position: absolute;
            width: 3%;
            left: 50%;
            bottom: 50%;
            margin-left: 20%;
            margin-bottom: 0.5%;
        }
        #insta {
            width: 2%;
            position: absolute;
            left: 50%;
            margin-left: -30%;
            bottom: 50%;
            margin-bottom: 0.5%;
        }

        /* 팝업레이어 */
        #hd_pop {z-index:1000;position:relative;margin:0 auto;width:1000px;height:0}
        #hd_pop h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
        .hd_pops {position:absolute;border:1px solid #e2e2e2;background:#fff}
        .hd_pops_con p {padding:  0; margin: 0;}
        .hd_pops_con {}
        .hd_pops_footer {padding:10px 0;background:#EE2D38;color:#fff;text-align:right}
        .hd_pops_footer button {margin-right:5px;padding:5px 10px;border:0;background:#393939;color:#fff}
    </style>
</head>
<body>
    <?php
        include_once("menu.php");
    ?>

    <div id="menu_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/menu_icon.png" width="100%">
    </div>

    <div class="about" id="statue">
        <a href="/shop/aboutus.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/statue_main.png" width="100%"></a>
    </div>
    <div class="about" id="aboutus">
        <a href="/shop/aboutus.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/aboutus.png" width="100%"></a>
    </div>

    <div class="stockists building" id="building_w">
        <a href="/shop/stockist.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/building_white.png" width="100%"></a>
    </div>
    <div class="stockists building" id="building_o">
        <a href="/shop/stockist.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/building_orange.png" width="100%"></a>
    </div>
    <div class="stockists" id="house">
        <a href="/shop/stockist.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/wiggle_house.png" width="100%"></a>
    </div>

    <div class="product woman" id="woman1">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/woman1.png" width="100%"></a>
    </div>
    <div class="product woman" id="woman2">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/woman2.png" width="100%"></a>
    </div>
    <div class="product woman" id="woman3">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/woman3.png" width="100%"></a>
    </div>
    <div class="product puppy" id="puppy_o">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/puppy_orange.png" width="100%"></a>
    </div>
    <div class="product puppy" id="puppy_w">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/puppy_white.png" width="100%"></a>
    </div>
    <div class="product cart" id="cart_o">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/cart_orange.png" width="100%"></a>
    </div>
    <div class="product cart" id="cart_w">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/cart_white.png" width="100%"></a>
    </div>
    <div class="product wheel" id="wheel_f">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/front_wheel.png" width="100%"></a>
    </div>
    <div class="product wheel" id="wheel_r">
        <a href="http://wiggle-wiggle.com/shop/list.php?ca_id=10"><img src="http://artshare.speedgabia.com/wiggle_new_web/rear_wheel.png" width="100%"></a>
    </div>
    <div class="product floor" id="floor1">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/floor1.png" width="100%"></a>
    </div>
    <div class="product floor" id="floor2">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/floor2.png" width="100%"></a>
    </div>

    <div class="insta taxi" id="taxi1">
        <a href="http://wiggle-wiggle.com/insta/"><img src="http://artshare.speedgabia.com/wiggle_new_web/taxi1.png" width="100%"></a>
    </div>
    <div class="insta taxi" id="taxi2">
        <a href="http://wiggle-wiggle.com/insta/"><img src="http://artshare.speedgabia.com/wiggle_new_web/taxi2.png" width="100%"></a>
    </div>
    <div class="insta taxi_w "id="taxi_r_w">
        <a href="http://wiggle-wiggle.com/insta/"><img src="http://artshare.speedgabia.com/wiggle_new_web/rear_taxi_wheel.png" width="100%"></a>
    </div>
    <div class="insta taxi_w "id="taxi_f_w">
        <a href="http://wiggle-wiggle.com/insta/"><img src="http://artshare.speedgabia.com/wiggle_new_web/front_taxi_wheel.png" width="100%"></a>
    </div>
    <div class="insta" id="smoke">
        <a href="http://wiggle-wiggle.com/insta/"><img src="http://artshare.speedgabia.com/wiggle_new_web/smoke.png" width="100%"></a>
    </div>

    <div class="gallery street" id="street">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/street_peoples.png" width="100%"></a>
    </div>
    <div class="gallery" id="street_sign">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/street_sign.png" width="100%"></a>
    </div>
    <div class="gallery" id="thunder">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/thunder.png" width="100%"></a>
    </div>
    <div class="gallery snow" id="snow1">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/snow1.png" width="100%"></a>
    </div>
    <div class="gallery snow" id="snow2">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/snow2.png" width="100%"></a>
    </div>
    <div class="gallery snow" id="snow3">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/snow3.png" width="70%"></a>
    </div>
    <div class="gallery snow" id="snow4">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/snow3.png" width="70%"></a>
    </div>
    <div class="gallery snow" id="snow5">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/snow3.png" width="70%"></a>
    </div>
    <div class="gallery snow" id="snow6">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/snow3.png" width="70%"></a>
    </div>
    <div class="gallery snow" id="snow7">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/snow3.png" width="70%"></a>
    </div>


    <div id="bottom">
        <div id="contact">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/contact.png" width="100%">
        </div>
        <div id="insta">
            <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/wiggle_new_web/insta.png" width="100%"></a>
        </div>
        <div id="top">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/top.png" width="100%">
        </div>
    </div>
    
    <?php
 
    	if(defined('_INDEX_') && !G5_IS_MOBILE) { // index에서만 실행
    		include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    	} 
	?>

</body>
</html>
