<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="new_win mbskin">

	<div class="mlogin">
    	<form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
			<div class="mtitle">
				아이디/비밀번호 찾기
			</div>
			<div class="mcontent">
				<div class="mctitle">이름</div>
				<div class="mcinput"><input type="text" name="mb_name" id="mb_name" required class="frm_input required" size="20" maxLength="20"></div>
				<div class="mcblank"></div>
				<div class="mctitle">E-mail</div>
				<div class="mcinput"><input type="text" name="mb_email" id="mb_email" required class="required frm_input email" size="30"></div>
			</div>
			<div class="mbutton">
				<input type="image" src="<?php echo G5_URL; ?>/images/btn_ok.png" width="214" height="36">
			</div>
			<div class="mbottom"></a>
			</div>
		</form>
	</div>
	<div id="pw_confirm_des" style="padding:30px 0 0 0">
	회원가입 시 등록하신 이메일 주소를 입력해 주세요.<br>
	해당 이메일로 아이디와 임시 비밀번호가 발송됩니다.<br>
	로그인 후 <b>마이페이지 > 개인정보수정</b> 에서 비밀번호를 변경해 주세요.
	</div>
</div>

<script>
function fpasswordlost_submit(f)
{
    <?php echo chk_captcha_js();  ?>

    return true;
}
</script>
<!-- } 회원정보 찾기 끝 -->