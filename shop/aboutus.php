<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href='../css/main.css' rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../js/vendors/main.js"type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var heartflag = false;
            var wid = $(window).width();
            if(wid < 512) {
                $("#menu_logo > a").attr("href", "/shop/main_mobile.php");
            }

            $(window).resize(function(){
                wid = $(window).width();
            });
            var heartbeat = function(){
                hearttimer = setInterval(function pulse(back) {
                   width = $("#heart").width();
                   if(heartflag == false) {
                        if(wid > 512) {
                            $("#heart").animate({"width": "12%", "margin-left": "-6%"}, 600);
                        } else {
                            $("#heart").animate({"width": "30%", "margin-left": "-15%"}, 600);
                        }
                        heartflag = true;
                    } else {
                        if(wid > 512) {
                            $("#heart").animate({"width": "10%", "margin-left": "-5%"}, 600);
                        } else {
                            $("#heart").animate({"width": "32%", "margin-left": "-16%"}, 600);
                        }
                        heartflag = false;
                    }
                }, 600);
            }
            heartbeat();
        });
    </script>

    <style type="text/css">
        body {
            overflow: hidden;
            background-color: #F8DA08;
            position: absolute;
            border: 5px solid #000;
            top: 0;
            bottom: 0;
            left: 0;
            width: 93%;
        }
        body > div { position: absolute; }
        .container > div{ position: absolute;}
        .container{
            background-color: transparent;
            width: 100%;
            height: 100%;
        }
        #heart {
            top: 6%;
            left: 50%;
            width: 12%;
            margin-left: -6%;
        }
        #text {
            top: 32%;
            left: 50%;
            width: 70%;
            margin-left: -35%;
        }
        #text_m{
            width: 80%;
            top: 50%;
            left: 50%;
            margin-top: -35%;
            margin-left: -40%;
        }
        @media (max-width: 512px){
            .pc{ display: none; }
            .mobile{ display: block; }
            #heart{
                top: 50%;
                margin-top: -70%;
                width: 30%;
                margin-left: -15%;
                left: 50%;
            }
        }
    </style>
</head>
<body>
    <?php
        include_once("menu.php");
    ?>
    <div class="container">
        <div id="menu_btn">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/menu_icon.png" width="100%">
        </div>
        <div id="heart">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/aboutus.png" width="100%">
        </div>
        <div class="pc" id="text">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/aboutus_text.png" width="100%">
        </div>
        <div class="mobile" id="text_m">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/text_m.png" width="100%">
        </div>
    </div>
</body>
</html>