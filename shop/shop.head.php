<?php
if (!defined("_GNUBOARD_")) exit; // Í∞úÎ≥Ñ ?òÏù¥ÏßÄ ?ëÍ∑º Î∂àÍ?

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
?>

<script src="<?php echo G5_URL; ?>/js/gnb.js"></script>
<style type="text/css">
	.noto {font-family: 'Noto Sans', sans-serif;}	
	.nanum {font-family: 'Nanum Gothic', 'Dotum';}
	.bold {font-weight: bold}
	.red {color:#ec2e38}
	
	#redLine{
		z-index: 99999;
		opacity: 0;
		position: fixed;
		top:93px;
		width:100%;
		height:1px;
		background-color:#ec2e38;
	}
	#redLineSub{
		position: fixed;
		z-index: 99999;
		top:93px;
		width:100%;
		height:1px;
		background-color:#ec2e38;
	}
	#contentWrapper{
		width: 100%;
		margin-top:150px;
		position: relative;
	}
	#contentWrapper .contents{
		width: 1000px;
		position: relative;
        margin-top: 150px;
        margin: 0 auto;
	}
	#footerContainer{
		width:100%;
		height:180px;
		background-color:#ec2e38;
		top:-180px;
		position: absolute;
	}
	#footerContainer .footer{
		width: 874px;
		position: relative;
		margin: 0 auto;
		padding-top:50px;
	}
	#footerContainer .footer .infor{
		float: left;
	}
	#footerContainer .footer .infor .btns ul{
		padding: 0;
		margin: 0;
		height: 21px;
	}
	#footerContainer .footer .infor .btns li{
		list-style: none;
		float: left;
		padding-right:10px;
	}
	#footerContainer .footer .infor .copyright{
		padding-top:20px;
	}
	#footerContainer .footer .top{
		float: right;
	}
	.pad35{
		margin-left:35px;
	}
	.cls{
		clear:both;
	}
	.patterns{
		padding-bottom: 20px;
		border-bottom: 1px solid #ddd;
		margin-bottom: 20px;
	}
	.patterns ul li{
		list-style: none;
		float: left;
		margin-right:4px;
	}
	.patterns .last{
		margin: 0;
	}
	.opa03{
		opacity: 0.2;
		filter:alpha(opacity=20,FinishOpacity=0,Style=0);
		-moz-opacity:0.20;
	}
</style>
<script type="text/javascript">

$(function() {	
	/*
		$('.patterns > .cls > ul > li').hover( //?úÎ∏åÎ©îÎâ¥Í∞Ä ?ÑÏöî???ûÏùò 3Í∞??ÄÎ©îÎâ¥.
			function(){
				var id = $(this).attr("id");
				$("#bigImage").attr("src","<?php echo G5_URL; ?>/pimg/" + id + ".jpg");			
			},
			function(){
			
			}
		);
	*/
	
    $( "#top" ).click(function() {
        $( "html,body" ).animate({
          scrollTop: 0
        }, 300 );
    });

});
</script>

<div class="darkWrap"></div>
<div id="redLine"></div>

<?php if(!$isIndex){ ?>
<style type="text/css">
	#footerContainer{
		top:0;
		margin-top:100px;
		position: relative;
	}	
	.base_bg{
		opacity: 1!important;
	}
</style>

<div id="redLineSub"></div>
<?php } ?>

<?php 
	if(defined('_INDEX_') && !G5_IS_MOBILE) { // index에서만 실행
		include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
	} 
