<?php
    session_start();
    //$setSidEx = explode(".",$HTTP_HOST);
   // if($setSidEx[0] != "www" && $setSidEx[0] ) {
    //    header("Location: http://www." . $HTTP_HOST . $_SERVER["REQUEST_URI"]);
    //}
    //$url = urlencode("Artshare Silicone Case Launch Event - wiggle-wiggle.com/pt/");
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10">
    <title>WiggleWiggle - Labtop Sleeve</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:300,400,700" />
    <link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css"/>
    <link rel="stylesheet" type="text/css" href="css/pouch.css"/>

    <meta property="fb:app_id" content="913076015443689">
    <meta property="og:site_name" content="아트쉐어 artshare">
    <meta property="og:title" content="wigglewiggle Laptop sleeve Launching">
    <meta property="og:description" content="Let’s get it! 많은 분들이 궁금해하셨던 위글위글 랩탑 슬리브가 드디어 오늘 출시되었습니다! ✔ 자수로 만들어진 모티브로 유니크한 매력은 up!✔ 13인치, 15인치 사이즈 모두 같은 가격 29,000원위글위글의 더 많은 것이 알고 싶다면, www.wiggle-wiggle.com">
    <meta property="og:url" content="http://www.wiggle-wiggle.com/pt/">
    <meta property="og:image" content="http://artshare.speedgabia.com/pt/pouch/facebook.png">
    <meta property="og:type" content="website">

    <meta name="description" content="wigglewiggle Laptop sleeve Launching" />
    <meta name="keywords"  content="wigglewiggle Laptop sleeve Launching" />
    <meta name="Resource-type" content="Document" />

    <!--[if IE]>
        <script type="text/javascript">
             var console = { log: function() {} };
        </script>
    <![endif]-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="js/jquery.fullPage.min.js"></script>
    <script type="text/javascript" src="js/rotate.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        var wid = $(window).width();
        $(".btnClose").click(function(){
            $(".sectionShare").fadeOut(500);
        });
        $("#btn02").click(function(){
            $(".sectionShare").fadeIn(500);
        });
        if(wid > 512) {
            var instaflag = false;
            var instatimer = setInterval(function(){
                if(instaflag == false){
                    $(".insta_c").show();
                    $(".insta").hide();
                    instaflag = true;
                } else {
                    $(".insta_c").hide();
                    $(".insta").show();
                    instaflag = false;
                }
            }, 600);
            var title_flag = false;
            var title_timer = setInterval(function(){
                if(title_flag == false){
                    $("#title_1").show();
                    $("#title_2").hide();
                    title_flag = true;
                } else {
                    $("#title_1").hide();
                    $("#title_2").show();
                    title_flag = false;
                }
            }, 600);
            var rotate_flag = false;
            var rotate_timer = setInterval(function(){
                if(rotate_flag == false){
                    $("#smile").rotate({angle: 10});
                    $("#icecream").rotate({angle: 10});
                    $("#flamingo").rotate({angle: 350});
                    rotate_flag = true;
                } else {
                    $("#smile").rotate({angle: 0});
                    $("#icecream").rotate({angle: 0});
                    $("#flamingo").rotate({angle: 0});
                    rotate_flag = false;
                }
            }, 600);
        } else {
        var title_flag = false;
        var title_timer = setInterval(function(){
            if(title_flag == false){
                $("#title_1_m").show();
                $("#title_2_m").hide();
                title_flag = true;
            } else {
                $("#title_1_m").hide();
                $("#title_2_m").show();
                title_flag = false;
            }
        }, 600);
        }
        var monitor_flag = false;
        var monitor_timer = setInterval(function(){
            if(monitor_flag == false){
                $("#monitor_1").show();
                $("#monitor_2").hide();
                monitor_flag = true;
            } else {
                $("#monitor_1").hide();
                $("#monitor_2").show();
                monitor_flag = false;
            }
        }, 600);
        $("#flamingo").rotate({angle: 10});
        $("#flamingo_m").rotate({angle: 300});
        $("#icecream_m").rotate({angle: 145});

        $('#fullpage').fullpage({
            anchors: ['slide1', 'slide2', 'slide3', 'slide4', 'slide5'],
            sectionsColor: ['#F9B127','#FF9CC0','#0E5EC3','#FD639E','#F9B127'],
            easing: 'easeOutQuad',

            onLeave: function(index, nextIndex, direction) {
                if(index == 1 && direction == 'down' && wid > 512) {
                    $("#flamingo_pouch").fadeIn(600).animate({"margin-top": "-12%"}, 600);
                    $("#smile_pouch").delay(500).fadeIn(600).animate({"margin-top": "-12%"}, 600);
                    $("#icecream_pouch").delay(1000).fadeIn(600).animate({"margin-top": "-9%"}, 600);

                }
                if(index == 3 && direction == 'up' && wid > 512) {
                    $("#flamingo_pouch").fadeIn(600).animate({"margin-top": "-12%"}, 600);
                    $("#smile_pouch").delay(500).fadeIn(600).animate({"margin-top": "-12%"}, 600);
                    $("#icecream_pouch").delay(1000).fadeIn(600).animate({"margin-top": "-9%"}, 600);
                }
            },

            afterRender: function() {

            },

            afterLoad: function(anchorLink, index) {
                if(index == 1 || index == 5) {
                    $('#btn01').attr('src','http://artshare.speedgabia.com/pt/pouch/shop_y.png');
                    $('#btn02').attr('src','http://artshare.speedgabia.com/pt/pouch/share_y.png');
                }
                if(index == 2 || index == 4) {
                    $('#btn01').attr('src','http://artshare.speedgabia.com/pt/pouch/shop_p.png');
                    $('#btn02').attr('src','http://artshare.speedgabia.com/pt/pouch/share_p.png');
                }
                if(index == 3) {
                    $('#btn01').attr('src','http://artshare.speedgabia.com/pt/pouch/shop_b.png');
                    $('#btn02').attr('src','http://artshare.speedgabia.com/pt/pouch/share_b.png');
                }
            }


        });
    });
    </script>
