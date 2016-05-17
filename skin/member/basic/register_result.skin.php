<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원가입결과 시작 { -->
<div id="reg_result" class="mbskin">
    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/"><img src="<?php echo G5_URL; ?>/images/register_result.png" border="0"></a>
    </div>

</div>
<!-- } 회원가입결과 끝 -->