?><style type="text/css">
/* 팝업레이어 */
#hd_pop {z-index:999999;position:absolute;left: 20px;top:20px}
#hd_pop h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
.hd_pops {position:absolute;border:1px solid #e9e9e9;background:#fff}
.hd_pops_con {}
.hd_pops_footer {padding:10px 0;background:#000;color:#fff;text-align:right}
.hd_pops_footer button {margin-right:5px;padding:5px 10px;border:0;background:#393939;color:#fff}
</style>

<div class="cm_head">
	<div class="cm_pivot">
		<div class="logo"><a href="/shop/main.php"><img src="<?php echo G5_URL; ?>/images/logo.png" border="0"></a></div>
		<ul class="social">
			<li><a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="<?php echo G5_URL; ?>/images/btn_insta.png" border="0" width="17" height="16" border="0"></a></li>
		</ul>
	</div>
</div>

<div id="headGnb" class="gnb">
	<div class="dp_wrap">
		<ul class="topBtns">
			<?php if($is_admin) { ?><li><a href="<?php echo G5_URL; ?>/adm" target="_blank">ADMIN</a></li><?php } ?>
			<?php if(!$is_member) { ?>
				<li><a href="<?php echo G5_URL; ?>/bbs/login.php">LOGIN</a></li>
				<li><a href="<?php echo G5_URL; ?>/bbs/register_form.php">JOIN</a></li>
			<?php }else{ ?>
				<li><a href="<?php echo G5_URL; ?>/bbs/logout.php">LOGOUT</a></li>		
				<li><a href="<?php echo G5_URL; ?>/shop/mypage.php">MY PAGE</a></li>	
			<?php } ?>
			<li><a href="<?php echo G5_URL; ?>/shop/cart.php">CART</a></li>
			<li><a href="<?php echo G5_URL; ?>/shop/wishlist.php">WISHLIST</a></li>
			<li><a href="<?php echo G5_URL; ?>/shop/orderinquiry.php">ORDER</a></li>
			<li><a href="<?php echo G5_URL; ?>/bbs/board.php?bo_table=qa">Q&A</a></li>
			<li><a href="<?php echo G5_URL; ?>/shop/itemuselist.php">REVIEW</a></li>
			<li><a href="<?php echo G5_URL; ?>/bbs/board.php?bo_table=notice">NOTICE</a></li>
		</ul>
		<div class="cls"></div>
		<ul class="dp1_list">
			<li class="dp1 about noto bold red"><a href="<?php echo G5_URL; ?>/shop/aboutus.php">ABOUT US</a></li>
			<li class="dp1 product noto bold red"><a href="<?php echo G5_URL; ?>/shop/list.php?ca_id=10">PRODUCTS</a>
				<div class="dp2_wrap">
					<div class="dp2_list">
						<div class="bigImage">
							<img src="<?php echo G5_URL; ?>/pimg/1.jpg" width="100%" height="100%" border="0" id="bigImage">
						</div>
						<div class="patterns">
							<div class='cls'>
								
							<ul>
								<li id="1415897967" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897967"><img src="<?php echo G5_URL; ?>/images/pattern_01.png" width="85" height="81" border="0"></a></li>
								<li id="1415897864" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897864"><img src="<?php echo G5_URL; ?>/images/pattern_02.png" width="85" height="81" border="0"></a></li>
								<li id="1415897970" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897970"><img src="<?php echo G5_URL; ?>/images/pattern_03.png" width="85" height="81" border="0"></a></li>
								<li id="1415897977" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897977"><img src="<?php echo G5_URL; ?>/images/pattern_04.png" width="85" height="81" border="0"></a></li>
								<li id="1415897979" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897979"><img src="<?php echo G5_URL; ?>/images/pattern_05.png" width="85" height="81" border="0"></a></li>
								<li id="1415897981" class="last top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897981"><img src="<?php echo G5_URL; ?>/images/pattern_06.png" width="85" height="81" border="0"></a></li>
								<li id="1415897972" class="cls"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897972"><img src="<?php echo G5_URL; ?>/images/pattern_07.png" width="85" height="83" border="0"></a></li>
								<li id="1415897974"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897974"><img src="<?php echo G5_URL; ?>/images/pattern_08.png" width="85" height="83" border="0"></a></li>
								<li id="1415936023"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415936023"><img src="<?php echo G5_URL; ?>/images/pattern_09.png" width="85" height="83" border="0"></a></li>
								<li id="1415936020"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415936020"><img src="<?php echo G5_URL; ?>/images/pattern_10.png" width="85" height="83" border="0"></a></li>
								<li id="1415936012"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415936012"><img src="<?php echo G5_URL; ?>/images/pattern_11.png" width="85" height="83" border="0"></a></li>
								<li id="1415936015" class="last"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415936015"><img src="<?php echo G5_URL; ?>/images/pattern_12.png" width="85" height="83" border="0"></a></li>
							</ul>
							</div>
							<div class='cls'>
							<div style="float: right; padding-top:20px;"><a href='<?php echo G5_URL; ?>/shop/list.php?ca_id=10'><span style="font-size:14px; color:#ee2d38">view all products &gt;</span></a></div>
							</div>
						</div>
						<div class="cls"></div>
					</div>
				</div>
			</li>
			<li class="dp1 about noto bold red"><a href="<?php echo G5_URL; ?>/insta">#위글위글</a></li>			
			<!-- <li class="dp1 shop w_link noto bold red"><a href="javascript:;" target="_blank">SHOP</a></li> -->
		</ul>
	</div>
	<div class="dimm_bg"></div>
	<div class="base_bg"></div>
	
</div>
<div id="contentWrapper">
	<div class="contents">
		<?php
			if($pageId == "mypage" && $pageId2 != "view"){
				include_once(G5_PATH."/incl/mypage_head.php");
			}	
			?>
