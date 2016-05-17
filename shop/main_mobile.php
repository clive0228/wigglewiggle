<?php
include_once('../shop/_common.php');

if($_SESSION["pt_view_today"] != "view") {
    set_session("pt_view_today","view");
    goto_url("/pt/");
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
    <script type="text/javascript" src="../js/vendors/main.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var loc = $(window).scrollTop();
            var heartflag = false;
            var cart_angle = 0;
            var cartflag = false;
            var signflag = false;
            var thunderflag = false;
            var streetflag = false;
            var taxi_angle = 0;
            var lightflag = false;
            var timers = [];
            var about = function(){
                timers.push(setInterval(function () {
                   width = $("#aboutus").width();
                   if(heartflag == false) {
                        $("#aboutus").animate({"width": "32%", "margin-left": "-29.5%"}, 600);
                        heartflag = true;
                    } else {
                        $("#aboutus").animate({"width": "30%", "margin-left": "-27.5%"}, 600);
                        heartflag = false;
                    }
                }, 600));
            };
            about();

            var product = function(){
                timers.push(setInterval(function(){
                    cart_angle -= 3;
                    $("#wheel_f").find("img").rotate(cart_angle);
                    $("#wheel_r").find("img").rotate(cart_angle);
                }, 10));
                timers.push(setInterval(function(){
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
                }, 500));
                var step = 1;
                timers.push(setInterval(function(){
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

                },200));
            };

            var stock = function() {
                timers.push(setInterval(function(){
                    if(signflag == false) {
                        $("#building_w").hide();
                        $("#building_o").show();
                        signflag = true;
                    } else {
                        $("#building_o").hide();
                        $("#building_w").show();
                        signflag = false;
                    }
                }, 400));
            };

            var street = function(){
                var animation1 = "swing";
                var target1 = $("#street_sign");
                animationDuration = 1500;
                timers.push(setInterval(function(){
                    $("#thunder").animate({"opacity": "1"}, 300);
                    $("#thunder").animate({"opacity": "0"}, 300);
                },600));
                timers.push(setInterval(function(){
                    target1.removeAttr('class');
                    target1.addClass('animated '+ animation1);
                    setTimeout(function(){
                        target1.removeClass(animation1);
                    }, animationDuration);

                }, 1600));
                timers.push(setInterval(function(){
                    $("#snow1").animate({"opacity": "1", "margin-top": "-28%"}, 1000);
                    $("#snow3").delay(300).animate({"opacity": "1", "margin-top": "-27%"}, 1000);
                    $("#snow4").delay(600).animate({"opacity": "1", "margin-top": "-26%"}, 1000);
                    $("#snow5").delay(900).animate({"opacity": "1", "margin-top": "-34%"}, 1000);
                    $("#snow6").delay(1200).animate({"opacity": "1", "margin-top": "-33%"}, 1000);
                    $("#snow2").delay(1500).animate({"opacity": "1", "margin-top": "-34%"}, 1000);
                    $("#snow7").delay(1800).animate({"opacity": "1", "margin-top": "-30%"}, 1000);
                    $(".snow").delay(2500).animate({"opacity": "0", "margin-top": "-40%"}, 10);
                }, 1000));
            };
            var insta = function(){
                timers.push(setInterval(function(){
                    taxi_angle -= 3;
                    $("#taxi_f_w").find("img").rotate(taxi_angle);
                    $("#taxi_r_w").find("img").rotate(taxi_angle);
                }, 10));
                timers.push(setInterval(function(){
                    $("#smoke").animate({"margin-left": "38%", "opacity": "0"}, 800);
                    $("#smoke").animate({"margin-left": "25%"},100);
                    $("#smoke").animate({"opacity": "1"},100);

                }, 1001));
                timers.push(setInterval(function(){
                    if(lightflag == false){
                        $("#taxi1").hide();
                        $("#taxi2").show();
                        lightflag = true;
                    } else {
                        $("#taxi1").show();
                        $("#taxi2").hide();
                        lightflag = false;
                    }
                }, 400));
            };

            var timeout = function(){
                for (var i = timers.length - 1; i > 0; i--) {
                    clearInterval(timers[i])
                };
            }
            $(window).scroll(function(){
                loc = $(window).scrollTop();
                timeout();
                if (loc < 450){
                    product();
                    $("#floor1").show();
                    $("#floor2").hide();
                } else if (loc < 750) {
                    stock();
                    $("#floor1").hide();
                    $("#floor2").show();
                } else if (loc < 950){
                    street();
                    insta();
                    $("#floor1").hide();
                    $("#floor2").show();
                }
            });
            $("#top").click(function(){
                scrollTop();
            });
        });
    </script>

    <style type="text/css">
        body{background-color: #0F75BC;}
        body > div {
            position: relative;
            width: 100%;
        }
        body > div > div {
            position: absolute;
            left: 50%;
            bottom: 50%;
        }
        #menu_btn{
            position: fixed;
            z-index: 100;
        }
        .aboutus{
            height: 300px;
        }
        .products{
            height: 250px;
        }
        .stockists {
            margin-top: 40px;
            height: 300px;
        }
        .streetpeoples{
            height: 300px;
        }
        .instas {
            margin-top: 30px;
            height: 300px;
        }

        .aboutus #statue {
            width: 38%;
            margin-left: -18%;
            margin-bottom: -65%;
        }
        .aboutus #aboutus {
            width: 32%;
            margin-left: -29.5%;
            margin-bottom: -1%;
        }
        .aboutus #building {
            width: 30%;
            margin-left: -45%;
            margin-bottom: -55%;
        }
        .aboutus #tower {
            width: 18%;
            margin-left: 27%;
            margin-bottom: -56%;
        }

        .products .woman {
            width: 32%;
            margin-left: 17%;
            margin-bottom: -54%;
            z-index: 99;
        }
        #woman2 {
            display: none;
        }
        #woman3 {
            display: none;
        }
        .products .puppy {
            width: 22%;
            margin-left: -40%;
            margin-bottom: -50%;
        }
        .products .cart {
            width: 60%;
            margin-left: -36%;
            margin-bottom: -48%;
        }
        .products #wheel_f {
            width: 6%;
            margin-left: -10%;
            margin-bottom: -46.5%;
        }
        .products #wheel_r {
            width: 6%;
            margin-left: 1.7%;
            margin-bottom: -46.5%;
        }
        .products .floor{
            margin-bottom: -57%;
            width: 98%;
            margin-left: -49%;
            z-index: -1;
        }

        .stockists .building{
            width: 53%;
            margin-left: -4%;
            margin-bottom: -38.5%;
        }
        .stockists #house {
            width: 40%;
            margin-left: -48%;
            margin-bottom: -38%;
        }

        .snow{
            width: 3%;
            left: 50%;
            top: 50%;
            margin-top: -50%;
            opacity: 0;
        }
        #snow1{
            /*margin-top: -18%;*/
            margin-left: 21%;
        }
        #snow2{
            /*margin-top: 21%;*/
            margin-left: 29%;
        }
        #snow3{
            /*margin-top: 14%;*/
            margin-left: 13%;
        }
        #snow4{
            /*margin-top: 13%;*/
            margin-left: 30%;
        }
        #snow5{
            /*margin-top: 21%;*/
            margin-left: 13%;
        }
        #snow6{
            /*margin-top: 20%;*/
            margin-left: 25%;
        }
        #snow7{
            /*margin-top: 17%;*/
            margin-left: 29%;
        }

        .streetpeoples .street{
            width: 80%;
            margin-left: -40%;
            margin-bottom: -37%;
        }
        .streetpeoples #street_sign{
            width: 28%;
            margin-left: -48%;
            margin-bottom: 8%;
        }
        .streetpeoples #thunder{
            width: 5%;
            margin-left: -15%;
            margin-bottom: 24%;
        }
        .streetpeoples #snow{
            width: 30%;
            margin-left: 10%;
            margin-bottom: 14%;
        }

        .instas .taxi{
            width: 90%;
            margin-left: -50%;
            margin-bottom: -3%;
            z-index: 98;
        }
        .instas #taxi_f_w{
            width: 8%;
            z-index: 99;
            margin-bottom: -3%;
            margin-left: -36%;
        }
        .instas #taxi_r_w{
            width: 8%;
            z-index: 99;
            margin-bottom: -3%;
            margin-left: -7%;
        }
        .instas #smoke{
            width: 12%;
            margin-left: 25%;
        }
        .instas #tree{
            width: 35%;
            margin-left: 13%;
            margin-bottom: 17%;
        }
        .instas .bottom {
            position: absolute;
            left: -3%;
            bottom: -5%;
            width: 106%;
            height: 120px;
            background-color: #EC2E38;
            z-index: 999;
        }
        .bottom > div {
            position: absolute;
            left: 50%;
            bottom: 50%;
        }
        .bottom #contact{
            width: 50%;
            margin-left: -40%;
            margin-bottom: -7%;
        }
        .bottom #top{
            width: 10%;
            margin-left: 30%;
            margin-bottom: -4%;
        }
        .bottom #insta{
            width: 5%;
            margin-left: -40%;
        }
    </style>
