<?php
$pageId = "orderform";
include_once('./_common.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/orderform.php');
    return;
}

set_session("ss_direct", $sw_direct);
// 장바구니가 비어있는가?
if ($sw_direct) {
    $tmp_cart_id = get_session('ss_cart_direct');
}
else {
    $tmp_cart_id = get_session('ss_cart_id');
}

if (get_cart_count($tmp_cart_id) == 0)
    alert('장바구니가 비어 있습니다.', G5_SHOP_URL.'/cart.php');

$g5['title'] = '주문서 작성';

// 전자결제를 사용할 때만 실행
if($default['de_iche_use'] || $default['de_vbank_use'] || $default['de_hp_use'] || $default['de_card_use']) {
    switch($default['de_pg_service']) {
        case 'lg':
            $g5['body_script'] = 'onload="isActiveXOK();"';
            break;
        default:
            $g5['body_script'] = 'onload="CheckPayplusInstall();"';
            break;
    }
}

include_once('./_head.php');
if ($default['de_hope_date_use']) {
    include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
}

// 새로운 주문번호 생성
$od_id = get_uniqid();
set_session('ss_order_id', $od_id);
$s_cart_id = $tmp_cart_id;
$order_action_url = G5_HTTPS_SHOP_URL.'/orderformupdate.php';

require_once('./settle_'.$default['de_pg_service'].'.inc.php');

// 결제대행사별 코드 include (스크립트 등)
require_once('./'.$default['de_pg_service'].'/orderform.1.php');
?>
<style type="text/css">
#sod_frm_orderer th,#sod_frm_taker th,#sod_frm_pay th{
	padding-left: 60px;
}
#sod_frm_orderer .frm_input,#sod_frm_taker .frm_input,#sod_frm_pay .frm_input{
	border:1px solid #EE2D38;
	height: 28px;
}
</style>
<script type="text/javascript">
	function setKind(str){
		var c;
		if(str =="신용카드"){
			c = "1000000000";
		}else{
			c = "0010000000";
		}
		$("#sndPaymethod").val(c);
	}
	function _pay(_frm) 
	{
 		_frm.sndReply.value           = getLocalUrl("kspay_wh_rcv.php") ;

		var agent = navigator.userAgent;
		var midx		= agent.indexOf("MSIE");
		var out_size	= (midx != -1 && agent.charAt(midx+5) < '7');
    	
		var width_	= 500;
		var height_	= out_size ? 568 : 518;
		var left_	= screen.width;
		var top_	= screen.height;
    	
		left_ = left_/2 - (width_/2);
		top_ = top_/2 - (height_/2);
		
		op = window.open('about:blank','AuthFrmUp',
		        'height='+height_+',width='+width_+',status=yes,scrollbars=no,resizable=no,left='+left_+',top='+top_+'');

		if (op == null)
		{
			alert("팝업이 차단되어 결제를 진행할 수 없습니다.");
			return false;
		}
		
		_frm.target = 'AuthFrmUp';
		_frm.action ='https://kspay.ksnet.to/store/KSPayFlashV1.3/KSPayPWeb.jsp?sndCharSet=utf-8';
		//_frm.action ='http://210.181.28.116/store/KSPayFlashV1.3/KSPayPWeb.jsp?sndCharSet=utf-8';
		
		_frm.submit();
    }

	function getLocalUrl(mypage) 
	{ 
		var myloc = location.href; 
		return myloc.substring(0, myloc.lastIndexOf('/')) + '/' + mypage;
	} 
	
	// goResult() - 함수설명 : 결재완료후 결과값을 지정된 결과페이지(kspay_wh_result.php)로 전송합니다.
	function goResult(){
		document.forderform.target = "";
		document.forderform.action = "./orderformupdate.php";
		document.forderform.submit();
	}
	// eparamSet() - 함수설명 : 결재완료후 (kspay_wh_rcv.php로부터)결과값을 받아 지정된 결과페이지(kspay_wh_result.php)로 전송될 form에 세팅합니다.
	function eparamSet(rcid, rctype, rhash){
		document.forderform.reWHCid.value 	= rcid;
		document.forderform.reWHCtype.value   = rctype  ;
		document.forderform.reWHHash.value 	= rhash  ;
	}
