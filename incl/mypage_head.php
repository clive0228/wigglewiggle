<?
	global $pageId2;
	if (G5_IS_MOBILE) {
	    include_once(G5_MSHOP_PATH.'/mypage.php');
	    return;
	}
	if (!$is_member && $pageId2 != "view")
	    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_SHOP_URL."/mypage.php"));
	
	$g5['title'] = $member['mb_name'].'님 마이페이지';
	include_once('./_head.php');
	
	// 쿠폰
	$cp_count = 0;
	$sql = " select cp_id
	            from {$g5['g5_shop_coupon_table']}
	            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
	              and cp_start <= '".G5_TIME_YMD."'
	              and cp_end >= '".G5_TIME_YMD."' ";
	$res = sql_query($sql);
	
	for($k=0; $cp=sql_fetch_array($res); $k++) {
	    if(!is_used_coupon($member['mb_id'], $cp['cp_id']))
	        $cp_count++;
	}
?>
<div id="smb_my">

    <!-- 회원정보 개요 시작 { -->
    <section id="smb_my_ov">
        <h2>회원정보 개요</h2>

        <div id="smb_my_act">
            <ul>
                <?php if ($is_admin == 'super') { ?><li><a href="<?php echo G5_ADMIN_URL; ?>/" class="btn_admin">관리자</a></li><?php } ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn_admin btn_gray_bold">회원정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" class="btn_admin btn_gray_bold">회원탈퇴</a></li>
            </ul>
        </div>
		<div id="smb_my_act_infor">
			<div class="rinfor">
				<div class="ment">
					<span class="bold"><?=$member[mb_name]?></span>님의 마이페이지입니다.
				</div>
				<div>
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="90" height="28">회원등급</td>
							<td width="200"><?
								if($member[mb_level] == "10") echo "관리자";
								else if($member[mb_level] == "2") echo "일반회원";
								else echo "특별회원";
							?></td>
							<td width="90" height="28">보유포인트</td>
							<td width="200"><a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank" class="win_point"><?php echo number_format($member['mb_point']); ?>점</a></td>
							<td width="90" height="28">보유쿠폰</td>
							<td width="200"><a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank" class="win_coupon"><?php echo number_format($cp_count); ?>개</a></td>
						</tr>
						<tr>
							<td width="90" height="28">연락처</td>
							<td width="200"><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></td>
							<td width="90" height="28">이메일</td>
							<td width="200"></td>
							<td width="90" height="28">최종접속일시</td>
							<td width="200"><?php echo $member['mb_today_login']; ?></td>
						</tr>
						<tr>
							<td width="90" height="28" style="border:0">주소</td>
							<td colspan="5" style="border:0"><?php echo sprintf("(%s-%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr_jibeon']); ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="cls"></div>
		</div>
    </section>
    <!-- } 회원정보 개요 끝 -->
    <?
    	if(strpos($PHP_SELF, "orderinquiry") > 0){
	    	$over[1] = "_over";
    	}else if(strpos($PHP_SELF, "myuselist") > 0){
	    	$over[2] = "_over";
    	}else if(strpos($PHP_SELF, "wishlist") > 0){
	    	$over[3] = "_over";
    	}else if(strpos($PHP_SELF, "qalist") > 0 || strpos($PHP_SELF, "qaview") > 0 || strpos($PHP_SELF, "qawrite") > 0){
	    	$over[4] = "_over";
    	}else if(strpos($PHP_SELF, "register_form") > 0 || (strpos($PHP_SELF, "member_confirm") > 0 && $url =="register_form.php")){
	    	$over[5] = "_over";
    	}else if($url == "member_leave.php"){
	    	$over[6] = "_over";
    	}
    ?>
    <!--

	<section style="padding:30px 0 50px 0;">
		<div style="width:100%; background-color:#ddddde;height:34px;text-align:center">
			<table width="395" height="34" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td><img src="<?php echo G5_URL; ?>/images/mypage_menu_01.png" width="1" height="34" border="0"></td>
					<td><a href="<?php echo G5_URL; ?>/shop/orderinquiry.php"><img src="<?php echo G5_URL; ?>/images/mypage_menu<?=$over[1]?>_02.png" width="75" height="34" border="0"></a></td>
					<td><img src="<?php echo G5_URL; ?>/images/mypage_menu_03.png" width="1" height="34" border="0"></td>
					<td><a href="<?php echo G5_URL; ?>/shop/myuselist.php"><img src="<?php echo G5_URL; ?>/images/mypage_menu<?=$over[2]?>_04.png" width="75" height="34" border="0"></a></td>
					<td><img src="<?php echo G5_URL; ?>/images/mypage_menu_05.png" width="1" height="34" border="0"></td>
					<td><a href="<?php echo G5_URL; ?>/shop/wishlist.php"><img src="<?php echo G5_URL; ?>/images/mypage_menu<?=$over[3]?>_06.png" width="87" height="34" border="0"></a></td>
					<td><img src="<?php echo G5_URL; ?>/images/mypage_menu_07.png" width="1" height="34" border="0"></td>
					<td><a href="<?php echo G5_URL; ?>/bbs/myqalist.php"><img src="<?php echo G5_URL; ?>/images/mypage_menu<?=$over[4]?>_08.png" width="76" height="34" border="0"></a></td>
					<td><img src="<?php echo G5_URL; ?>/images/mypage_menu_09.png" width="1" height="34" border="0"></td>
					<td><a href="<?php echo G5_URL; ?>/bbs/member_confirm.php?url=register_form.php"><img src="<?php echo G5_URL; ?>/images/mypage_menu<?=$over[5]?>_10.png" width="78" height="34" border="0"></a></td>
					<td><img src="<?php echo G5_URL; ?>/images/mypage_menu_11.png" width="1" height="34" border="0"></td>
					<td><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php"><img src="<?php echo G5_URL; ?>/images/mypage_menu<?=$over[6]?>_12.png" width="66" height="34" border="0"></a></td>
					<td><img src="<?php echo G5_URL; ?>/images/mypage_menu_13.png" width="1" height="34" border="0"></td>
				</tr>
		</table>
		</div>
	</section>
-->
    <!-- 최근 주문내역 시작 { -->