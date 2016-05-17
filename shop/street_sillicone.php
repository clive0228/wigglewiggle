<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/pt/css/jquery.fullPage.css"/>
    <link href="../css/main.css" type="text/css" rel="stylesheet"/>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="/pt/js/jquery.fullPage.min.js"></script>
    <script type="text/javascript" src="../js/vendors/main.js"></script>

    <script type="text/javascript">
        $(window).load(function(){
            $(".cover").css("display", "none");
        });
        $(document).ready(function(){
            $("#product1").click(function(){
                $("#buynow1").css("display", "block");
            });
            $("#product2").click(function(){
                $("#buynow2").css("display", "block");
            });
            $('#fullpage').fullpage({
                anchors: ['slide1', 'slide2', 'slide3', 'slide4', 'slide5',
                    'slide6', 'slide7', 'slide8', 'slide9', 'slide10',
                    'slide11'],
                // sectionsColor: ['#F9B127','#F9B127','#01B1BE','#F48335','#F9B127'],
                easing: 'easeOutQuad',

                onLeave: function(index, nextIndex, direction) {
                    $("#buynow1, #buynow2").css("display", "none");
                },

                afterRender: function() {

                },

                afterLoad: function(anchorLink, index) {
                    if(index==1){
                        $("#product1").css({"margin-top": "-9%", "margin-left": "-32%", "width": "15%", "height":"24%"});
                        $("#product2").css({"display":"block", "margin-top": "-18%", "margin-left": "14%", "width": "9%", "height":"35%"});
                        $("#buynow1").css({"margin-top": "-4%", "margin-left": "-19%"});
                        $("#buynow2").css({"margin-top": "-6%", "margin-left": "23%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989417");
                        $("#buynow2").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989417");
                    } else if(index==2){
                        $("#product1").css({"margin-top": "-15%", "margin-left": "-21%", "width": "12%", "height":"54%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-4%", "margin-left": "-9%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989956");
                    } else if(index==3){
                        $("#product1").css({"margin-top": "-10%", "margin-left": "-15%", "width": "8%", "height":"30%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-4%", "margin-left": "-7%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989956");
                    } else if(index==4){
                        $("#product1").css({"margin-top": "11%", "margin-left": "0", "width": "8%", "height":"26%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "14%", "margin-left": "7%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447990024");
                    } else if(index==5){
                        $("#product1").css({"margin-top": "-3%", "margin-left": "-22%", "width": "17%", "height":"26%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "3%", "margin-left": "-6%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989956");
                    } else if(index==6){
                        $("#product1").css({"margin-top": "-9%", "margin-left": "-21%", "width": "9%", "height":"31%"});
                        $("#product2").css({"display":"block", "margin-top": "5%", "margin-left": "30%", "width": "6%", "height":"25%"});
                        $("#buynow1").css({"margin-top": "-5%", "margin-left": "-13%"});
                        $("#buynow2").css({"margin-top": "7%", "margin-left": "36%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989417");
                        $("#buynow2").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989417");
                    } else if(index==7){
                        $("#product1").css({"margin-top": "-6%", "margin-left": "5%", "width": "11%", "height":"31%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "0%", "margin-left": "15%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989956");
                    } else if(index==8){
                        $("#product1").css({"margin-top": "-16%", "margin-left": "-6%", "width": "11%", "height":"31%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-11%", "margin-left": "6%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447990024");
                    } else if(index==9){
                        $("#product1").css({"margin-top": "-16%", "margin-left": "-6%", "width": "6%", "height":"31%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-11%", "margin-left": "1%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989417");
                    } else if(index==10){
                        $("#product1").css({"margin-top": "-16%", "margin-left": "-6%", "width": "14%", "height":"31%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-7%", "margin-left": "5%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989956");
                    } else if(index==11){
                        $("#product1").css({"margin-top": "1%", "margin-left": "-14%", "width": "15%", "height":"31%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "7%", "margin-left": "1%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447990024");
                    }
                }
            });
        });
    </script>
    <style type="text/css">
        .section{
            background-color: #1A75BB;
        }
        #buynow1{
            position: absolute;
            z-index: 993;
            display: none;
            top: 50%;
            left: 50%;
            margin-top: 0;
            margin-left: 7%;
            width: 12%;
        }
        #product1{
            position: absolute;
            z-index: 992;
            background-color: transparent;
            /*background-color: #fff;*/
            top: 50%;
            left: 50%;
            margin-top: -2%;
            margin-left: -2%;
            width: 10%;
            height: 20%;
            cursor: pointer;
        }
        #buynow2{
            position: absolute;
            z-index: 993;
            display: none;
            top: 50%;
            left: 50%;
            margin-top: 0;
            margin-left: 7%;
            width: 12%;
        }
        #product2{
            position: absolute;
            z-index: 992;
            background-color: transparent;
            /*background-color: #fff;*/
            top: 50%;
            left: 50%;
            margin-top: -2%;
            margin-left: -2%;
            width: 10%;
            height: 20%;
            cursor: pointer;
        }
        #menu_btn{
            z-index: 990;
        }
        .section{
            overflow: hidden;
        }
        .section div {
            position: absolute;
        }
        .photo{
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }
        #loading {
            z-index: 1000;
            width: 100%;
            height: 100%;
            float: left;
            background-color: #0F75BC;
        }
        #heart_loading{
            position: absolute;
            width: 16%;
            top: 50%;
            left: 50%;
            margin-top: -7%;
            margin-left: -8%;
            z-index: 999;
        }
        .cover{
            background-color: #1A75BB;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            right: 0;
            z-index: 998;
        }
    </style>
</head>
<body>
    <div id="menu_btn">
        <a href="/shop/street.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/back.png" width="100%"></a>
    </div>
    <div class="buynow" id="buynow1">
        <a href=""><img src="http://artshare.speedgabia.com/wiggle_new_web/buynow.png" width="100%"/></a>
    </div>
    <div class="product" id="product1">

    </div>
    <div class="buynow" id="buynow2">
        <a href=""><img src="http://artshare.speedgabia.com/wiggle_new_web/buynow.png" width="100%"/></a>
    </div>
    <div class="product" id="product2">

    </div>
    <div class="cover">

    </div>

    <div id="fullpage">
        <div class="section" id="section1">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-02.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section2">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-03.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section3">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-04.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section4">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-05.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section5">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-06.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section6">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-07.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section7">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-08.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section8">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-09.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section9">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-10.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section10">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-11.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section11">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/sillicone-12.jpg" width="100%"/>
            </div>
        </div>
    </div>
</body>
</html>