</script>
<form name="forderform" id="forderform" method="post" action="<?php echo $order_action_url; ?>" onsubmit="return forderform_check(this);" autocomplete="off">
<div id="sod_frm">
    <!-- 주문상품 확인 시작 { -->
    <div class="bo_fx bottomLineRed2px" style="padding-bottom:5px;margin:0">
		<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:-260px">제목</span></div>
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table id="sod_list">
        <thead>
        <tr>
            <th scope="col"><span class="txts"style="width:43px;background-position: 0 -500px;">이미지</span></th>
            <th scope="col"><span class="txts"style="width:43px;background-position: 0 -360px;">상품명</span></th>
            <th scope="col"><span class="txts"style="width:35px;background-position: 0 -400px;">총 수량</span></th>
            <th scope="col"><span class="txts"style="width:33px;background-position: 0 -380px;">판매가</span></th>
            <th scope="col"><span class="txts"style="width:77px;background-position: 0 -600px;">쿠폰</span></th>
            <th scope="col"><span class="txts"style="width:45px;background-position: 0 -420px;">주문금액</span></th>
            <th scope="col"><span class="txts"style="width:52px;background-position: 0 -440px;">적립포인트</span></th>
            <th scope="col"><span class="txts"style="width:30px;background-position: 0 -620px;">배송비</span></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $tot_point = 0;
        $tot_sell_price = 0;

        $goods = $goods_it_id = "";
        $goods_count = -1;

        // $s_cart_id 로 현재 장바구니 자료 쿼리
        $sql = " select a.ct_id,
                        a.it_id,
                        a.it_name,
                        a.ct_price,
                        a.ct_point,
                        a.ct_qty,
                        a.ct_status,
                        a.ct_send_cost,
                        a.it_sc_type,
                        b.ca_id,
                        b.ca_id2,
                        b.ca_id3,
                        b.it_notax
                   from {$g5['g5_shop_cart_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
                  where a.od_id = '$s_cart_id'
                    and a.ct_select = '1' ";
        if($default['de_cart_keep_term']) {
            $ctime = date('Y-m-d', G5_SERVER_TIME - ($default['de_cart_keep_term'] * 86400));
            $sql .= " and substring(a.ct_time, 1, 10) >= '$ctime' ";
        }
        $sql .= " group by a.it_id ";
        $sql .= " order by a.ct_id ";
        $result = sql_query($sql);

        $good_info = '';
        $it_send_cost = 0;
        $it_cp_count = 0;

        $comm_tax_mny = 0; // 과세금액
        $comm_vat_mny = 0; // 부가세
        $comm_free_mny = 0; // 면세금액
        $tot_tax_mny = 0;
		$it_name_save = "";
        for ($i=0; $row=mysql_fetch_array($result); $i++)
        {
            // 합계금액 계산
            $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                            SUM(ct_point * ct_qty) as point,
                            SUM(ct_qty) as qty
                        from {$g5['g5_shop_cart_table']}
                        where it_id = '{$row['it_id']}'
                          and od_id = '$s_cart_id' ";
            $sum = sql_fetch($sql);

            if (!$goods)
            {
                //$goods = addslashes($row[it_name]);
                //$goods = get_text($row[it_name]);
                $goods = preg_replace("/\'|\"|\||\,|\&|\;/", "", $row['it_name']);
                $goods_it_id = $row['it_id'];
            }
            $goods_count++;

            // 에스크로 상품정보
            if($default['de_escrow_use']) {
                if ($i>0)
                    $good_info .= chr(30);
                $good_info .= "seq=".($i+1).chr(31);
                $good_info .= "ordr_numb={$od_id}_".sprintf("%04d", $i).chr(31);
                $good_info .= "good_name=".addslashes($row['it_name']).chr(31);
                $good_info .= "good_cntx=".$row['ct_qty'].chr(31);
                $good_info .= "good_amtx=".$row['ct_price'].chr(31);
            }

            $image = get_it_image($row['it_id'], 50, 50);
			$it_name_save = stripslashes($row['it_name']);
            $it_name = '<b>' . stripslashes($row['it_name']) . '</b>';
            $it_options = print_item_options($row['it_id'], $s_cart_id);
            if($it_options) {
                $it_name .= '<div class="sod_opt">'.$it_options.'</div>';
            }

            // 복합과세금액
            if($default['de_tax_flag_use']) {
                if($row['it_notax']) {
                    $comm_free_mny += $sum['price'];
                } else {
                    $tot_tax_mny += $sum['price'];
                }
            }

            $point      = $sum['point'];
            $sell_price = $sum['price'];

            // 쿠폰
            if($is_member) {
                $cp_button = '';
                $cp_count = 0;

                $sql = " select cp_id
                            from {$g5['g5_shop_coupon_table']}
                            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
                              and cp_start <= '".G5_TIME_YMD."'
                              and cp_end >= '".G5_TIME_YMD."'
                              and cp_minimum <= '$sell_price'
                              and (
                                    ( cp_method = '0' and cp_target = '{$row['it_id']}' )
                                    OR
                                    ( cp_method = '1' and ( cp_target IN ( '{$row['ca_id']}', '{$row['ca_id2']}', '{$row['ca_id3']}' ) ) )
                                  ) ";
                $res = sql_query($sql);

                for($k=0; $cp=sql_fetch_array($res); $k++) {
                    if(is_used_coupon($member['mb_id'], $cp['cp_id']))
                        continue;

                    $cp_count++;
                }

                if($cp_count) {
                    $cp_button = '<button type="button" class="cp_btn btn_frmline">적용</button>';
                    $it_cp_count++;
                }
            }

            // 배송비
            switch($row['ct_send_cost'])
            {
                case 1:
                    $ct_send_cost = '착불';
                    break;
                case 2:
                    $ct_send_cost = '무료';
                    break;
                default:
                    $ct_send_cost = '선불';
                    break;
            }

            // 조건부무료
            if($row['it_sc_type'] == 2) {
                $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $s_cart_id);

                if($sendcost == 0)
                    $ct_send_cost = '무료';
            }
        ?>

        <tr>
            <td class="sod_img"><?php echo $image; ?></td>
            <td>
                <input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $row['it_id']; ?>">
                <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo get_text($row['it_name']); ?>">
                <input type="hidden" name="it_price[<?php echo $i; ?>]" value="<?php echo $sell_price; ?>">
                <input type="hidden" name="cp_id[<?php echo $i; ?>]" value="">
                <input type="hidden" name="cp_price[<?php echo $i; ?>]" value="0">
                <?php if($default['de_tax_flag_use']) { ?>
                <input type="hidden" name="it_notax[<?php echo $i; ?>]" value="<?php echo $row['it_notax']; ?>">
                <?php } ?>
                <?php echo $it_name; ?>
            </td>
            <td class="td_num"><?php echo number_format($sum['qty']); ?></td>
            <td class="td_numbig"><?php echo number_format($row['ct_price']); ?></td>
            <td class="td_mngsmall"><?php echo $cp_button; ?></td>
            <td class="td_numbig"><span class="total_price"><?php echo number_format($sell_price); ?></span></td>
            <td class="td_numbig"><?php echo number_format($point); ?></td>
            <td class="td_dvr"><?php echo $ct_send_cost; ?></td>
        </tr>

        <?php
            $tot_point      += $point;
            $tot_sell_price += $sell_price;
        } // for 끝

        if ($i == 0) {
            //echo '<tr><td colspan="7" class="empty_table">장바구니에 담긴 상품이 없습니다.</td></tr>';
            alert('장바구니가 비어 있습니다.', G5_SHOP_URL.'/cart.php');
        } else {
            // 배송비 계산
            $send_cost = get_sendcost($s_cart_id);
        }

        // 복합과세처리
        if($default['de_tax_flag_use']) {
            $comm_tax_mny = round(($tot_tax_mny + $send_cost) / 1.1);
            $comm_vat_mny = ($tot_tax_mny + $send_cost) - $comm_tax_mny;
        }
        ?>
        </tbody>
        </table>
    </div>

    <?php if ($goods_count) $goods .= ' 외 '.$goods_count.'건'; ?>
    <!-- } 주문상품 확인 끝 -->

    <!-- 주문상품 합계 시작 { -->
    
    <div id="sod_bsk_tot">
    	<div class="title">총 주문 금액</div>
    	<div class="cost_infor">
	    	<div class="cost">
	    		<div style="float:left;color:#595757;">상품 총 금액</div>
	    		<div style="float:right;color:#595757;font-weight:bold"><?php echo number_format($tot_sell_price); ?> 원</div>
	    	</div>
	    	<div class="cls"></div>
	        <?php if($it_cp_count > 0) { ?>
		    	<div class="cost_del">
		    		<div style="float:left;color:#595757;">쿠폰할인</div>
		    		<div style="float:right;color:#595757;font-weight:bold"><strong id="ct_tot_coupon">0 원</strong></div>
		    	</div>	   
				<div class="cls"></div> 
	        <?php } ?>	
	    	<div class="cost_del">
	    		<div style="float:left;color:#595757;">배송비</div>
	    		<div style="float:right;color:#595757;font-weight:bold"><?php echo number_format($send_cost); ?> 원</div>
	    	</div>	    	
    	</div>
    	<div class="cls"></div>
        <?php $tot_price = $tot_sell_price + $send_cost; // 총계 = 주문상품금액합계 + 배송비 ?>
    	<div class="cost_result">결제 예정 금액 <span style="font-size:20px"><strong id="ct_tot_price"><?php echo number_format($tot_price); ?></strong></span> 원</div>
    
    </div>
    
        
    
    <!-- } 주문상품 합계 끝 -->

    <input type="hidden" name="od_price"    value="<?php echo $tot_sell_price; ?>">
    <input type="hidden" name="org_od_price"    value="<?php echo $tot_sell_price; ?>">
    <input type="hidden" name="od_send_cost" value="<?php echo $send_cost; ?>">
    <input type="hidden" name="od_send_cost2" value="0">
    <input type="hidden" name="item_coupon" value="0">
    <input type="hidden" name="od_coupon" value="0">
    <input type="hidden" name="od_send_coupon" value="0">

    <?php
    // 결제대행사별 코드 include (결제대행사 정보 필드)
    require_once('./'.$default['de_pg_service'].'/orderform.2.php');
    ?>

    <!-- 주문하시는 분 입력 시작 { -->
    <section id="sod_frm_orderer">
	    <div class="bo_fx" style="border-bottom: 2px solid #EE2D38;padding-bottom:5px;margin:0">
			<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:0px">주문자정보</span></div>
	    </div>

        <div class="tbl_frm01 tbl_wrap">
            <table>
            <tbody>
            <tr>
                <th scope="row"><span class="txts t2" style="width:75px;background-position-y: -20px;">이름</span></th>
                <td><input type="text" name="od_name" value="<?php echo $member['mb_name']; ?>" id="od_name" required class="frm_input required" maxlength="20"></td>
            </tr>

            <?php if (!$is_member) { // 비회원이면 ?>
            <tr>
                <th scope="row"><span class="txts t2" style="width:45px;background-position-y: -240px;">비밀번호</span></th>
                <td>
                    <span class="frm_info">영,숫자 3~20자 (주문서 조회시 필요)</span>
                    <input type="password" name="od_pwd" id="od_pwd" required class="frm_input required" maxlength="20">
                </td>
            </tr>
            <?php } ?>

            <tr>
                <th scope="row"><span class="txts t2" style="width:45px;background-position-y: -60px;">유선전화</span></th>
                <td><input type="text" name="od_tel" value="<?php echo $member['mb_tel']; ?>" id="od_tel" required class="frm_input required" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><span class="txts t2" style="width:45px;background-position-y: -80px;">휴대전화</span></th>
                <td><input type="text" name="od_hp" value="<?php echo $member['mb_hp']; ?>" id="od_hp" class="frm_input" maxlength="20"></td>
            </tr>
            <?php $zip_href = G5_BBS_URL.'/zip.php?frm_name=forderform&amp;frm_zip1=od_zip1&amp;frm_zip2=od_zip2&amp;frm_addr1=od_addr1&amp;frm_addr2=od_addr2&amp;frm_addr3=od_addr3&amp;frm_jibeon=od_addr_jibeon';
            ?>
            <tr>
                <th scope="row"><span class="txts t2" style="width:45px;background-position-y: -100px;">주소</span></th>
                <td>
                    <label for="od_zip1" class="sound_only">우편번호 앞자리<strong class="sound_only"> 필수</strong></label>
                    <input type="text" name="od_zip1" value="<?php echo $member['mb_zip1'] ?>" id="od_zip1" required class="frm_input required" size="4" maxlength="3">
                    -
                    <label for="od_zip2" class="sound_only">우편번호 뒷자리<strong class="sound_only"> 필수</strong></label>
                    <input type="text" name="od_zip2" value="<?php echo $member['mb_zip2'] ?>" id="od_zip2" required class="frm_input required" size="4" maxlength="3">
                    <a href="<?php echo $zip_href; ?>" class="btn_frmline win_zip_find" target="_blank">주소 검색</a><br>
                    <input type="text" name="od_addr1" value="<?php echo $member['mb_addr1'] ?>" id="od_addr1" required class="frm_input frm_address required" size="60">
                    <label for="od_addr1">기본주소<strong class="sound_only"> 필수</strong></label><br>
                    <input type="text" name="od_addr2" value="<?php echo $member['mb_addr2'] ?>" id="od_addr2" class="frm_input frm_address" size="60">
                    <label for="od_addr2">상세주소</label>
                    <br>
                    <input type="text" name="od_addr3" value="<?php echo $member['mb_addr3'] ?>" id="od_addr3" class="frm_input frm_address" size="60" readonly="readonly">
                    <label for="od_addr3">참고항목</label><br>
                    <input type="hidden" name="od_addr_jibeon" value="<?php echo $member['mb_addr_jibeon']; ?>">
                </td>
            </tr>
            <tr>
                <th scope="row"><span class="txts t2" style="width:45px;background-position-y: -40px;">이메일</span></th>
                <td><input type="text" name="od_email" value="<?php echo $member['mb_email']; ?>" id="od_email" required class="frm_input required" size="35" maxlength="100"></td>
            </tr>

            <?php if ($default['de_hope_date_use']) { // 배송희망일 사용 ?>
            <tr>
                <th scope="row"><label for="od_hope_date">희망배송일</label></th>
                <td>
                    <!-- <select name="od_hope_date" id="od_hope_date">
                    <option value="">선택하십시오.</option>
                    <?php
                    for ($i=0; $i<7; $i++) {
                        $sdate = date("Y-m-d", time()+86400*($default['de_hope_date_after']+$i));
                        echo '<option value="'.$sdate.'">'.$sdate.' ('.get_yoil($sdate).')</option>'.PHP_EOL;
                    }
                    ?>
                    </select> -->
                    <input type="text" name="od_hope_date" value="" id="od_hope_date" required class="frm_input required" size="11" maxlength="10" readonly="readonly"> 이후로 배송 바랍니다.
                </td>
            </tr>
            <?php } ?>
            </tbody>
            </table>
        </div>
    </section>
    <!-- } 주문하시는 분 입력 끝 -->

    <!-- 받으시는 분 입력 시작 { -->
    <section id="sod_frm_taker">
       <div class="bo_fx" style="border-bottom: 2px solid #EE2D38;padding-bottom:5px;margin:0">
			<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:-20px">받는사람정보</span></div>
	    </div>

        <div class="tbl_frm01 tbl_wrap">
            <table>
            <tbody>
            <?php
            if($is_member) {
                // 배송지 이력
                $addr_list = '';
                $sep = chr(30);

                // 주문자와 동일
                $addr_list .= '<input type="radio" name="ad_sel_addr" value="same" id="ad_sel_addr_same">'.PHP_EOL;
                $addr_list .= '<label for="ad_sel_addr_same">주문자와 동일</label>'.PHP_EOL;

                // 기본배송지
                $sql = " select *
                            from {$g5['g5_shop_order_address_table']}
                            where mb_id = '{$member['mb_id']}'
                              and ad_default = '1' ";
                $row = sql_fetch($sql);
                if($row['ad_id']) {
                    $val1 = $row['ad_name'].$sep.$row['ad_tel'].$sep.$row['ad_hp'].$sep.$row['ad_zip1'].$sep.$row['ad_zip2'].$sep.$row['ad_addr1'].$sep.$row['ad_addr2'].$sep.$row['ad_addr3'].$sep.$row['ad_jibeon'].$sep.$row['ad_subject'];
                    $addr_list .= '<input type="radio" name="ad_sel_addr" value="'.$val1.'" id="ad_sel_addr_def">'.PHP_EOL;
                    $addr_list .= '<label for="ad_sel_addr_def">기본배송지</label>'.PHP_EOL;
                }

                // 최근배송지
                $sql = " select *
                            from {$g5['g5_shop_order_address_table']}
                            where mb_id = '{$member['mb_id']}'
                              and ad_default = '0'
                            order by ad_id desc
                            limit 1 ";
                $result = sql_query($sql);
                for($i=0; $row=sql_fetch_array($result); $i++) {
                    $val1 = $row['ad_name'].$sep.$row['ad_tel'].$sep.$row['ad_hp'].$sep.$row['ad_zip1'].$sep.$row['ad_zip2'].$sep.$row['ad_addr1'].$sep.$row['ad_addr2'].$sep.$row['ad_addr3'].$sep.$row['ad_jibeon'].$sep.$row['ad_subject'];
                    $val2 = '<label for="ad_sel_addr_'.($i+1).'">최근배송지('.($row['ad_subject'] ? $row['ad_subject'] : $row['ad_name']).')</label>';
                    $addr_list .= '<input type="radio" name="ad_sel_addr" value="'.$val1.'" id="ad_sel_addr_'.($i+1).'"> '.PHP_EOL.$val2.PHP_EOL;
                }

                $addr_list .= '<input type="radio" name="ad_sel_addr" value="new" id="od_sel_addr_new">'.PHP_EOL;
                $addr_list .= '<label for="od_sel_addr_new">신규배송지</label>'.PHP_EOL;

                $addr_list .='<a href="'.G5_SHOP_URL.'/orderaddress.php" id="order_address" class="btn_frmline">배송지목록</a>';
            } else {
                // 주문자와 동일
                $addr_list .= '<input type="checkbox" name="ad_sel_addr" value="same" id="ad_sel_addr_same">'.PHP_EOL;
                $addr_list .= '<label for="ad_sel_addr_same">주문자와 동일</label>'.PHP_EOL;
            }
            ?>
            <tr>
                <th scope="row"><span class="txts t2" style="width:55px;background-position-y: -540px;">배송지선택</span></th>
                <td>
                    <?php echo $addr_list; ?>
                </td>
            </tr>
            <?php if($is_member) { ?>
            <tr>
                <th scope="row"><span class="txts t2" style="width:55px;background-position-y: -560px;">배송지이름</span></th>
                <td>
                    <input type="text" name="ad_subject" id="ad_subject" class="frm_input" maxlength="20">
                    <input type="checkbox" name="ad_default" id="ad_default" value="1">
                    <label for="ad_default">기본배송지로 설정</label>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <th scope="row"><span class="txts t2" style="width:75px;background-position-y: -120px;">이름</span></th>
                <td><input type="text" name="od_b_name" id="od_b_name" required class="frm_input required" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><span class="txts t2" style="width:45px;background-position-y: -60px;">일반전화</span></th>
                <td><input type="text" name="od_b_tel" id="od_b_tel" required class="frm_input required" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><span class="txts t2" style="width:45px;background-position-y: -80px;">휴대전화</span></th>
                <td><input type="text" name="od_b_hp" id="od_b_hp" class="frm_input" maxlength="20"></td>
            </tr>
            <?php $zip_href = G5_BBS_URL.'/zip.php?frm_name=forderform&amp;frm_zip1=od_b_zip1&amp;frm_zip2=od_b_zip2&amp;frm_addr1=od_b_addr1&amp;frm_addr2=od_b_addr2&amp;frm_addr3=od_b_addr3&amp;frm_jibeon=od_b_addr_jibeon'; ?>
            <tr>
                <th scope="row"><span class="txts t2" style="width:45px;background-position-y: -100px;">주소</span></th>
                <td id="sod_frm_addr">
                    <label for="od_b_zip1" class="sound_only">우편번호 앞자리<strong class="sound_only"> 필수</strong></label>
                    <input type="text" name="od_b_zip1" id="od_b_zip1" required class="frm_input required" size="4" maxlength="3">
                    -
                    <label for="od_b_zip2" class="sound_only">우편번호 뒷자리<strong class="sound_only"> 필수</strong></label>
                    <input type="text" name="od_b_zip2" id="od_b_zip2" required class="frm_input required" size="4" maxlength="3">
                    <a href="<?php echo $zip_href; ?>" class="btn_frmline win_zip_find" target="_blank">주소 검색</a><br>
                    <input type="text" name="od_b_addr1" id="od_b_addr1" required class="frm_input frm_address required" size="60">
                    <label for="od_b_addr1">기본주소<strong class="sound_only"> 필수</strong></label><br>
                    <input type="text" name="od_b_addr2" id="od_b_addr2" class="frm_input frm_address" size="60">
                    <label for="od_b_addr2">상세주소</label>
                    <br>
                    <input type="text" name="od_b_addr3" id="od_b_addr3" readonly="readonly" class="frm_input frm_address" size="60">
                    <label for="od_b_addr3">참고항목</label><br>
                    <input type="hidden" name="od_b_addr_jibeon" value="">
                </td>
            </tr>
            <tr>
                <th scope="row"><span class="txts t2" style="width:85px;background-position-y: -140px;">전하실말씀</span></th>
                <td><textarea name="od_memo" id="od_memo" style="border:1px solid #989898"></textarea></td>
            </tr>
            </tbody>
            </table>
        </div>
    </section>
    <!-- } 받으시는 분 입력 끝 -->

    <!-- 결제정보 입력 시작 { -->
    <?php
    $oc_cnt = $sc_cnt = 0;
    if($is_member) {
        // 주문쿠폰
        $sql = " select cp_id
                    from {$g5['g5_shop_coupon_table']}
                    where mb_id IN ( '{$member['mb_id']}', '전체회원' )
                      and cp_method = '2'
                      and cp_start <= '".G5_TIM_YMD."'
                      and cp_end >= '".G5_TIME_YMD."' ";
        $res = sql_query($sql);

        for($k=0; $cp=sql_fetch_array($res); $k++) {
            if(is_used_coupon($member['mb_id'], $cp['cp_id']))
                continue;

            $oc_cnt++;
        }

        if($send_cost > 0) {
            // 배송비쿠폰
            $sql = " select cp_id
                        from {$g5['g5_shop_coupon_table']}
                        where mb_id IN ( '{$member['mb_id']}', '전체회원' )
                          and cp_method = '3'
                          and cp_start <= '".G5_TIM_YMD."'
                          and cp_end >= '".G5_TIME_YMD."' ";
            $res = sql_query($sql);

            for($k=0; $cp=sql_fetch_array($res); $k++) {
                if(is_used_coupon($member['mb_id'], $cp['cp_id']))
                    continue;

                $sc_cnt++;
            }
        }
    }
    ?>

    <section id="sod_frm_pay">
        <div class="bo_fx" style="border-bottom: 2px solid #EE2D38;padding-bottom:5px;margin:0">
			<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:-40px">결제정보</span></div>
	    </div>

        <div class="tbl_frm01 tbl_wrap">
            <table>
            <tbody>
            <?php if($oc_cnt > 0) { ?>
            <tr>
                <th scope="row" style="text-align:left!important;width:105px!important" ><span class="txts t2" style="width:75px;background-position-y: -500px;">주문할인쿠폰</span></th>
                <td>
                    <input type="hidden" name="od_cp_id" value="">
                    <button type="button" id="od_coupon_btn" class="btn_frmline">쿠폰적용</button>
                </td>
            </tr>
            <tr>
                <th scope="row" style="text-align:left!important;width:105px!important" ><span class="txts t2" style="width:75px;background-position-y: -520px;">주문할인금액</span></th>
                <td><span id="od_cp_price">0</span>원</td>
            </tr>
            <?php } ?>
            <?php if($sc_cnt > 0) { ?>
            <tr>
                <th scope="row" style="text-align:left!important;width:105px!important" ><span class="txts t2" style="width:75px;background-position-y: -580px;">배송비할인쿠폰</span></th>
                <td>
                    <input type="hidden" name="sc_cp_id" value="">
                    <button type="button" id="sc_coupon_btn" class="btn_frmline">쿠폰적용</button>
                </td>
            </tr>
            <tr>
                <th scope="row" style="text-align:left!important;width:105px!important" ><span class="txts t2" style="width:75px;background-position-y: -600px;">배송비할인금액</span></th>
                <td><span id="sc_cp_price">0</span>원</td>
            </tr>
            <?php } ?>
            <tr>
                <th scope="row" style="text-align:left!important;width:105px!important" ><span class="txts t2" style="width:75px;background-position-y: -460px;">주문금액</span></th>
                <td><span id="od_tot_price"><?php echo number_format($tot_price); ?></span>원</td>
            </tr>
            <tr>
                <th scope="row" style="text-align:left!important;width:105px!important" ><span class="txts t2" style="width:75px;background-position-y: -480px;">추가배송비</span></th>
                <td><span id="od_send_cost2">0</span>원 (지역에 따라 추가되는 도선료 등의 배송비입니다.)</td>
            </tr>
            <tr>
                <th scope="row" style="text-align:left!important;width:105px!important" ><span class="txts t2" style="width:75px;background-position-y: -200px;">결제방식 선택</span></th>
                <td>
			        <?php
				        $multi_settle == 0;
				        $checked = '';
				
				        $escrow_title = "";
				        if ($default['de_escrow_use']) {
				            $escrow_title = "에스크로 ";
				        }
				
				        // 무통장입금 사용
				        if ($default['de_bank_use']) {
				            $multi_settle++;
				            echo '<input type="radio" id="od_settle_bank" name="od_settle_case" value="무통장" '.$checked.'> <label for="od_settle_bank">무통장입금</label>'.PHP_EOL;
				            $checked = '';
				        }
				
						echo '<input type="radio" id="od_settle_card" name="od_settle_case" value="신용카드" '.$checked.' onclick="setKind(\'신용카드\');"> <label for="od_settle_card">신용카드</label>'.PHP_EOL;
						echo '<input type="radio" id="od_settle_bank" name="od_settle_case" value="계좌이체" '.$checked.' onclick="setKind(\'계좌이체\');"> <label for="od_settle_card">계좌이체</label>'.PHP_EOL;
				        // 가상계좌 사용
				        if ($default['de_vbank_use']) {
				            $multi_settle++;
				            echo '<input type="radio" id="od_settle_vbank" name="od_settle_case" value="가상계좌" '.$checked.'> <label for="od_settle_vbank">'.$escrow_title.'가상계좌</label>'.PHP_EOL;
				            $checked = '';
				        }
				
				        // 계좌이체 사용
				        if ($default['de_iche_use']) {
				            $multi_settle++;
				            echo '<input type="radio" id="od_settle_iche" name="od_settle_case" value="계좌이체" '.$checked.'> <label for="od_settle_iche">'.$escrow_title.'계좌이체</label>'.PHP_EOL;
				            $checked = '';
				        }
				
				        // 휴대폰 사용
				        if ($default['de_hp_use']) {
				            $multi_settle++;
				            echo '<input type="radio" id="od_settle_hp" name="od_settle_case" value="휴대폰" '.$checked.'> <label for="od_settle_hp">휴대폰</label>'.PHP_EOL;
				            $checked = '';
				        }
				
				        // 신용카드 사용
				        if ($default['de_card_use']) {
				            $multi_settle++;
				            echo '<input type="radio" id="od_settle_card" name="od_settle_case" value="신용카드" '.$checked.'> <label for="od_settle_card">신용카드</label>'.PHP_EOL;
				            $checked = '';
				        }
				
				        $temp_point = 0;
				        // 회원이면서 포인트사용이면
				        if ($is_member && $config['cf_use_point'])
				        {
				            // 포인트 결제 사용 포인트보다 회원의 포인트가 크다면
				            if ($member['mb_point'] >= $default['de_settle_min_point'])
				            {
				                $temp_point = (int)$default['de_settle_max_point'];
				
				                if($temp_point > (int)$tot_sell_price)
				                    $temp_point = (int)$tot_sell_price;
				
				                if($temp_point > (int)$member['mb_point'])
				                    $temp_point = (int)$member['mb_point'];
				
				                $point_unit = (int)$default['de_settle_point_unit'];
				                $temp_point = (int)((int)($temp_point / $point_unit) * $point_unit);
				        ?>
				            <p id="sod_frm_pt">보유포인트(<?php echo display_point($member['mb_point']); ?>)중 <strong id="use_max_point">최대 <?php echo display_point($temp_point); ?></strong>까지 사용 가능</p>
				            <input type="hidden" name="max_temp_point" value="<?php echo $temp_point; ?>">
				            <label for="od_temp_point">사용 포인트</label>
				            <input type="text" name="od_temp_point" value="0" id="od_temp_point" class="frm_input" size="10">점 (<?php echo $point_unit; ?>점 단위로 입력하세요.)
				        <?php
				            $multi_settle++;
				            }
				        }
				
				        if ($default['de_bank_use']) {
				            // 은행계좌를 배열로 만든후
				            $str = explode("\n", trim($default['de_bank_account']));
				            if (count($str) <= 1)
				            {
				                $bank_account = '<input type="hidden" name="od_bank_account" value="'.$str[0].'">'.$str[0].PHP_EOL;
				            }
				            else
				            {
				                $bank_account = '<select name="od_bank_account" id="od_bank_account">'.PHP_EOL;
				                $bank_account .= '<option value="">선택하십시오.</option>';
				                for ($i=0; $i<count($str); $i++)
				                {
				                    //$str[$i] = str_replace("\r", "", $str[$i]);
				                    $str[$i] = trim($str[$i]);
				                    $bank_account .= '<option value="'.$str[$i].'">'.$str[$i].'</option>'.PHP_EOL;
				                }
				                $bank_account .= '</select>'.PHP_EOL;
				            }
				            echo '<div id="settle_bank" style="display:none">';
				            echo '<label for="od_bank_account" class="sound_only">입금할 계좌</label>';
				            echo $bank_account;
				            echo '<br><label for="od_deposit_name">입금자명</label>&nbsp;';
				            echo '<input type="text" name="od_deposit_name" id="od_deposit_name" class="frm_input" size="10" maxlength="20">';
				            echo '</div>';
				        }
				
				
				        if ($multi_settle == 0)
				            echo '<p>결제할 방법이 없습니다.<br>운영자에게 알려주시면 감사하겠습니다.</p>';
				        ?>
                
                </td>
            </tr>
            <?php 
		        if (!$default['de_card_point']) { ?>
	            <tr>
	            	<th style="border:none"></th>
	            	<td style="border:none!important">
					            <p id="sod_frm_pt_alert"><strong>무통장입금</strong> 이외의 결제 수단으로 결제하시는 경우 포인트를 적립해드리지 않습니다.</p>
	            	</td>
	            </tr>
            <?php } ?>
            </tbody>
            </table>
        </div>

    </section>
    <!-- } 결제 정보 입력 끝 -->

    <?php
    // 결제대행사별 코드 include (주문버튼)
    require_once('./'.$default['de_pg_service'].'/orderform.3.php');
    ?>
    
    
    
    
    
    
    
    
    
    <input type='hidden' id="sndPaymethod" name='sndPaymethod' value="-1" size='15' maxlength='10'>
    <input type='hidden' id="sndStoreid" name='sndStoreid' value='2001105758' size='15' maxlength='10'>
    <input type='hidden' id="1111111111" name='1111111111' value='2999199999' size='15' maxlength='10'>
    
    <input type='hidden' id="sndOrdernumber" value="<?=$tmp_cart_id?>" name='sndOrdernumber' size='30'>
	<input type='hidden' id="sndGoodname" value="<?=$it_name_save?>" name='sndGoodname' size='30'>
	<input type='hidden' id="sndAmount" name='sndAmount' value="<?=$tot_price?>"  size='15' maxlength='9'>
	<input type='hidden' id="sndOrdername" value="<?=$member[mb_name]?>" name='sndOrdername' size='30'>
	<input type='hidden' id="sndEmail" value="<?=$member[mb_email]?>" name='sndEmail' size='30'>
	<input type='hidden' id="sndMobile" value="<?=$member[mb_hp]?>" name='sndMobile' size='12' maxlength='12'>
	<!----------------------------------------------- <Part 2. 추가설정항목(메뉴얼참조)>  ----------------------------------------------->

	<!-- 0. 공통 환경설정 -->
	<input type=hidden	name=sndReply value="">
	<input type=hidden  name=sndGoodType value="1"> 	<!-- 상품유형: 실물(1),디지털(2) -->
	
	<!-- 1. 신용카드 관련설정 -->
	
	<!-- 신용카드 결제방법  -->
	<!-- 일반적인 업체의 경우 ISP,안심결제만 사용하면 되며 다른 결제방법 추가시에는 사전에 협의이후 적용바랍니다 -->
	<input type=hidden  name=sndShowcard value="I,M"> <!-- I(ISP), M(안심결제), N(일반승인:구인증방식), A(해외카드), W(해외안심)-->
	
	<!-- 신용카드(해외카드) 통화코드: 해외카드결제시 달러결제를 사용할경우 변경 -->
	<input type=hidden	name=sndCurrencytype value="WON"> <!-- 원화(WON), 달러(USD) -->
	
	<!-- 할부개월수 선택범위 -->
	<!--상점에서 적용할 할부개월수를 세팅합니다. 여기서 세팅하신 값은 결제창에서 고객이 스크롤하여 선택하게 됩니다 -->
	<!--아래의 예의경우 고객은 0~12개월의 할부거래를 선택할수있게 됩니다. -->
	<input type=hidden	name=sndInstallmenttype value="ALL(0:2:3:4:5:6:7:8:9:10:11:12)">
	
	<!-- 가맹점부담 무이자할부설정 -->
	<!-- 카드사 무이자행사만 이용하실경우  또는 무이자 할부를 적용하지 않는 업체는  "NONE"로 세팅  -->
	<!-- 예 : 전체카드사 및 전체 할부에대해서 무이자 적용할 때는 value="ALL" / 무이자 미적용할 때는 value="NONE" -->
	<!-- 예 : 전체카드사 3,4,5,6개월 무이자 적용할 때는 value="ALL(3:4:5:6)" -->
	<!-- 예 : 삼성카드(카드사코드:04) 2,3개월 무이자 적용할 때는 value="04(3:4:5:6)"-->
	<!-- <input type=hidden	name=sndInteresttype value="10(02:03),05(06)"> -->
	<input type=hidden	name=sndInteresttype value="NONE">

	<!-- 2. 온라인입금(가상계좌) 관련설정 -->
	<input type=hidden	name=sndEscrow value="1"> 			<!-- 에스크로사용여부 (0:사용안함, 1:사용) -->
	
	<!-- 3. 월드패스카드 관련설정 -->
	<input type=hidden	name=sndWptype value="1">  			<!--선/후불카드구분 (1:선불카드, 2:후불카드, 3:모든카드) -->
	<input type=hidden	name=sndAdulttype value="1">  		<!--성인확인여부 (0:성인확인불필요, 1:성인확인필요) -->
	
	<!-- 4. 계좌이체 현금영수증발급여부 설정 -->
    <input type=hidden  name=sndCashReceipt value="0">          <!--계좌이체시 현금영수증 발급여부 (0: 발급안함, 1:발급) -->

	<!-- 5. 상품권, 게임문화상품권 관련 설정 -->
	<input type=hidden  name=sndMembId value="userid"> <!-- 가맹점사용자ID (문화,게임문화 상품권결제시 필수) -->
	
	<!----------------------------------------------- <Part 3. 승인응답 결과데이터>  ----------------------------------------------->
	<!-- 결과데이타: 승인이후 자동으로 채워집니다. (*변수명을 변경하지 마세요) -->
	
		<input type=hidden name=reWHCid 	value="">
		<input type=hidden name=reWHCtype 	value="">
		<input type=hidden name=reWHHash 	value="">
	<!--------------------------------------------------------------------------------------------------------------------------->
	
	<!--업체에서 추가하고자하는 임의의 파라미터를 입력하면 됩니다.-->
	<!--이 파라메터들은 지정된결과 페이지(kspay_result.php)로 전송됩니다.-->
		<input type=hidden name=a        value="a1">
		<input type=hidden name=b        value="b1">
		<input type=hidden name=c        value="c1">
		<input type=hidden name=d        value="d1">
	<!--------------------------------------------------------------------------------------------------------------------------->
    </form>
    <?php
    if ($default['de_escrow_use']) {
        // 결제대행사별 코드 include (에스크로 안내)
        require_once('./'.$default['de_pg_service'].'/orderform.4.php');
    }
    ?>

</div>

<script>
$(function() {
    var $cp_btn_el;
    var $cp_row_el;
    var zipcode = "";

    $(".cp_btn").click(function() {
        $cp_btn_el = $(this);
        $cp_row_el = $(this).closest("tr");
        $("#cp_frm").remove();
        var it_id = $cp_btn_el.closest("tr").find("input[name^=it_id]").val();

        $.post(
            "./orderitemcoupon.php",
            { it_id: it_id,  sw_direct: "<?php echo $sw_direct; ?>" },
            function(data) {
                $cp_btn_el.after(data);
            }
        );
    });

    $(".cp_apply").live("click", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='f_cp_id[]']").val();
        var price = $el.find("input[name='f_cp_prc[]']").val();
        var subj = $el.find("input[name='f_cp_subj[]']").val();
        var sell_price;

        if(parseInt(price) == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        // 이미 사용한 쿠폰이 있는지
        var cp_dup = false;
        var cp_dup_idx;
        var $cp_dup_el;
        $("input[name^=cp_id]").each(function(index) {
            var id = $(this).val();

            if(id == cp_id) {
                cp_dup_idx = index;
                cp_dup = true;
                $cp_dup_el = $(this).closest("tr");;

                return false;
            }
        });

        if(cp_dup) {
            var it_name = $("input[name='it_name["+cp_dup_idx+"]']").val();
            if(!confirm(subj+ "쿠폰은 "+it_name+"에 사용되었습니다.\n"+it_name+"의 쿠폰을 취소한 후 적용하시겠습니까?")) {
                return false;
            } else {
                coupon_cancel($cp_dup_el);
                $("#cp_frm").remove();
                $cp_dup_el.find(".cp_btn").text("적용").focus();
                $cp_dup_el.find(".cp_cancel").remove();
            }
        }

        var $s_el = $cp_row_el.find(".total_price");;
        sell_price = parseInt($cp_row_el.find("input[name^=it_price]").val());
        sell_price = sell_price - parseInt(price);
        if(sell_price < 0) {
            alert("쿠폰할인금액이 상품 주문금액보다 크므로 쿠폰을 적용할 수 없습니다.");
            return false;
        }
        $s_el.text(number_format(String(sell_price)));
        $cp_row_el.find("input[name^=cp_id]").val(cp_id);
        $cp_row_el.find("input[name^=cp_price]").val(price);

        calculate_total_price();
        $("#cp_frm").remove();
        $cp_btn_el.text("변경").focus();
        if(!$cp_row_el.find(".cp_cancel").size())
            $cp_btn_el.after("<button type=\"button\" class=\"cp_cancel btn_frmline\">취소</button>");
    });

    $("#cp_close").live("click", function() {
        $("#cp_frm").remove();
        $cp_btn_el.focus();
    });

    $(".cp_cancel").live("click", function() {
        coupon_cancel($(this).closest("tr"));
        calculate_total_price();
        $("#cp_frm").remove();
        $(this).closest("tr").find(".cp_btn").text("적용").focus();
        $(this).remove();
    });

    $("#od_coupon_btn").click(function() {
        $("#od_coupon_frm").remove();
        var $this = $(this);
        var price = parseInt($("input[name=org_od_price]").val()) - parseInt($("input[name=item_coupon]").val());
        if(price <= 0) {
            alert('상품금액이 0원이므로 쿠폰을 사용할 수 없습니다.');
            return false;
        }
        $.post(
            "./ordercoupon.php",
            { price: price },
            function(data) {
                $this.after(data);
            }
        );
    });

    $(".od_cp_apply").live("click", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='o_cp_id[]']").val();
        var price = parseInt($el.find("input[name='o_cp_prc[]']").val());
        var subj = $el.find("input[name='o_cp_subj[]']").val();
        var send_cost = $("input[name=od_send_cost]").val();
        var item_coupon = parseInt($("input[name=item_coupon]").val());
        var od_price = parseInt($("input[name=org_od_price]").val()) - item_coupon;

        if(price == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        if(od_price - price <= 0) {
            alert("쿠폰할인금액이 주문금액보다 크므로 쿠폰을 적용할 수 없습니다.");
            return false;
        }

        $("input[name=sc_cp_id]").val("");
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();

        $("input[name=od_price]").val(od_price - price);
        $("input[name=od_cp_id]").val(cp_id);
        $("input[name=od_coupon]").val(price);
        $("input[name=od_send_coupon]").val(0);
        $("#od_cp_price").text(number_format(String(price)));
        $("#sc_cp_price").text(0);
        calculate_order_price();
        $("#od_coupon_frm").remove();
        $("#od_coupon_btn").text("쿠폰변경").focus();
        if(!$("#od_coupon_cancel").size())
            $("#od_coupon_btn").after("<button type=\"button\" id=\"od_coupon_cancel\" class=\"btn_frmline\">쿠폰취소</button>");
    });

    $("#od_coupon_close").live("click", function() {
        $("#od_coupon_frm").remove();
        $("#od_coupon_btn").focus();
    });

    $("#od_coupon_cancel").live("click", function() {
        var org_price = $("input[name=org_od_price]").val();
        var item_coupon = parseInt($("input[name=item_coupon]").val());
        $("input[name=od_price]").val(org_price - item_coupon);
        $("input[name=sc_cp_id]").val("");
        $("input[name=od_coupon]").val(0);
        $("input[name=od_send_coupon]").val(0);
        $("#od_cp_price").text(0);
        $("#sc_cp_price").text(0);
        calculate_order_price();
        $("#od_coupon_frm").remove();
        $("#od_coupon_btn").text("쿠폰적용").focus();
        $(this).remove();
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();
    });

    $("#sc_coupon_btn").click(function() {
        $("#sc_coupon_frm").remove();
        var $this = $(this);
        var price = parseInt($("input[name=od_price]").val());
        var send_cost = parseInt($("input[name=od_send_cost]").val());
        $.post(
            "./ordersendcostcoupon.php",
            { price: price, send_cost: send_cost },
            function(data) {
                $this.after(data);
            }
        );
    });

    $(".sc_cp_apply").live("click", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='s_cp_id[]']").val();
        var price = parseInt($el.find("input[name='s_cp_prc[]']").val());
        var subj = $el.find("input[name='s_cp_subj[]']").val();
        var send_cost = parseInt($("input[name=od_send_cost]").val());

        if(parseInt(price) == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        $("input[name=sc_cp_id]").val(cp_id);
        $("input[name=od_send_coupon]").val(price);
        $("#sc_cp_price").text(number_format(String(price)));
        calculate_order_price();
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").text("쿠폰변경").focus();
        if(!$("#sc_coupon_cancel").size())
            $("#sc_coupon_btn").after("<button type=\"button\" id=\"sc_coupon_cancel\" class=\"btn_frmline\">쿠폰취소</button>");
    });

    $("#sc_coupon_close").live("click", function() {
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").focus();
    });

    $("#sc_coupon_cancel").live("click", function() {
        $("input[name=od_send_coupon]").val(0);
        $("#sc_cp_price").text(0);
        calculate_order_price();
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").text("쿠폰적용").focus();
        $(this).remove();
    });

    $("#od_b_addr2").focus(function() {
        var zip1 = $("#od_b_zip1").val().replace(/[^0-9]/g, "");
        var zip2 = $("#od_b_zip2").val().replace(/[^0-9]/g, "");
        if(zip1 == "" || zip2 == "")
            return false;

        var code = String(zip1) + String(zip2);

        if(zipcode == code)
            return false;

        zipcode = code;
        calculate_sendcost(code);
    });

    $("#od_settle_bank").on("click", function() {
        $("[name=od_deposit_name]").val( $("[name=od_name]").val() );
        $("#settle_bank").show();
    });

    $("#od_settle_iche,#od_settle_card,#od_settle_vbank,#od_settle_hp").bind("click", function() {
        $("#settle_bank").hide();
    });

    // 배송지선택
    $("input[name=ad_sel_addr]").on("click", function() {
        var addr = $(this).val().split(String.fromCharCode(30));

        if (addr[0] == "same") {
            if($(this).is(":checked"))
                gumae2baesong(true);
            else
                gumae2baesong(false);
        } else {
            if(addr[0] == "new") {
                for(i=0; i<10; i++) {
                    addr[i] = "";
                }
            }

            var f = document.forderform;
            f.od_b_name.value        = addr[0];
            f.od_b_tel.value         = addr[1];
            f.od_b_hp.value          = addr[2];
            f.od_b_zip1.value        = addr[3];
            f.od_b_zip2.value        = addr[4];
            f.od_b_addr1.value       = addr[5];
            f.od_b_addr2.value       = addr[6];
            f.od_b_addr3.value       = addr[7];
            f.od_b_addr_jibeon.value = addr[8];
            f.ad_subject.value       = addr[9];

            var zip1 = addr[3].replace(/[^0-9]/g, "");
            var zip2 = addr[4].replace(/[^0-9]/g, "");

            if(zip1 != "" && zip2 != "") {
                var code = String(zip1) + String(zip2);

                if(zipcode != code) {
                    zipcode = code;
                    calculate_sendcost(code);
                }
            }
        }
    });

    // 배송지목록
    $("#order_address").on("click", function() {
        var url = this.href;
        window.open(url, "win_address", "left=100,top=100,width=800,height=600,scrollbars=1");
        return false;
    });
});

