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
    <script type="text/javascript" src="../vendors/js/main.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $(".cover").css("display", "none");
        });
        $(document).ready(function(){
            var product_id = "http://wiggle-wiggle.com/shop/item.php?it_id=";

            $("#product1").click(function(){
                $("#buynow1").css("display", "block");
            });
            $("#product2").click(function(){
                $("#buynow2").css("display", "block");
            });

            $('#fullpage').fullpage({
                anchors: ['slide1', 'slide2', 'slide3', 'slide4', 'slide5',
                    'slide6', 'slide7', 'slide8', 'slide9', 'slide10',
                    'slide11', 'slide12', 'slide13', 'slide14', 'slide15',],
                sectionsColor: [],
                easing: 'easeOutQuad',

                onLeave: function(index, nextIndex, direction) {
                    $("#buynow1, #buynow2").css("display", "none");
                },

                afterRender: function() {

                },

                afterLoad: function(anchorLink, index) {
                    if(index==1){
                        $("#product1").css({"margin-top": "-2%", "margin-left": "-2%", "width": "10%", "height":"20%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "0%", "margin-left": "7%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447834321");
                    } else if(index==2){
                        $("#product1").css({"margin-top": "-1%", "margin-left": "-30%", "width": "15%", "height":"32%"});
                        $("#product2").css({"display":"block", "margin-top": "-6%", "margin-left": "17%", "width": "17%", "height":"35%"});
                        $("#buynow1").css({"margin-top": "3%", "margin-left": "-22%"});
                        $("#buynow2").css({"margin-top": "-2%", "margin-left": "25%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1415936020");
                        $("#buynow2").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1415936020");
                    } else if(index==3){
                        $("#product1").css({"margin-top": "-13%", "margin-left": "-17%", "width": "17%", "height":"46%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-4%", "margin-left": "-3%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1415936020");
                    } else if((index==4) || (index==5)) {
                        $("#product1").css({"margin-top": "-8%", "margin-left": "-5%", "width": "17%", "height":"35%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-3%", "margin-left": "5%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447834422");
                    } else if(index==6) {
                        $("#product1").css({"margin-top": "-13%", "margin-left": "-25%", "width": "10%", "height":"20%"});
                        $("#product2").css({"display":"block", "margin-top": "8%", "margin-left": "6%", "width": "10%", "height":"20%"});
                        $("#buynow1").css({"margin-top": "-10%", "margin-left": "-18%"});
                        $("#buynow2").css({"margin-top": "9%", "margin-left": "14%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447833213");
                        $("#buynow2").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447833141");
                    } else if(index==7) {
                        $("#product1").css({"margin-top": "3%", "margin-left": "0", "width": "17%", "height":"44%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "5%", "margin-left": "16%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447834858");
                    } else if(index==8) {
                        $("#product1").css({"margin-top": "-8%", "margin-left": "-1%", "width": "9%", "height":"44%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "0%", "margin-left": "6%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447834920");
                    } else if(index==9) {
                        $("#product1").css({"margin-top": "9%", "margin-left": "-19%", "width": "18%", "height":"29%"});
                        $("#product2").css({"display":"block", "margin-top": "6%", "margin-left": "11%", "width": "10%", "height":"32%"});
                        $("#buynow1").css({"margin-top": "10%", "margin-left": "-5%"});
                        $("#buynow2").css({"margin-top": "11%", "margin-left": "19%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447833213");
                        $("#buynow2").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447833141");
                    } else if(index==10){
                        $("#product1").css({"margin-top": "-12%", "margin-left": "-25%", "width": "10%", "height":"40%"});
                        $("#product2").css({"display":"block", "margin-top": "-11%", "margin-left": "24%", "width": "10%", "height":"31%"});
                        $("#buynow1").css({"margin-top": "-5%", "margin-left": "-17%"});
                        $("#buynow2").css({"margin-top": "-9%", "margin-left": "32%"});
                        $(".buynow").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447835042");
                    } else if(index==11){
                        $("#product1").css({"margin-top": "-5%", "margin-left": "-20%", "width": "10%", "height":"40%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-2%", "margin-left": "-10%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447834858");
                    } else if(index==12){
                        $("#product1").css({"margin-top": "-12%", "margin-left": "-25%", "width": "10%", "height":"40%"});
                        $("#product2").css({"display":"block", "margin-top": "-11%", "margin-left": "24%", "width": "10%", "height":"31%"});
                        $("#buynow1").css({"margin-top": "-5%", "margin-left": "-17%"});
                        $("#buynow2").css({"margin-top": "-9%", "margin-left": "32%"});
                        $(".buynow").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447834800");
                    } else if(index==13) {
                        $("#product1").css({"margin-top": "-13%", "margin-left": "-7%", "width": "12%", "height":"20%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "-10%", "margin-left": "3%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989130");
                    } else if(index==14) {
                        $("#product1").css({"margin-top": "-15%", "margin-left": "-29%", "width": "10%", "height":"20%"});
                        $("#product2").css({"display":"block", "margin-top": "-7%", "margin-left": "12%", "width": "10%", "height":"20%"});
                        $("#buynow1").css({"margin-top": "-12%", "margin-left": "-22%"});
                        $("#buynow2").css({"margin-top": "-6%", "margin-left": "19%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447988907");
                        $("#buynow2").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447988634");
                     }else if(index==15){
                        $("#product1").css({"margin-top": "3%", "margin-left": "-3%", "width": "10%", "height":"32%"});
                        $("#product2").css({"display":"none"});
                        $("#buynow1").css({"margin-top": "6%", "margin-left": "5%"});
                        $("#buynow1").find("a").attr("href", "http://wiggle-wiggle.com/shop/item.php?it_id=1447989096");
                    }

                    if((index == 6) || (index==5) || (index==9)){
                        $("#fashion").css("display", "block");
                        $("#fashion").find("img").attr("src", "http://artshare.speedgabia.com/wiggle_new_web/seoul.png")
                    } else if(index==12) {
                        $("#fashion").find("img").attr("src", "http://artshare.speedgabia.com/wiggle_new_web/paris.png")
                        $("#fashion").css("display", "block");
                    } else if(index > 12){
                        $("#fashion").css("display", "none");
                    } else{
                        $("#fashion").css("display", "block");
                        $("#fashion").find("img").attr("src", "http://artshare.speedgabia.com/wiggle_new_web/london.png")
                    }
                }
            });
        });
    </script>
    <style type="text/css">
        body{
            overflow: hidden;
        }
        #menu_btn{
            z-index: 990;
        }
        .section{
            background-color: #1A75BB;
        }
        #fashion{
            z-index: 990;
            position: absolute;
            right: 1%;
            bottom: 1%;
            width: 14%;
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
    <div id="fashion">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/london.png" width="100%"/>
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
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-02.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section2">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-03.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section3">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-04.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section4">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-05.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section5">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-06.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section6">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-07.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section7">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-08.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section8">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-09.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section9">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-10.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section10">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-11.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section11">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-12.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section12">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-13.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section13">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-14.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section14">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-15.jpg" width="100%"/>
            </div>
        </div>
        <div class="section" id="section15">
            <div class="photo">
                <img src="http://artshare.speedgabia.com/wiggle_new_web/glove-16.jpg" width="100%"/>
            </div>
        </div>
    </div>
</body>
</html>
