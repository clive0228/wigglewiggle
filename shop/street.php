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
            var menuflag = false;
            var wid = $(window).width();
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
                type = $(this).attr("class");
                type = type.split(" ");
                if(wid > 512) {
                    type = "#" + type[1] + "_on";
                } else {
                    type = "#" + type[1] + "_on_m";
                }
                $(type).show();
                $(this).hide();
            });
            $(".on").mouseout(function(){
                type = $(this).attr("class");
                type = type.split(" ");
                if(wid > 512) {
                    type = "#" + type[1] + "_btn";
                } else {
                    type = "#" + type[1] + "_btn_m";
                }
                $(this).hide();
                $(type).show();
            });
        });
    </script>
    <style type="text/css">
        body{
            overflow: hidden;
            background-color: #0F75BC;
        }
        body > div{
            position: absolute;
        }
        .scarf{
            width: 70%;
            top: 50%;
            margin-top: -11%;
            left: 50%;
            margin-left: -35%;
        }
        .case{
            width: 70%;
            left: 50%;
            margin-left: -35%;
            top: 50%;
            margin-top: 4%;
        }

        .on{
            display: none;
        }
        @media (max-width: 512px){
            .scarf{
                width: 70%;
                top: 50%;
                margin-top: -40%;
                left: 50%;
                margin-left: -35%;
            }
        }
    </style>
</head>
<body>
    <?php
        include_once("menu.php");
    ?>

    <div id="menu_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/menu_icon.png" width="100%">
    </div>
    <div class="pc case btn" id="case_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/case_btn.png" width="100%">
    </div>
    <div class="pc case on" id="case_on">
        <a href="/shop/street_sillicone.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/case_on.png" width="100%"></a>
    </div>
    <div class="pc scarf btn" id="scarf_btn">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/scarf_btn.png" width="100%">
    </div>
    <div class="pc scarf on" id="scarf_on">
        <a href="/shop/street_glove.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/scarf_on.png" width="100%"></a>
    </div>
    <div class="mobile scarf on" id="scarf_on_m">
        <a href="/shop/street_glove.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/scarf_on_m.png" width="100%"></a>
    </div>
    <div class="mobile scarf btn" id="scarf_btn_m">
        <a href="/shop/street_glove.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/scarf_btn_m.png" width="100%"></a>
    </div>
    <div class="mobile case on" id="case_on_m">
        <a href="/shop/street_sillicone.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/case_on_m.png" width="100%"></a>
    </div>
    <div class="mobile case btn" id="case_btn_m">
        <a href="/shop/street_sillicone.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/case_btn_m.png" width="100%"></a>
    </div>
</body>
</html>