function coupon_cancel($el)
{
    var $dup_sell_el = $el.find(".total_price");
    var $dup_price_el = $el.find("input[name^=cp_price]");
    var org_sell_price = $el.find("input[name^=it_price]").val();

    $dup_sell_el.text(number_format(String(org_sell_price)));
    $dup_price_el.val(0);
    $el.find("input[name^=cp_id]").val("");
}

function calculate_total_price()
{
    var $it_prc = $("input[name^=it_price]");
    var $cp_prc = $("input[name^=cp_price]");
    var tot_sell_price = sell_price = tot_cp_price = 0;
    var it_price, cp_price, it_notax;
    var tot_mny = comm_tax_mny = comm_vat_mny = comm_free_mny = tax_mny = vat_mny = 0;
    var send_cost = parseInt($("input[name=od_send_cost]").val());

    $it_prc.each(function(index) {
        it_price = parseInt($(this).val());
        cp_price = parseInt($cp_prc.eq(index).val());
        sell_price += it_price;
        tot_cp_price += cp_price;
    });

    tot_sell_price = sell_price - tot_cp_price + send_cost;

    $("#ct_tot_coupon").text(number_format(String(tot_cp_price))+" 원");
    $("#ct_tot_price").text(number_format(String(tot_sell_price)));

    $("input[name=good_mny]").val(tot_sell_price);
    $("input[name=od_price]").val(sell_price - tot_cp_price);
    $("input[name=item_coupon]").val(tot_cp_price);
    $("input[name=od_coupon]").val(0);
    $("input[name=od_send_coupon]").val(0);
    <?php if($oc_cnt > 0) { ?>
    $("input[name=od_cp_id]").val("");
    $("#od_cp_price").text(0);
    if($("#od_coupon_cancel").size()) {
        $("#od_coupon_btn").text("쿠폰적용");
        $("#od_coupon_cancel").remove();
    }
    <?php } ?>
    <?php if($sc_cnt > 0) { ?>
    $("input[name=sc_cp_id]").val("");
    $("#sc_cp_price").text(0);
    if($("#sc_coupon_cancel").size()) {
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();
    }
    <?php } ?>
    $("input[name=od_temp_point]").val(0);
    <?php if($temp_point > 0 && $is_member) { ?>
    calculate_temp_point();
    <?php } ?>
    calculate_order_price();
}

