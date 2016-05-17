<?php
if($_SESSION["pt_view_today"] != "view") {
    set_session("pt_view_today","view");
    goto_url("/pt");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="../js/vendors/main.js"></script>

    <script type="text/javascript">
        var wid = $(window).width();
        $(window).load(function(){
            var statue = false;
            var head = false;
            $(".statue").ready(function(){
                statue = true;
                if(wid > 512) {
                    if(statue && head) {
                        $("#statue2").show();
                        $("#statue_head2").show();
                    }
                } else {
                    if(statue && head) {
                        $("#statue_head2").show();
                        $("#statue2_m").show();
                    }
                }
            });
            $(".heads").ready(function(){
                head = true;
                if(wid > 512) {
                    if(statue && head) {
                        $("#statue2").show();
                        $("#statue_head2").show();
                    }
                } else {
                    if(statue && head) {
                        $("#statue_head2").show();
                        $("#statue2_m").show();
                    }
                }
            });
        });
        // $(".statue").bind("load", function(){
        //         statue = true;
        //         if(wid > 512) {
        //             if(statue && head) {
        //                 $("#statue2").show();
        //                 $("#statue_head2").show();
        //             }
        //         } else {
        //             if(statue && head) {
        //                 $("#statue2_m").show();
        //                 $("#statue_head2").show();
        //             } else {
        //                 $("#statue2_m").hide();
        //                 $("#statue_head2").hide();
        //             }
        //         }
        //     });
        //     $(".heads").bind("load", function(){
        //         head = true;
        //         if(wid > 512) {
        //             if(statue && head) {
        //                 $("#statue2").show();
        //                 $("#statue_head2").show();
        //             }
        //         } else {
        //             if(statue && head) {
        //                 $("#statue2_m").show();
        //                 $("#statue_head2").show();
        //             } else {
        //                 $("#statue2_m").hide();
        //                 $("#statue_head2").hide();
        //             }
        //         }
        //     });
        $(document).ready(function(){
            var hello = function() {
                if(wid > 512){
                    $("#hello_r").find("img").attr("src", "http://artshare.speedgabia.com/wiggle_new_web/hello_red.png");
                    $("#hello_y").find("img").attr("src", "http://artshare.speedgabia.com/wiggle_new_web/hello_yellow.png");
                } else {
                    $("#hello_r").find("img").attr("src", "http://artshare.speedgabia.com/wiggle_new_web/hello_red_m.png");
                    $("#hello_y").find("img").attr("src", "http://artshare.speedgabia.com/wiggle_new_web/hello_yellow_m.png");
                }
            }
            hello();
            $(window).resize(function(){
                wid = $(window).width();
                hello();
                if(wid > 512) {
                    $(".mobile").css("display", "none");
                } else {
                    $(".pc").css("display", "none");
                }
            });
            $("#hello_y").mouseover(function(){
                $("#hello_r").show();
                $(this).hide();
            });
            $("#hello_r").mouseout(function(){
                $("#hello_y").show();
                $(this).hide();
            });
            var step = 1;
            setInterval(function() {
                var id1 = "#statue1";
                var id2 = "#statue2";
                var id3 = "#statue3";

                if(wid <= 512) {
                    id1 += "_m";
                    id2 += "_m";
                    id3 += "_m";
                }

                if(step==1) {
                    $(id1).hide();
                    $(id2).show();
                    step += 1;
                } else if(step==2) {
                    $(id2).hide();
                    $(id3).show();
                    step += 1;
                } else if(step==3) {
                    $(id3).hide();
                    $(id2).show();
                    step += 1;
                } else {
                    $(id2).hide();
                    $(id1).show();
                    step = 1;
                }
            },600);
            var eyeflag = false;
            setInterval(function(){
                if(eyeflag==false) {
                   $("#statue_head1").css("display","none");
                   $("#statue_head2").css("display","block");
                   eyeflag=true;
                } else {
                   $("#statue_head1").css("display","block");
                   $("#statue_head2").css("display","none");
                   eyeflag=false;
                }
            }, 1000);
        });
    </script>

    <style type="text/css">
        body{
            overflow: hidden;
            background-color: #0F75BC;
        }

        .hello{
            position: absolute;
            top: 50%;
            margin-top: -15%;
            left: 9%;
            width: 45%;
        }
        #hello_r{
            display: none;
        }
        .statue{
            position: absolute;
            z-index: 10;
            width: 33%;
            top: 50%;
            left: 50%;
            margin-top: -21.2%;
            margin-left: 6.2%;
            display: none;
        }
        /*#statue2, #statue3, #statue2_m, #statue3_m { display: none; }*/
        #logo{
            position: absolute;
            bottom: 1%;
            left: 1%;
            width: 13%;
        }
        .heads{
            position: absolute;
            width: 16.5%;
            left: 50%;
            top: 50%;
            margin-left: 15.9%;
            margin-top: -12.7%;
            display: none;
        }
        #loading{
            position: absolute;
        }

        @media (max-width: 512px){
            .statue{
                left: 50%;
                top: 50%;
                width: 60%;
                margin-left: -48.5%;
                margin-top: -21.5%;
            }
            #logo{
                bottom: 3%;
                left: 50%;
                width: 33%;
                margin-left: 10%;
            }
            .hello{
                margin-top: -50%;
                left: 50%;
                width: 60%;
                margin-left: -15%;
            }
            .heads{
                position: absolute;
                width: 29%;
                left: 50%;
                top: 50%;
                margin-left: -30.5%;
                margin-top: -5%;
                display: none;
            }
        }
    </style>

</head>
<body>
    <div class="hello" id="hello_y">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/hello_yellow.png" width="100%"/>
    </div>
    <div class="hello" id="hello_r">
        <a href="/shop/main.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/hello_red.png" width="100%"/></a>
    </div>
    <div id="logo">
        <a href="/shop/main.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/intro_logo.png" width="100%"/></a>
    </div>
    <div class="pc statue" id="statue1">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/statue_body1.png" width="100%"/>
    </div>
    <div class="pc statue" id="statue2">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/statue_body2.png" width="100%"/>
    </div>
    <div class="pc statue" id="statue3">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/statue_body3.png" width="100%"/>
    </div>
    <div class="heads" id="statue_head1">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/statue_head1.png" width="100%"/>
    </div>
    <div class="heads" id="statue_head2">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/statue_head2.png" width="100%"/>
    </div>
    <div class="mobile statue" id="statue1_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/statue1_m.png" width="100%"/>
    </div>
    <div class="mobile statue" id="statue2_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/statue2_m.png" width="100%"/>
    </div>
    <div class="mobile statue" id="statue3_m">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/statue3_m.png" width="100%"/>
    </div>
    <div id="loading">
        <div id="heart_loading">
            <img src="http://artshare.speedgabia.com/wiggle_new_web/heart_loading.png" width="100%">
        </div>
    </div>
</body>
</html>