</head>
<body>
    <div class="menu">
        <div id="menu_logo">
            <a href="/shop/main_mobile.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/menu_logo.png" width="100%"/></a>
        </div>
        <div id="menu_list">
            <ul class="menu_ul">
                <?php if ($is_member) { ?>
                <li id="menu_login"><a href="/shop/mypage.php">MY PAGE</a></li>
                <li class="divider" id="menu_join"><a href="/bbs/logout.php?url=shop">LOG OUT</a></li>
                <?php } else { ?>
                <li id="menu_login"><a href="/bbs/login.php">LOG IN</a></li>
                <li class="divider" id="menu_join"><a href="/bbs/register_form.php">JOIN</a></li>
                <?php } ?>
                <li><a href="/shop/aboutus.php">ABOUT US</a></li>
                <li><a href="/shop/list.php?ca_id=10">PRODUCTS</a></li>
                <li><a href="/shop/stockist.php">STOCKISTS</a></li>
                <li><a href="/shop/street.php">STREET PEOPLE</a></li>
                <li class="divider"><a href="/insta">#WIGGLE WIGGLE</a></li>
                <li><a href="/shop/cart.php">CART</a></li>
                <li><a href="/shop/cart.php">WISHLIST</a></li>
                <li class="divider"><a href="/shop/orderinquiry.php">ORDER</a></li>
                <li><a href="/bbs/board.php?bo_table=qa">Q&A</a></li>
                <li><a href="/bbs/board.php?bo_table=notice">NOTICE</a></li>
                <li><a href="/shop/itemuselist.php">REVIEW</a></li>
            </ul>
        </div>
        <div id="menu_footer">
            <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/wiggle_new_web/menu_insta.png" width="100%"></a>
        </div>
    </div>
    <div class="aboutus">
        <div id="menu_btn">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/menu_icon.png" width="100%">
        </div>
        <div class="about" id="statue">
            <a href="/shop/aboutus.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/statue_main.png" width="100%"></a>
        </div>
        <div class="about" id="aboutus">
            <a href="/shop/aboutus.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/aboutus.png" width="100%"></a>
        </div>
        <div class="about" id="building">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/building_m.png" width="100%">
        </div>
        <div class="about" id="tower">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/tower_m.png" width="100%">
        </div>
    </div>
    <div class="products">
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
    </div>
    <div class="stockists">
        <div class="stockist building" id="building_w">
            <a href="/shop/stockist.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/building_white.png" width="100%"></a>
        </div>
        <div class="stockist building" id="building_o">
            <a href="/shop/stockist.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/building_orange.png" width="100%"></a>
        </div>
        <div class="stockist" id="house">
            <a href="/shop/stockist.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/wiggle_house.png" width="100%"></a>
        </div>
    </div>
    <div class="streetpeoples">
        <div class="gallery street" id="street1">
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
    </div>
    <div class="instas">
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
        <div class="insta" id="tree">
            <a href="http://wiggle-wiggle.com/insta/"><img src="http://artshare.speedgabia.com/wiggle_new_web/trees_m.png" width="100%"></a>
        </div>
        <div class="bottom">
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
    </div>
</body>
</html>