function calculate_order_price()
{
    var sell_price = parseInt($("input[name=od_price]").val());
    var send_cost = parseInt($("input[name=od_send_cost]").val());
    var send_cost2 = parseInt($("input[name=od_send_cost2]").val());
    var send_coupon = parseInt($("input[name=od_send_coupon]").val());
    var tot_price = sell_price + send_cost + send_cost2 - send_coupon;

    $("input[name=good_mny]").val(tot_price);
    $("#od_tot_price").text(number_format(String(tot_price)));
    $("#sndAmount").val(tot_price);
    <?php if($temp_point > 0 && $is_member) { ?>
    calculate_temp_point();
    <?php } ?>
}

function calculate_temp_point()
{
    var sell_price = parseInt($("input[name=od_price]").val());
    var mb_point = parseInt(<?php echo $member['mb_point']; ?>);
    var max_point = parseInt(<?php echo $default['de_settle_max_point']; ?>);
    var point_unit = parseInt(<?php echo $default['de_settle_point_unit']; ?>);
    var temp_point = max_point;

    if(temp_point > sell_price)
        temp_point = sell_price;

    if(temp_point > mb_point)
        temp_point = mb_point;

    temp_point = parseInt(temp_point / point_unit) * point_unit;

    $("#use_max_point").text("최대 "+number_format(String(temp_point))+"점");
    $("input[name=max_temp_point]").val(temp_point);
}

