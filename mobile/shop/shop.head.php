<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
?>
<style type="text/css">
	#ft .infor{
		float: left;
	}
	#ft .infor .btns ul{
		padding: 0;
		margin: 0;
		height: 21px;
	}
	#ft .infor .btns li{
		list-style: none;
		float: left;
		padding-right:10px;
	}
	#ft .infor .copyright{
		width:100%;
		overflow-x: hidden;
		padding-top:20px;
	}
	#ft .top{
		position: absolute;
		left:100%;
		margin-left:-55px;
	}
	.cls{
		clear:both;
	}
	#navi {
		width: 200px;
		position: fixed;
		height: 200%;
		background-color: #ee2d38;
		top:0;
		left:-300px;
		z-index:99999;
	}
	#darkbg {
		display: none;
		width:100%;
		position: fixed;
		height: 200%;
		background-color: #000;
		z-index:99998;
		filter: alpha(opacity=70,FinishOpacity=0,Style=0);
		-moz-opacity: 0.70;
		opacity: 0.70;
	}
	#navi ul {
		padding-top:10px;
	}
	#navi li{
		width: 100%;
	}
	#navi li a{
		display: inline-block;
		width:180px;
		padding:5px 0 5px 20px;
		color:#fff;
		font-size: 14px;
		
	}
	#navi .line{
		padding: 0 0 15px 20px!important;
	}
	#hd_mb{
		background-color: #ee2d38;
	}
	#hd_mb a{
		color:#fff!important;;
	}
	#hd_mb_hidden{
		width: 100%;
		height:37px;
		display: none;
	}
	.btnUpdate{
		margin-bottom: 30px;
	}
	@media screen and (max-width:519px){
		#ma_con {
			width: 300px;
		}
		#ma_con .item {
			width: 298px;
			margin:0 0 20px 0;
			padding: 0;
		}
		#ma_con .item .imgs {
			width: 298px;
			height: 298px;
		}
		#ma_con .item .imgs img {
			width: 298px;
			height: 298px;
		}
	}
	@media screen and (min-width:520px){
		#ma_con {
			width: 500px;
		}
	}
	@media screen and (min-width:770px){
		#ma_con {
			width: 750px;
		}
	}
	@media screen and (min-width:1020px){
		#ma_con {
			width: 1000px;
		}
	}
</style>

<script type="text/javascript">
$(function() {	
    $( ".MenuOpen" ).click(function() {
        $( "#navi" ).animate({
          left: 0
        }, 300 );
        $("#darkbg").css("display","block");
    });
    $( "#darkbg" ).click(function() {
        $( "#navi" ).animate({
          left: -300
        }, 300 );
        $("#darkbg").css("display","none");
    });
    $( "#top" ).click(function() {
        $( "html,body" ).animate({
          scrollTop: 0
        }, 300 );
    });
    
	$(window).resize(function() {
		resizeDiv();
	});
	$(document).ready(function(){	
		resizeDiv();
	});
	$(window).scroll(function () {
		resizeDiv();
		if($(window).scrollTop() > 81){
			$("#hd_mb").css("position","fixed");
			$("#hd_mb").css("width","100%");
			$("#hd_mb").css("top","0");
			$("#hd_mb_hidden").css("display","block");
		}else{
			$("#hd_mb").css("position","relative");
			$("#hd_mb_hidden").css("display","none");
		}
		
	});
	
	function resizeDiv(){
		$("#darkbg").height($(document).height());
		$("#navi").height($(document).height());	
	}
});
</script>
<div id="navi">
	<ul>
        <li><a href="<?php echo G5_URL; ?>/insta">#위글위글 구경하기&gt;</a></li>
        <li class="line"><div style="width:30px;height:2px;background-color:#fff"></div></li>
        <?php if ($is_member) { ?>
        <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">MY PAGE</a></li>
        <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">LOG OUT</a></li>
        <?php } else { ?>
        <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>">SIGN IN</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join">SIGN UP</a></li>
        <?php } ?>
        <li class="line"><div style="width:30px;height:2px;background-color:#fff"></div></li>
		<li><a href='<?php echo G5_URL?>/shop/aboutus.php'>ABOUT US</a></li>
		<li><a href='<?php echo G5_URL?>/shop/list.php?ca_id=10'>PRODUCT</a></li>
        <li class="line"><div style="width:30px;height:2px;background-color:#fff"></div></li>
		<li><a href='<?php echo G5_URL?>/shop/cart.php'>CART</a></li>
		<li><a href='<?php echo G5_URL?>/shop/wishlist.php'>WISHLIST</a></li>
		<li><a href='<?php echo G5_URL?>/shop/orderinquiry.php'>ORDER</a></li>
        <li class="line"><div style="width:30px;height:2px;background-color:#fff"></div></li>
		<li><a href='<?php echo G5_URL?>/bbs/board.php?bo_table=qa'>Q&A</a></li>
		<li><a href='<?php echo G5_URL?>/shop/itemuselist.php'>REVIEW</a></li>
		<li><a href='<?php echo G5_URL?>/bbs/board.php?bo_table=notice'>NOTICE</a></li>
	</ul>
</div>
<div id="darkbg">
</div>
<header id="hd">
    <div id="logo"><a href="<?php echo $default['de_root_index_use'] ? G5_URL : G5_SHOP_URL; ?>/shop/main_mobile.php"><img src="<?php echo G5_URL?>/images/logo.png" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>

    <ul id="hd_mb">
	    <li class="first"><img src="<?php echo G5_URL?>/images/menuOpen.png" class="MenuOpen" style="cursor: pointer"></li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=10">PRODUCT</a></li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php">CART</a></li>
		<li><a href='<?php echo G5_URL?>/bbs/board.php?bo_table=qa'>Q&A</a></li>
        <?php if ($is_member) { ?>
        <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">MY PAGE</a></li>
        <?php } else { ?>
        <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>">SIGN IN</a></li>
        <?php } ?>
    </ul>
    <div id="hd_mb_hidden"></ul>

</header>

<div id="container">
    <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>
