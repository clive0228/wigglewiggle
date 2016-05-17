<!DOCTYPE html>
<html>
<head>
    <link href="../css/main.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="../js/vendors/main.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var wid = $(window).width();
            if(wid < 512) {
                $("#menu_logo > a").attr("href", "/shop/main_mobile.php");
            }
            $(window).resize(function() {
                wid = $(window).width();
                if (wid > 512) {
                    $(".mobile").css("display", "none");
                    $(".pc:not(.detail)").css("display", "block");
                } else {
                    $(".pc").css("display", "none");
                    $(".mobile:not(.detail)").css("display", "block");
                }
            });

            $(".btn").mouseover(function(){
                nation = $(this).attr("class");
                nation = nation.split(" ");
                if(wid > 512) {
                    nation = "#" + nation[1] + "_on";
                } else {
                    nation = "#" + nation[1] + "_on_m";
                }
                $(nation).show();
                $(this).hide();
            });
            $(".on").mouseout(function(){
                nation = $(this).attr("class");
                nation = nation.split(" ");
                if (wid > 512) {
                    nation = "#" + nation[1] +"_btn";
                } else {
                    nation = "#" + nation[1] +"_btn_m";
                }
                $(this).hide();
                $(nation).show();
            });
            var detailflag = false;
            $(".on").click(function(e){
                e.preventDefault();
                nation = $(this).attr("class");
                nation = nation.split(" ");
                if (wid > 512) {
                    nation = "#" + nation[1] +"_detail";
                } else {
                    nation = "#" + nation[1] +"_detail_m";
                }

                $(nation).show();
                $("#cover").show();
                detailflag = true;
                return false;
            });
            $(document).click(function(){
                if(detailflag == true){
                    $(".detail").hide();
                    $("#cover").hide();
                    detailflag = false;
                }
            });
        });
    </script>
    <style type="text/css">
        body{ overflow: hidden; background-color: #00B5A1; }
        body > div { position: absolute; }
        .on, .btn{
            width: 20%;
            top: 50%;
            left: 50%;
            cursor: pointer;
        }
        .america{
            margin-left: -40%;
            margin-top: -10%;
        }
        .korea{
            margin-left: -9%;
            margin-top: -10%;
            width: 18%;
        }
        .taiwan{
            margin-left: 20%;
            margin-top: -10%;
        }
        .italy{
            margin-left: -40%;
            margin-top: 5%;
        }
        .spain{
            margin-left: -9%;
            margin-top: 5%;
            width: 18%;
        }
        .thailand{
            margin-left: 20%;
            margin-top: 5%;
        }
        .detail{
            width: 65%;
            top: 50%;
            left: 50%;
            margin-top: -16%;
            margin-left: -32.5%;
            display: none;
            z-index: 999;
        }
        #cover{
            width: 100%;
            height: 100%;
            background-color: #00B5A1;
            opacity: 0.5;
            display: none;
            z-index: 998;
        }
        @media (max-width: 512px) {
            .mobile{ display: block; }
            .pc{ display: none; }
            .on, .btn{
                width: 40%;
                top: 50%;
                left: 50%;
                cursor: pointer;
                margin-bottom: 0;
            }
            .korea {
                margin-left: -42.5%;
                margin-top: -45%;
            }
            .spain {
                margin-left: 2.5%;
                margin-top: -45%;
            }
            .america{
                margin-left: -42.5%;
                margin-top: -10%;
            }
            .italy{
                margin-left: 2.5%;
                margin-top: -10%;
            }
            .taiwan {
                margin-left: -42.5%;
                margin-top: 25%;
            }
            .thailand {
                margin-left: 2.5%;
                margin-top: 25%;
            }
            .detail{
                width: 80%;
                top: 50%;
                left: 50%;
                margin-top: -70%;
                margin-left: -40%;
                display: none;
                z-index: 999;
            }
        }
    </style>