</head>
<body>
    <div id="sectionShare" class="sectionShare">
        <div class="logo">
            <a href="/"><img src="http://artshare.speedgabia.com/pt/wigglewiggle/wigglewiggle/logo_wiggle.png" width="100%" border="0"></a>
        </div>
        <div class="btnClose">
            <img src="http://artshare.speedgabia.com/pt/wigglewiggle/wigglewiggle/btn_close.png" width="100%" border="0">
        </div>
        <div class="title">
            <img src="http://artshare.speedgabia.com/pt/pouch/facebook.png" width="100%" border="0">
        </div>
        <div class="face">
            <img src="http://artshare.speedgabia.com/pt/wigglewiggle/wigglewiggle/text_share_facebook.png" border="0" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.artshare.kr/pt/wiggle_wiggle/','window','width=600,height=430')" style="cursor:pointer" width="100%">
        </div>
    </div>

    <div class="icons" id="btns">
        <ul>
            <li><a href="/"><img src="http://artshare.speedgabia.com/pt/pouch/shop_y.png" id="btn01" width="100%" border="0"></a></li>
            <li><img src="http://artshare.speedgabia.com/pt/pouch/share_y.png" id="btn02" width="100%" border="0"></li>
        </ul>
    </div>
    <div id="fullpage">
        <div class="section" id="section1">
            <div class="labtop">
                <img src="http://artshare.speedgabia.com/pt/pouch/labtop.png" width="100%">
            </div>
            <div class="monitor" id="monitor_1">
                <img src="http://artshare.speedgabia.com/pt/pouch/monitor_w.png" width="100%">
            </div>
            <div class="monitor" id="monitor_2">
                <img src="http://artshare.speedgabia.com/pt/pouch/monitor_y.png" width="100%">
            </div>
            <div id="smile">
                <img src="http://artshare.speedgabia.com/pt/pouch/smilewelove.png" width="100%">
            </div>
            <div id="icecream">
                <img src="http://artshare.speedgabia.com/pt/pouch/Icecream.png" width="100%">
            </div>
            <div id="flamingo">
                <img src="http://artshare.speedgabia.com/pt/pouch/dancing_flamingo.png" width="100%">
            </div>
            <div class="mobile" id="icecream_m">
                <img src="http://artshare.speedgabia.com/pt/pouch/Icecream.png" width="100%">
            </div>
            <div class="mobile" id="flamingo_m">
                <img src="http://artshare.speedgabia.com/pt/pouch/dancing_flamingo.png" width="100%">
            </div>
            <div class="logo" id="logo_wiggle">
                <img src="http://artshare.speedgabia.com/pt/wigglewiggle/wigglewiggle/logo_wiggle.png" width="100%">
            </div>
            <div class="insta_m mobile" id="insta_first">
                <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/pt/pouch/insta_w.png" width="100%"></a>
            </div>
        </div>
        <div class="section" id="section2">
            <div class="pouches pc" id="smile_pouch">
                <img src="http://artshare.speedgabia.com/pt/pouch/pouch_smile.png" width="100%">
            </div>
            <div class="pouches pc" id="icecream_pouch">
                <img src="http://artshare.speedgabia.com/pt/pouch/pouch_icecream.png" width="100%">
            </div>
            <div class="pouches" id="flamingo_pouch">
                <img src="http://artshare.speedgabia.com/pt/pouch/pouch_flamingo.png" width="100%">
            </div>
            <div class="pouch_m mobile">
                <img src="http://artshare.speedgabia.com/pt/pouch/pouches.png" width="100%">
            </div>
            <div class="pc" id="description">
                <img src="http://artshare.speedgabia.com/pt/pouch/description.png" width="100%">
            </div>
            <div class="mobile" id="description">
                <img src="http://artshare.speedgabia.com/pt/pouch/description_m.png" width="100%">
            </div>
            <div class="pc" id="price">
                <img src="http://artshare.speedgabia.com/pt/pouch/price.png" width="100%">
            </div>
            <div class="mobile" id="price_m">
                <img src="http://artshare.speedgabia.com/pt/pouch/price_m.png" width="100%">
            </div>
            <div class="title pc" id="title_1">
                <img src="http://artshare.speedgabia.com/pt/pouch/title_1.png" width="100%">
            </div>
            <div class="title pc" id="title_2">
                <img src="http://artshare.speedgabia.com/pt/pouch/title_2.png" width="100%">
            </div>
            <div class="title mobile" id="title_1_m">
                <img src="http://artshare.speedgabia.com/pt/pouch/title_1_m.png" width="100%">
            </div>
            <div class="title mobile" id="title_2_m">
                <img src="http://artshare.speedgabia.com/pt/pouch/title_2_m.png" width="100%">
            </div>
            <div id="sizes">
                <img src="http://artshare.speedgabia.com/pt/pouch/sizes.png" width="100%">
            </div>
            <div class="logo" id="logo_wiggle">
                <img src="http://artshare.speedgabia.com/pt/wigglewiggle/wigglewiggle/logo_wiggle.png" width="100%">
            </div>
        </div>
        <div class="section" id="section3">
            <div class="logo" id="logo_icecream">
                <img src="http://artshare.speedgabia.com/pt/pouch/icecream_logo.png" width="100%">
            </div>
            <div class="pc photo" id="photo_icecream">
                <img src="http://artshare.speedgabia.com/pt/pouch/icecream_photo.jpg" width="100%">
            </div>
            <div class="mobile photo" id="photo_icecream_m">
                <img src="http://artshare.speedgabia.com/pt/pouch/icecream_photo_m.jpg" width="100%">
            </div>
            <div class="pouch" id="pouch_icecream">
                <img src="http://artshare.speedgabia.com/pt/pouch/pouch_icecream.png" width="100%">
            </div>
            <div class="model" id="model_icecream">
                <img src="http://artshare.speedgabia.com/pt/pouch/model_name_1.png" width="100%">
            </div>
            <div class="pc insta" id="insta_icecream_1">
                <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/pt/pouch/insta_w.png" width="100%"></a>
            </div>
            <div class="pc insta_c" id="insta_icecream_2">
                <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/pt/pouch/insta_b.png" width="100%"></a>
            </div>
        </div>
        <div class="section" id="section4">
            <div class="logo" id="logo_flamingo">
                <img src="http://artshare.speedgabia.com/pt/pouch/flamingo_logo.png" width="100%">
            </div>
            <div class="pc photo" id="photo_flamingo">
                <img src="http://artshare.speedgabia.com/pt/pouch/flamingo_photo.jpg" width="100%">
            </div>
            <div class="mobile photo" id="photo_flamingo_m">
                <img src="http://artshare.speedgabia.com/pt/pouch/flamingo_photo_m.jpg" width="100%">
            </div>
            <div class="pouch" id="pouch_flamingo">
                <img src="http://artshare.speedgabia.com/pt/pouch/pouch_flamingo.png" width="100%">
            </div>
            <div class="model" id="model_flamingo">
                <img src="http://artshare.speedgabia.com/pt/pouch/model_name_2.png" width="100%">
            </div>
            <div class="pc insta" id="insta_flamingo_1">
                <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/pt/pouch/insta_w.png" width="100%"></a>
            </div>
            <div class="pc insta_c" id="insta_flamingo_2">
                <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/pt/pouch/insta_p.png" width="100%"></a>
            </div>
        </div>
        <div class="section" id="section5">
            <div class="logo" id="logo_smile">
                <img src="http://artshare.speedgabia.com/pt/wigglewiggle/wigglewiggle/logo_smile.png" width="100%">
            </div>
            <div class="pc photo" id="photo_smile">
                <img src="http://artshare.speedgabia.com/pt/pouch/smile_photo.jpg" width="100%">
            </div>
            <div class="mobile photo" id="photo_smile_m">
                <img src="http://artshare.speedgabia.com/pt/pouch/smile_photo_m.jpg" width="100%">
            </div>
            <div class="pouch" id="pouch_smile">
                <img src="http://artshare.speedgabia.com/pt/pouch/pouch_smile.png" width="100%">
            </div>
            <div class="model" id="model_smile">
                <img src="http://artshare.speedgabia.com/pt/pouch/model_name_3.png" width="100%">
            </div>
            <div class="pc insta" id="insta_smile_1">
                <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/pt/pouch/insta_w.png" width="100%"></a>
            </div>
            <div class="pc insta_c" id="insta_smile_2">
                <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/pt/pouch/insta_y.png" width="100%"></a>
            </div>
        </div>
    </div>

</body>
</html>
