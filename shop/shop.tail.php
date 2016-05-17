<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

	if($pageId == "mypage" && $pageId2 != "view"){
		include_once(G5_PATH."/incl/mypage_tail.php");
		}
		
// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
	</div>
	<div class="cls"></div>
</div>
<div id="footerContainer">
	<div class="footer">
		<div class="infor">
			<div class="btns cls">
				<ul>
					<li><a href="http://www.facebook.com/www.artshare.kr" target="_blank"><img src="<?php echo G5_URL; ?>/images/btn_face_white.png" border="0" width="21" height="20" border="0"></a></li>
					<li><a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="<?php echo G5_URL; ?>/images/btn_insta_white.png" border="0" width="21" height="20" border="0"></a></li>
				</ul>
			</div>
			<div class="copyright">
				<img src="<?php echo G5_URL; ?>/images/copyright.png" border="0" width="332" height="39" border="0">
			</div>
		</div>
		<div class="top" id="top" style="cursor: pointer">
			<img src="<?php echo G5_URL; ?>/images/btn_top.png" border="0" width="42" height="16" border="0">
		</div>
	</div>
</div>
<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['PHP_SELF'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<!-- } 하단 끝 -->

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