function calculate_sendcost(code)
{
    $.post(
        "./ordersendcost.php",
        { zipcode: code },
        function(data) {
            $("input[name=od_send_cost2]").val(data);
            $("#od_send_cost2").text(number_format(String(data)));

            calculate_order_price();
        }
    );
}

function calculate_tax()
{
    var $it_prc = $("input[name^=it_price]");
    var $cp_prc = $("input[name^=cp_price]");
    var sell_price = tot_cp_price = 0;
    var it_price, cp_price, it_notax;
    var tot_mny = comm_free_mny = tax_mny = vat_mny = 0;
    var send_cost = parseInt($("input[name=od_send_cost]").val());
    var send_cost2 = parseInt($("input[name=od_send_cost2]").val());
    var od_coupon = parseInt($("input[name=od_coupon]").val());
    var send_coupon = parseInt($("input[name=od_send_coupon]").val());
    var temp_point = 0;

    $it_prc.each(function(index) {
        it_price = parseInt($(this).val());
        cp_price = parseInt($cp_prc.eq(index).val());
        sell_price += it_price;
        tot_cp_price += cp_price;
        it_notax = $("input[name^=it_notax]").eq(index).val();
        if(it_notax == "1") {
            comm_free_mny += (it_price - cp_price);
        } else {
            tot_mny += (it_price - cp_price);
        }
    });

    if($("input[name=od_temp_point]").size())
        temp_point = parseInt($("input[name=od_temp_point]").val());

    tot_mny += (send_cost + send_cost2 - od_coupon - send_coupon - temp_point);
    if(tot_mny < 0) {
        comm_free_mny = comm_free_mny + tot_mny;
        tot_mny = 0;
    }

    tax_mny = Math.round(tot_mny / 1.1);
    vat_mny = tot_mny - tax_mny;
    $("input[name=comm_tax_mny]").val(tax_mny);
    $("input[name=comm_vat_mny]").val(vat_mny);
    $("input[name=comm_free_mny]").val(comm_free_mny);
}

