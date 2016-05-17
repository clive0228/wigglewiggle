<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원 비밀번호 확인 시작 { -->
<div id="mb_confirm" class="mbskin">

    <form name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post">
    <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
    <input type="hidden" name="w" value="u">
    
		<div class="mlogin">
			<div class="mcontent">
				<div class="mctitle">비밀번호</div>
				<div class="mcinput"><input type="password" name="mb_password" id="confirm_mb_password" required class="required frm_input" size="15" maxLength="20" style="width:198px;"></div>
			</div>
			<div class="mbutton">
				<input type="submit" value="확인" class="btn_submit" style="width:100%">
			</div>
		</div>
		<div class="cls"></div>
		
    



    </form>
</div>
<div style="width:100%; text-align:center;padding-bottom:100px;">
    			<p>
			        <span style="font-weight:bold;font-size:11px;color:#727171">비밀번호를 한번 더 입력해주세요.</span><br>
			        <?php if ($url == 'member_leave.php') { ?>
			        <span style="font-size:11px;color:#727171">비밀번호를 입력하시면 회원탈퇴가 완료됩니다.</span>
			        <?php }else{ ?>
			        <span style="font-size:11px;color:#727171">회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.</span>
			        <?php }  ?>
			    </p>
</div>

<script>
function fmemberconfirm_submit(f)
{
    document.getElementById("btn_submit").disabled = true;

    return true;
}
</script>
<!-- } 회원 비밀번호 확인 끝 -->