</head>
<body>
    <div id="cover"></div>
    <?php
        include_once("menu.php");
    ?>
    <div id="menu_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/menu_icon.png" width="100%">
    </div>

    <div class="on america pc" id="america_on">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/america_on.png" width="100%">
    </div>
    <div class="btn america pc" id="america_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/america_btn.png" width="100%">
    </div>
    <div class="detail pc" id="america_detail">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/america_detail.png" width="100%">
    </div>

    <div class="on korea pc" id="korea_on">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/korea_on.png" width="100%">
    </div>
    <div class="btn korea pc" id="korea_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/korea_btn.png" width="100%">
    </div>
    <div class="detail pc" id="korea_detail">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/korea_detail.png" width="100%">
    </div>

    <div class="on taiwan pc" id="taiwan_on">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/taiwan_on.png" width="100%">
    </div>
    <div class="btn taiwan pc" id="taiwan_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/taiwan_btn.png" width="100%">
    </div>
    <div class="detail pc" id="taiwan_detail">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/taiwan_detail.png" width="100%">
    </div>

    <div class="on italy pc" id="italy_on">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/italy_on.png" width="100%">
    </div>
    <div class="btn italy pc" id="italy_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/italy_btn.png" width="100%">
    </div>
    <div class="detail pc" id="italy_detail">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/italy_detail.png" width="100%">
    </div>

    <div class="on spain pc" id="spain_on">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/spain_on.png" width="100%">
    </div>
    <div class="btn spain pc" id="spain_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/spain_btn.png" width="100%">
    </div>
    <div class="detail pc" id="spain_detail">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/spain_detail.png" width="100%">
    </div>

    <div class="on thailand pc" id="thailand_on">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/thailand_on.png" width="100%">
    </div>
    <div class="btn thailand pc" id="thailand_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/thailand_btn.png" width="100%">
    </div>
    <div class="detail pc" id="thailand_detail">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/thailand_detail.png" width="100%">
    </div>



    <div class="on america mobile" id="america_on_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/usa_on_m.png" width="100%">
    </div>
    <div class="btn america mobile" id="america_btn_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/usa_m.png" width="100%">
    </div>
    <div class="detail mobile" id="america_detail_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/usa_detail_m.png" width="100%">
    </div>

    <div class="on korea mobile" id="korea_on_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/korea_on_m.png" width="100%">
    </div>
    <div class="btn korea mobile" id="korea_btn_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/korea_m.png" width="100%">
    </div>
    <div class="detail mobile" id="korea_detail_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/korea_detail_m.png" width="100%">
    </div>

    <div class="on taiwan mobile" id="taiwan_on_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/taiwan_on_m.png" width="100%">
    </div>
    <div class="btn taiwan mobile" id="taiwan_btn_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/taiwan_m.png" width="100%">
    </div>
    <div class="detail mobile" id="taiwan_detail_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/taiwan_detail_m.png" width="100%">
    </div>

    <div class="on italy mobile" id="italy_on_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/italy_on_m.png" width="100%">
    </div>
    <div class="btn italy mobile" id="italy_btn_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/italy_m.png" width="100%">
    </div>
    <div class="detail mobile" id="italy_detail_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/italy_detail_m.png" width="100%">
    </div>

    <div class="on spain mobile" id="spain_on_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/spain_on_m.png" width="100%">
    </div>
    <div class="btn spain mobile" id="spain_btn_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/spain_m.png" width="100%">
    </div>
    <div class="detail mobile" id="spain_detail_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/spain_detail_m.png" width="100%">
    </div>

    <div class="on thailand mobile" id="thailand_on_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/thailand_on_m.png" width="100%">
    </div>
    <div class="btn thailand mobile" id="thailand_btn_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/thailand_m.png" width="100%">
    </div>
    <div class="detail mobile" id="thailand_detail_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/thailand_detail_m.png" width="100%">
    </div>
</body>
</html>