function forderform_check(f)
{
    errmsg = "";
    errfld = "";
    var deffld = "";

    check_field(f.od_name, "주문하시는 분 이름을 입력하십시오.");
    if (typeof(f.od_pwd) != 'undefined')
    {
        clear_field(f.od_pwd);
        if( (f.od_pwd.value.length<3) || (f.od_pwd.value.search(/([^A-Za-z0-9]+)/)!=-1) )
            error_field(f.od_pwd, "회원이 아니신 경우 주문서 조회시 필요한 비밀번호를 3자리 이상 입력해 주십시오.");
    }
    check_field(f.od_tel, "주문하시는 분 전화번호를 입력하십시오.");
    check_field(f.od_addr1, "주소검색을 이용하여 주문하시는 분 주소를 입력하십시오.");
    //check_field(f.od_addr2, " 주문하시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_zip1, "");
    check_field(f.od_zip2, "");

    clear_field(f.od_email);
    if(f.od_email.value=='' || f.od_email.value.search(/(\S+)@(\S+)\.(\S+)/) == -1)
        error_field(f.od_email, "E-mail을 바르게 입력해 주십시오.");

    if (typeof(f.od_hope_date) != "undefined")
    {
        clear_field(f.od_hope_date);
        if (!f.od_hope_date.value)
            error_field(f.od_hope_date, "희망배송일을 선택하여 주십시오.");
    }

    check_field(f.od_b_name, "받으시는 분 이름을 입력하십시오.");
    check_field(f.od_b_tel, "받으시는 분 전화번호를 입력하십시오.");
    check_field(f.od_b_addr1, "주소검색을 이용하여 받으시는 분 주소를 입력하십시오.");
    //check_field(f.od_b_addr2, "받으시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_b_zip1, "");
    check_field(f.od_b_zip2, "");

    var od_settle_bank = document.getElementById("od_settle_bank");
    if (od_settle_bank) {
        if (od_settle_bank.checked) {
            check_field(f.od_bank_account, "계좌번호를 선택하세요.");
            check_field(f.od_deposit_name, "입금자명을 입력하세요.");
        }
    }

    // 배송비를 받지 않거나 더 받는 경우 아래식에 + 또는 - 로 대입
    f.od_send_cost.value = parseInt(f.od_send_cost.value);

    if (errmsg)
    {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    var settle_case = document.getElementsByName("od_settle_case");
    var settle_check = false;
    var settle_method = "";
    for (i=0; i<settle_case.length; i++)
    {
        if (settle_case[i].checked)
        {
            settle_check = true;
            settle_method = settle_case[i].value;
            break;
        }
    }
    if (!settle_check)
    {
        alert("결제방식을 선택하십시오.");
        return false;
    }

    var od_price = parseInt(f.od_price.value);
    var send_cost = parseInt(f.od_send_cost.value);
    var send_cost2 = parseInt(f.od_send_cost2.value);
    var send_coupon = parseInt(f.od_send_coupon.value);

    var max_point = 0;
    if (typeof(f.max_temp_point) != "undefined")
        max_point  = parseInt(f.max_temp_point.value);

    var temp_point = 0;
    if (typeof(f.od_temp_point) != "undefined") {
        if (f.od_temp_point.value)
        {
            var point_unit = parseInt(<?php echo $default['de_settle_point_unit']; ?>);
            temp_point = parseInt(f.od_temp_point.value);

            if (temp_point < 0) {
                alert("포인트를 0 이상 입력하세요.");
                f.od_temp_point.select();
                return false;
            }

            if (temp_point > od_price) {
                alert("상품 주문금액(배송비 제외) 보다 많이 포인트결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (temp_point > <?php echo (int)$member['mb_point']; ?>) {
                alert("회원님의 포인트보다 많이 결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (temp_point > max_point) {
                alert(max_point + "점 이상 결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (parseInt(parseInt(temp_point / point_unit) * point_unit) != temp_point) {
                alert("포인트를 "+String(point_unit)+"점 단위로 입력하세요.");
                f.od_temp_point.select();
                return false;
            }

            // pg 결제 금액에서 포인트 금액 차감
            if(settle_method != "무통장") {
                f.good_mny.value = od_price + send_cost + send_cost2 - send_coupon - temp_point;
            }
        }
    }

    var tot_price = od_price + send_cost + send_cost2 - send_coupon - temp_point;

    if (document.getElementById("od_settle_iche")) {
        if (document.getElementById("od_settle_iche").checked) {
            if (tot_price - temp_point < 150) {
                alert("계좌이체는 150원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("od_settle_card")) {
        if (document.getElementById("od_settle_card").checked) {
            if (tot_price - temp_point < 1000) {
                alert("신용카드는 1000원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("od_settle_hp")) {
        if (document.getElementById("od_settle_hp").checked) {
            if (tot_price - temp_point < 350) {
                alert("휴대폰은 350원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    <?php if($default['de_tax_flag_use']) { ?>
    calculate_tax();
    <?php } ?>

    // pay_method 설정
    <?php if($default['de_pg_service'] == 'kcp') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.pay_method.value = "010000000000";
            break;
        case "가상계좌":
            f.pay_method.value = "001000000000";
            break;
        case "휴대폰":
            f.pay_method.value = "000010000000";
            break;
        case "신용카드":
            f.pay_method.value = "100000000000";
            break;
        default:
            f.pay_method.value = "무통장";
            break;
    }
    <?php } else if($default['de_pg_service'] == 'lg') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0030";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0030";
            break;
        case "가상계좌":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0040";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0040";
            break;
        case "휴대폰":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0060";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0060";
            break;
        case "신용카드":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0010";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0010";
            break;
        default:
            f.LGD_CUSTOM_FIRSTPAY.value = "무통장";
            break;
    }
    <?php } ?>

    // 결제정보설정
    <?php if($default['de_pg_service'] == 'kcp') { ?>
    f.buyr_name.value = f.od_name.value;
    f.buyr_mail.value = f.od_email.value;
    f.buyr_tel1.value = f.od_tel.value;
    f.buyr_tel2.value = f.od_hp.value;
    f.rcvr_name.value = f.od_b_name.value;
    f.rcvr_tel1.value = f.od_b_tel.value;
    f.rcvr_tel2.value = f.od_b_hp.value;
    f.rcvr_mail.value = f.od_email.value;
    f.rcvr_zipx.value = f.od_b_zip1.value + f.od_b_zip2.value;
    f.rcvr_add1.value = f.od_b_addr1.value;
    f.rcvr_add2.value = f.od_b_addr2.value;

    if(f.pay_method.value != "무통장") {
	    
		$("#sndOrdername").val($("#od_name").val());
		$("#sndEmail").val($("#od_email").val());
		$("#sndMobile").val($("#od_hp").val());
	    _pay(document.forderform);
	    return false;
    } else {
        return true;
    }
    <?php } if($default['de_pg_service'] == 'lg') { ?>
    f.LGD_BUYER.value = f.od_name.value;
    f.LGD_BUYEREMAIL.value = f.od_email.value;
    f.LGD_BUYERPHONE.value = f.od_hp.value;
    f.LGD_AMOUNT.value = f.good_mny.value;
    f.LGD_RECEIVER.value = f.od_b_name.value;
    f.LGD_RECEIVERPHONE.value = f.od_b_hp.value;
    <?php if($default['de_escrow_use']) { ?>
    f.LGD_ESCROW_ZIPCODE.value = f.od_b_zip1.value + f.od_b_zip2.value;
    f.LGD_ESCROW_ADDRESS1.value = f.od_b_addr1.value;
    f.LGD_ESCROW_ADDRESS2.value = f.od_b_addr2.value;
    f.LGD_ESCROW_BUYERPHONE.value = f.od_hp.value;
    <?php } ?>
    <?php if($default['de_tax_flag_use']) { ?>
    f.LGD_TAXFREEAMOUNT.value = f.comm_free_mny.value;
    <?php } ?>

    if(f.LGD_CUSTOM_FIRSTPAY.value != "무통장") {
          Pay_Request("<?php echo $od_id; ?>", f.LGD_AMOUNT.value, f.LGD_TIMESTAMP.value);
    } else {
        f.submit();
    }
    <?php } ?>
}

// 구매자 정보와 동일합니다.
function gumae2baesong(checked) {
    var f = document.forderform;

    if(checked == true) {
        f.od_b_name.value = f.od_name.value;
        f.od_b_tel.value  = f.od_tel.value;
        f.od_b_hp.value   = f.od_hp.value;
        f.od_b_zip1.value = f.od_zip1.value;
        f.od_b_zip2.value = f.od_zip2.value;
        f.od_b_addr1.value = f.od_addr1.value;
        f.od_b_addr2.value = f.od_addr2.value;
        f.od_b_addr3.value = f.od_addr3.value;
        f.od_b_addr_jibeon.value = f.od_addr_jibeon.value;

        calculate_sendcost(String(f.od_b_zip1.value) + String(f.od_b_zip2.value));
    } else {
        f.od_b_name.value = "";
        f.od_b_tel.value  = "";
        f.od_b_hp.value   = "";
        f.od_b_zip1.value = "";
        f.od_b_zip2.value = "";
        f.od_b_addr1.value = "";
        f.od_b_addr2.value = "";
        f.od_b_addr3.value = "";
        f.od_b_addr_jibeon.value = "";
    }
}


<?php if ($default['de_hope_date_use']) { ?>
$(function(){
    $("#od_hope_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", minDate: "+<?php echo (int)$default['de_hope_date_after']; ?>d;", maxDate: "+<?php echo (int)$default['de_hope_date_after'] + 6; ?>d;" });
});
<?php } ?>
</script>

<?php
include_once('./_tail.php');

// 결제대행사별 코드 include (스크립트 실행)
require_once('./'.$default['de_pg_service'].'/orderform.5.php');
?>