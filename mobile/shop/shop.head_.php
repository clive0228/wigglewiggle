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
	#navi li{
		padding:10px 0 10px 20px;
		border-bottom:1px solid #df9393;
		border-top:1px solid #eb646b;
	}
	#navi li a{
		font-weight: bold;
		color:#fff;
		font-size: 14px;
		
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
	});
	
	function resizeDiv(){
		$("#darkbg").height($(window).height());
		$("#navi").height($(window).height());	
	}
});
</script>
<div id="navi">
	<ul>
		<li><a href='<?php echo G5_URL?>/'>ABOUT US</a></li>
		<li><a href='<?php echo G5_URL?>/shop/list.php?ca_id=10'>PRODUCT</a></li>
		<li><a href='<?php echo G5_URL?>/shop/cart.php'>CART</a></li>
		<li><a href='<?php echo G5_URL?>/shop/wishlist.php'>WISHLIST</a></li>
		<li><a href='<?php echo G5_URL?>/shop/orderinquiry.php'>ORDER</a></li>
		<li><a href='<?php echo G5_URL?>/bbs/board.php?bo_table=qa'>Q&A</a></li>
		<li><a href='<?php echo G5_URL?>/shop/itemuselist.php'>REVIEW</a></li>
		<li><a href='<?php echo G5_URL?>/bbs/board.php?bo_table=notice'>NOTICE</a></li>
	</ul>
</div>
<div id="darkbg">
</div>
<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

    <div id="logo"><a href="<?php echo $default['de_root_index_use'] ? G5_URL : G5_SHOP_URL; ?>/"><img src="<?php echo G5_URL?>/images/logo.png" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>

	<div id="hd_ct"><a href="#"><img src="<?php echo G5_URL?>/images/btnMenu.png" class="MenuOpen"></a></div>
    <ul id="hd_mb">
        <li><a href="<?php echo G5_URL; ?>/">ABOUT</a></li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=10">PRODUCT</a></li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php">CART</a></li>
        <?php if ($is_member) { ?>
        <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">MY PAGE</a></li>
        <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">LOG OUT</a></li>
        <?php } else { ?>
        <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>">SIGN IN</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join">SIGN UP</a></li>
        <?php } ?>
    </ul>

</header>

<div id="container">
    <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>
