<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<!-- 비회원구매, 주문조회도 아닐 경우. 즉 로그인만 있다면~ -->


<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
	<div class="mlogin">
		<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
	    <input type="hidden" name="url" value='<?php echo $login_url ?>'>
			<div class="mtitle">
				회원로그인
			</div>
			<div class="mcontent">
				<div class="mctitle">아이디</div>
				<div class="mcinput"><input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20"></div>
				<div class="mcblank"></div>
				<div class="mctitle">비밀번호</div>
				<div class="mcinput"><input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20"></div>
			</div>
			<div class="mbutton">
				<input type="submit" value="로그인" class="btn_submit" style="width:100%;">
			</div>
			<div class="mbottom">
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php">아이디 비밀번호 찾기</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="./register_form.php">회원 가입</a>
			</div>
		</form>
	</div>
	<div class="mguest">
	        <!-- 주문하기, 신청하기 -->
	        <?php if (preg_match("/orderform.php/", $url)) { ?>
				<div class="mtitle" style="color:#6D6E70">
					비회원구매
				</div>
				<div class="mcontent">
					<div id="guest_privacy"><?php echo $default['de_guest_privacy']; ?></div>
				</div>
				<div class="mbutton">
					<a href="javascript:guest_submit(document.flogin);" class="btn02" style="width:100%">비회원으로 구매하기</a>
				</div>
				<div class="mbottom">
					<input type="checkbox" id="agree" value="1"> 개인정보수집에 대해 동의합니다.
					
				</div>
        
		        <script>
			        function guest_submit(f)
			        {
			            if (document.getElementById('agree')) {
			                if (!document.getElementById('agree').checked) {
			                    alert("개인정보수집에 대한 내용을 읽고 이에 동의하셔야 합니다.");
			                    return;
			                }
			            }
			
			            f.url.value = "<?php echo $url; ?>";
			            f.action = "<?php echo $url; ?>";
			            f.submit();
			        }
		        </script>
        	<?php } else { ?>
				<form name="forderinquiry" method="post" action="<?php echo urldecode($url); ?>" autocomplete="off">
	        		<div class="mtitle" style="color:#6D6E70">
	        			비회원로그인
					</div>
					<div class="mcontent">
						<div class="mctitle">주문서번호</div>
						<div class="mcinput"><input type="text" name="od_id" value="<?php echo $od_id; ?>" id="od_id" required class="frm_input required" size="20"></div>
						<div class="mcblank"></div>
						<div class="mctitle">주문서 비밀번호</div>
						<div class="mcinput"><input type="password" name="od_pwd" size="20" id="od_pwd" required class="frm_input required"></div>
					</div>
					<div class="mbutton">
						<input type="submit" value="확인" class="btn_submit btn_gray_bold" style="width:100%;">
					</div>
					<div class="mbottom">
						메일로 발송해드린 주문서의 주문번호와<br>비밀번호를 정확히 입력해주십시오.
					</div>
				</form>
		<?php } ?>
	</div>
	<div class="cls"></div>
</div>

<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 끝 -->