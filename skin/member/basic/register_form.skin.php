<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if($w=="u"){
	$hp = explode("-",$member[mb_hp]);
	$tel = explode("-",$member[mb_tel]);
}
?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin">

    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick'] ?>">
    <input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick'] ?>">
    <?php }  ?>
	
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption><span class="txt title01">기본정보</span></caption>
        <tbody>
        <tr>
            <th scope="row"><span class="txt label01">아이디</span></th>
            <td>
                <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?> bigInput" minlength="3" maxlength="20">
                <span id="msg_mb_id"></span>
                <a href="javascript:duplicate_id();" class="btn_frmline">중복확인</a>
            </td>
        </tr>
        <tr>
            <th scope="row"><span class="txt label02">비밀번호</span></th>
            <td><input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="frm_input <?php echo $required ?> bigInput" minlength="3" maxlength="20"></td>
        </tr>
        <tr>
            <th scope="row"><span class="txt label03">비밀번호 확인</span></th>
            <td><input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input <?php echo $required ?> bigInput" minlength="3" maxlength="20"></td>
        </tr>
        <tr>
            <th scope="row"><span class="txt label04">이름</span></th>
            <td>
                <?php if ($config['cf_cert_use']) { ?>
                <span class="frm_info">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</span>
                <?php } ?>
                <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?> bigInput" size="10">
                <?php
                if($config['cf_cert_use']) {
                    if($config['cf_cert_ipin'])
                        echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>'.PHP_EOL;
                    if($config['cf_cert_hp'])
                        echo '<button type="button" id="win_hp_cert" class="btn_frmline">휴대폰 본인확인</button>'.PHP_EOL;

                    echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
                }
                ?>
                <?php
                if ($config['cf_cert_use'] && $member['mb_certify']) {
                    if($member['mb_certify'] == 'ipin')
                        $mb_cert = '아이핀';
                    else
                        $mb_cert = '휴대폰';
                ?>
                <div id="msg_certify">
                    <strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
                </div>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><span class="txt label05">이메일</span></th>
            <td>
                <?php if ($config['cf_use_email_certify']) {  ?>
                <span class="frm_info">
                    <?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
                    <?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
                </span>
                <?php }  ?>
                <input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
                <input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email required bigInput" size="70" maxlength="100">
                <a href="javascript:duplicate_email();" class="btn_frmline">중복확인</a>
            </td>
        </tr>

        <?php if ($config['cf_use_homepage']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_homepage">홈페이지<?php if ($config['cf_req_homepage']){ ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td><input type="text" name="mb_homepage" value="<?php echo $member['mb_homepage'] ?>" id="reg_mb_homepage" <?php echo $config['cf_req_homepage']?"required":""; ?> class="frm_input <?php echo $config['cf_req_homepage']?"required":""; ?> bigInput" size="70" maxlength="255"></td>
        </tr>
        <?php }  ?>

        <?php if ($config['cf_use_tel']) {  ?>
        <tr>
            <th scope="row"><span class="txt label06">유선전화</span></th>
            <td><input type="text" name="mb_tel_1" value="<?php echo $tel[0] ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="frm_input <?php echo $config['cf_req_tel']?"required":""; ?> bigInput" maxlength="4" style="width:70px"> - <input type="text" name="mb_tel_2" value="<?php echo $tel[1] ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="frm_input <?php echo $config['cf_req_tel']?"required":""; ?> bigInput" maxlength="4" style="width:70px"> - <input type="text" name="mb_tel_3" value="<?php echo $tel[2] ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="frm_input <?php echo $config['cf_req_tel']?"required":""; ?> bigInput" maxlength="4" style="width:70px"></td>
        </tr>
        <?php }  ?>

        <?php if ($config['cf_use_hp'] || $config['cf_cert_hp']) {  ?>
        <tr>
            <th scope="row"><span class="txt label07">휴대전화</span></th>
            <td>
                <input type="text" name="mb_hp_1" value="<?php echo $hp[0] ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input <?php echo ($config['cf_req_hp'])?"required":""; ?> bigInput" maxlength="3" style="width:70px"> - <input type="text" name="mb_hp_2" value="<?php echo $hp[1] ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input <?php echo ($config['cf_req_hp'])?"required":""; ?> bigInput" maxlength="4" style="width:70px"> - <input type="text" name="mb_hp_3" value="<?php echo $hp[2] ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input <?php echo ($config['cf_req_hp'])?"required":""; ?> bigInput" maxlength="4" style="width:70px">
                <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
                <input type="hidden" name="old_mb_hp" value="<?php echo $member['mb_hp'] ?>">
                <?php } ?>
            </td>
        </tr>
        <?php }  ?>

        <?php if ($config['cf_use_addr']) { ?>
        <tr>
            <th scope="row"><span class="txt label08">주소</span></th>
            <td>
                <label for="reg_mb_zip1" class="sound_only">우편번호 앞자리<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                <input type="text" name="mb_zip1" value="<?php echo $member['mb_zip1'] ?>" id="reg_mb_zip1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?> bigInput" size="3" maxlength="3" style="width:40px">
                -
                <label for="reg_mb_zip2" class="sound_only">우편번호 뒷자리<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                <input type="text" name="mb_zip2" value="<?php echo $member['mb_zip2'] ?>" id="reg_mb_zip2" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?> bigInput" size="3" maxlength="3"  style="width:40px">
                <a href="<?php echo G5_BBS_URL ?>/zip.php?frm_name=fregisterform&amp;frm_zip1=mb_zip1&amp;frm_zip2=mb_zip2&amp;frm_addr1=mb_addr1&amp;frm_addr2=mb_addr2&amp;frm_addr3=mb_addr3&amp;frm_jibeon=mb_addr_jibeon" id="reg_zip_find" class="btn_frmline win_zip_find" target="_blank">주소 검색</a><br>
                <input type="text" name="mb_addr1" value="<?php echo $member['mb_addr1'] ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?> bigInput" size="50" style="width:400px">
                <label for="reg_mb_addr1">기본주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label><br>
                <input type="text" name="mb_addr2" value="<?php echo $member['mb_addr2'] ?>" id="reg_mb_addr2" class="frm_input frm_address bigInput" size="50" style="width:400px">
                <label for="reg_mb_addr2">상세주소</label>
                <br>
                <input type="text" name="mb_addr3" value="<?php echo $member['mb_addr3'] ?>" id="reg_mb_addr3" class="frm_input frm_address bigInput" size="50" readonly="readonly" style="width:400px">
                <label for="reg_mb_addr3">참고항목</label>
                <input type="hidden" name="mb_addr_jibeon" value="<?php echo $member['mb_addr_jibeon']; ?>">
            </td>
        </tr>
        <?php }  ?>
        <?php if ($config['cf_use_signature']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_signature">서명<?php if ($config['cf_req_signature']){ ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td><textarea name="mb_signature" id="reg_mb_signature" <?php echo $config['cf_req_signature']?"required":""; ?> class="<?php echo $config['cf_req_signature']?"required":""; ?>"><?php echo $member['mb_signature'] ?></textarea></td>
        </tr>
        <?php }  ?>

        <?php if ($config['cf_use_profile']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_profile">자기소개</label></th>
            <td><textarea name="mb_profile" id="reg_mb_profile" <?php echo $config['cf_req_profile']?"required":""; ?> class="<?php echo $config['cf_req_profile']?"required":""; ?>"><?php echo $member['mb_profile'] ?></textarea></td>
        </tr>
        <?php }  ?>

        <?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_icon">회원아이콘</label></th>
            <td>
                <span class="frm_info">
                    이미지 크기는 가로 <?php echo $config['cf_member_icon_width'] ?>픽셀, 세로 <?php echo $config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.<br>
                    gif만 가능하며 용량 <?php echo number_format($config['cf_member_icon_size']) ?>바이트 이하만 등록됩니다.
                </span>
                <input type="file" name="mb_icon" id="reg_mb_icon" class="frm_input">
                <?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
                <img src="<?php echo $mb_icon_url ?>" alt="회원아이콘">
                <input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon" class="notWidth">
                <label for="del_mb_icon">삭제</label>
                <?php }  ?>
            </td>
        </tr>
        <?php }  ?>

        <tr>
            <th scope="row"><span class="txt label15">메일링서비스</span></th>
            <td>
                <input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling'])?'checked':''; ?> class="notWidth">
                정보 메일을 받겠습니다.
            </td>
        </tr>

        <?php if ($config['cf_use_hp']) {  ?>
        <tr>
            <th scope="row"><span class="txt label16">수신여부</span></th>
            <td>
                <input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?php echo ($w=='' || $member['mb_sms'])?'checked':''; ?> class="notWidth">
                휴대폰 문자메세지를 받겠습니다.
            </td>
        </tr>
        <?php }  ?>
        <?php if ($w == "" && $config['cf_use_recommend']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_recommend">추천인아이디</label></th>
            <td><input type="text" name="mb_recommend" id="reg_mb_recommend" class="frm_input"></td>
        </tr>
        <?php }  ?>

        <tr>
            <th scope="row"><span class="txt label17">자동등록방지</span></th>
            <td><?php echo captcha_html(); ?></td>
        </tr>
        </tbody>
        </table>
    </div>
    <?php if(!$w) { ?>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption><span class="txt title03">회원가입약관</span></caption>
        <tbody>
        <tr>
        	<td style="padding:5px 0 0 105px;border:0"><textarea readonly style="width:895px;height:220px"><?php echo get_text($config['cf_stipulation']) ?></textarea>
	        <fieldset class="fregister_agree">
	            <label for="agree11">회원가입약관의 내용에 동의합니다.</label>
	            <input type="checkbox" name="agree" value="1" id="agree11" class="notWidth">
	        </fieldset></td>
        </tr>
        </tbody>
        </table>
    </div>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption><span class="txt title04">개인정보처리방침안내</span></caption>
        <tbody>
        <tr>
        	<td style="padding:5px 0 0 105px;border:0"><textarea readonly style="width:895px;height:220px"><?php echo get_text($config['cf_privacy']) ?></textarea>
	        <fieldset class="fregister_agree">
	            <label for="agree21">개인정보처리방침안내의 내용에 동의합니다.</label>
	            <input type="checkbox" name="agree2" value="1" id="agree21" class="notWidth">
	        </fieldset></td>
        </tr>
        </tbody>
        </table>
    </div>
    <?php } ?>
    <div class="btn_confirm2">
        <input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
        <a href="<?php echo G5_URL ?>" class="btn_cancel">취소</a>
    </div>
    </form>

    <script>
    function set_child_infor(n){
		for(i=1;i<=5;i++){
			if(i <= n)
				$("#child_" + i).css("display","table-row");
			else
				$("#child_" + i).css("display","none");
			
		}
    }
    $(function() {
        $("#reg_zip_find").css("display", "inline-block");

        <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        $("#win_ipin_cert").click(function() {
            if(!cert_confirm())
                return false;

            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
            certify_win_open('kcb-ipin', url);
            return;
        });

        <?php } ?>
        <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        $("#win_hp_cert").click(function() {
            if(!cert_confirm())
                return false;

            <?php
            switch($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                case 'lg':
                    $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                    $cert_type = 'lg-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
            return;
        });
        <?php } ?>
    });

    function duplicate_id(){
    	f = document.getElementById("fregisterform");
        // 회원아이디 검사
        if (f.w.value == "") {
            var msg = reg_mb_id_check();
            if (msg) {
                alert(msg);
                f.mb_id.select();
                return false;
            }
        }
        alert("사용 가능한 회원아이디 입니다.");
    }
    function duplicate_email(){
    	f = document.getElementById("fregisterform");
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
            var msg = reg_mb_email_check();
            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }
        alert("사용 가능한 E-mail 주소 입니다.");
    }
    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
        // 회원아이디 검사
        if (f.w.value == "") {
            var msg = reg_mb_id_check();
            if (msg) {
                alert(msg);
                f.mb_id.select();
                return false;
            }
        }

        if (f.w.value == "") {
            if (f.mb_password.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password.focus();
                return false;
            }
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            alert("비밀번호가 같지 않습니다.");
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password_re.focus();
                return false;
            }
        }

        // 이름 검사
        if (f.w.value=="") {
            if (f.mb_name.value.length < 1) {
                alert("이름을 입력하십시오.");
                f.mb_name.focus();
                return false;
            }

            /*
            var pattern = /([^가-힣\x20])/i;
            if (pattern.test(f.mb_name.value)) {
                alert("이름은 한글로 입력하십시오.");
                f.mb_name.select();
                return false;
            }
            */
        }

        <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
        // 본인확인 체크
        if(f.cert_no.value=="") {
            alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
            return false;
        }
        <?php } ?>


        // E-mail 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
            var msg = reg_mb_email_check();
            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }


        if (typeof f.mb_icon != "undefined") {
            if (f.mb_icon.value) {
                if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
                    alert("회원아이콘이 gif 파일이 아닙니다.");
                    f.mb_icon.focus();
                    return false;
                }
            }
        }

        if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
            if (f.mb_id.value == f.mb_recommend.value) {
                alert("본인을 추천할 수 없습니다.");
                f.mb_recommend.focus();
                return false;
            }

            var msg = reg_mb_recommend_check();
            if (msg) {
                alert(msg);
                f.mb_recommend.select();
                return false;
            }
        }

        <?php echo chk_captcha_js();  ?>


	    <?php if(!$w) { ?>
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }
        <?php } ?>
        
        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>

</div>
<!-- } 회원정보 입력/수정 끝 -->