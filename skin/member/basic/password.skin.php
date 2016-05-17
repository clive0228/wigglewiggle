<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$delete_str = "";
if ($w == 'x') $delete_str = "댓";
if ($w == 'u') $g5['title'] = $delete_str."글 수정";
else if ($w == 'd' || $w == 'x') $g5['title'] = $delete_str."글 삭제";
else $g5['title'] = $g5['title'];

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 비밀번호 확인 시작 { -->
<div id="pw_confirm_des">

        <?php if ($w == 'u') { ?>
        <strong>작성자만 글을 수정할 수 있습니다.</strong><br>
        작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 수정할 수 있습니다.
        <?php } else if ($w == 'd' || $w == 'x') {  ?>
        <strong>작성자만 글을 삭제할 수 있습니다.</strong><br>
        작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 삭제할 수 있습니다.
        <?php } else {  ?>
        <strong>비밀글 기능으로 보호된 글입니다.</strong><br>
        작성자와 관리자만 열람하실 수 있습니다. 본인이라면 비밀번호를 입력하세요.
        <?php }  ?>
</div>
<div id="pw_confirm" class="mbskin">
    <form name="fboardpassword" action="<?php echo $action;  ?>" method="post">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">


		<div class="mlogin">
			<div class="mcontent">
				<div class="mctitle">비밀번호</div>
				<div class="mcinput"><input type="password" name="wr_password" id="password_wr_password" required class="frm_input required" size="15" maxLength="20"></div>
			</div>
			<div class="mbutton">
				<input type="image" src="<?php echo G5_URL; ?>/images/login_btn_01.jpg" width="214" height="36">
			</div>
		</div>
		<div class="cls"></div>
    </form>

    <div class="btn_confirm">
        <a href="<?php echo $return_url ?>">돌아가기</a>
    </div>

</div>
<!-- } 비밀번호 확인 끝 -->