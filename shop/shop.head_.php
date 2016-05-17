<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

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
		margin:0 auto;
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
	.patterns ul li{
		cursor: pointer;
	}
</style>
<script type="text/javascript">
$(function() {	
	$('.patterns > ul > li').hover( //서브메뉴가 필요한 앞의 3개 대메뉴.
		function(){
			var id = $(this).attr("id");
			$("#bigImage").attr("src","<?php echo G5_URL; ?>/pimg/" + id + ".jpg");			
		},
		function(){
		
		}
	);

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


<div class="cm_head">
	<div class="cm_pivot">
		<div class="logo"><a href="/"><img src="<?php echo G5_URL; ?>/images/logo.png" border="0"></a></div>
		<ul class="social">
			<li><a href="http://www.facebook.com/www.artshare.kr" target="_blank"><img src="<?php echo G5_URL; ?>/images/btn_face.png" border="0" width="17" height="16" border="0"></a></li>
			<li><a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="<?php echo G5_URL; ?>/images/btn_insta.png" border="0" width="17" height="16" border="0"></a></li>
		</ul>
	</div>
</div>

<div id="headGnb" class="gnb">
	<div class="dp_wrap">
		<ul class="dp1_list">
			<li class="dp1 about noto bold red"><a href="<?php echo G5_URL; ?>/">ABOUT US</a></li>
			<li class="dp1 product noto bold red"><a href="javascript:;">PRODUCTS</a>
				<div class="dp2_wrap">
					<div class="dp2_list">
						<div class="bigImage">
							<img src="<?php echo G5_URL; ?>/pimg/1.jpg" width="100%" height="100%" border="0" id="bigImage">
						</div>
						<div class="patterns">
							<ul>
								<li id="1" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897967"><img src="<?php echo G5_URL; ?>/images/pattern_01.png" width="85" height="81" border="0"></a></li>
								<li id="2" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897864"><img src="<?php echo G5_URL; ?>/images/pattern_02.png" width="85" height="81" border="0"></a></li>
								<li id="3" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897970"><img src="<?php echo G5_URL; ?>/images/pattern_03.png" width="85" height="81" border="0"></a></li>
								<li id="4" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897977"><img src="<?php echo G5_URL; ?>/images/pattern_04.png" width="85" height="81" border="0"></a></li>
								<li id="5" class="top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897979"><img src="<?php echo G5_URL; ?>/images/pattern_05.png" width="85" height="81" border="0"></a></li>
								<li id="6" class="last top"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897981"><img src="<?php echo G5_URL; ?>/images/pattern_06.png" width="85" height="81" border="0"></a></li>
								<li id="7" class="cls"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897972"><img src="<?php echo G5_URL; ?>/images/pattern_07.png" width="85" height="83" border="0"></a></li>
								<li id="8"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415897974"><img src="<?php echo G5_URL; ?>/images/pattern_08.png" width="85" height="83" border="0"></a></li>
								<li id="9"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415936023"><img src="<?php echo G5_URL; ?>/images/pattern_09.png" width="85" height="83" border="0"></a></li>
								<li id="10"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415936020"><img src="<?php echo G5_URL; ?>/images/pattern_10.png" width="85" height="83" border="0"></a></li>
								<li id="11"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415936012"><img src="<?php echo G5_URL; ?>/images/pattern_11.png" width="85" height="83" border="0"></a></li>
								<li id="12" class="last"><a href="<?php echo G5_URL; ?>/shop/item.php?it_id=1415936015"><img src="<?php echo G5_URL; ?>/images/pattern_12.png" width="85" height="83" border="0"></a></li>
							</ul>
							<br><br>
							<div style="float: right; padding-top:20px;"><a href='<?php echo G5_URL; ?>/shop/list.php?ca_id=10'><span style="font-size:12px; color:#666">view all products</span></a></div>
						</div>
						<div class="cls"></div>
					</div>
				</div>
			</li>
			<?php if(!$is_member) { ?>
				<li class="dp1 about noto bold red"><a href="<?php echo G5_URL; ?>/bbs/login.php">SIGN IN</a></li>
				<li class="dp1 about noto bold red"><a href="<?php echo G5_URL; ?>/bbs/register_form.php">SIGN UP</a></li>
			<?php }else{ ?>
				<li class="dp1 about noto bold red"><a href="<?php echo G5_URL; ?>/shop/mypage.php">MY PAGE</a></li>
				<li class="dp1 about noto bold red"><a href="<?php echo G5_URL; ?>/bbs/logout.php">LOG OUT</a></li>			
			<?php } ?>
			<!-- <li class="dp1 shop w_link noto bold red"><a href="javascript:;" target="_blank">SHOP</a></li> -->
		</ul>
	</div>
	<div class="dimm_bg"></div>
	<div class="base_bg"></div>
	
</div>
<div id="contentWrapper">
	<div class="contents">
		<?php
			if($pageId == "mypage"){
				include_once(G5_PATH."/incl/mypage_head.php");
			}	
			?>