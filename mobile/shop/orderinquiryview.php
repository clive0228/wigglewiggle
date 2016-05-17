<?php
include_once('./_common.php');

// 불법접속을 할 수 없도록 세션에 아무값이나 저장하여 hidden 으로 넘겨서 다음 페이지에서 비교함
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

if (!$is_member) {
    if (get_session('ss_orderview_uid') != $_GET['uid'])
        alert("직접 링크로는 주문서 조회가 불가합니다.\\n\\n주문조회 화면을 통하여 조회하시기 바랍니다.", G5_SHOP_URL);
}

$sql = "select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ";
$od = sql_fetch($sql);
if (!$od['od_id'] || (!$is_member && md5($od['od_id'].$od['od_time'].$od['od_ip']) != get_session('ss_orderview_uid'))) {
    alert("조회하실 주문서가 없습니다.", G5_SHOP_URL);
}
$ct = sql_fetch("select * from {$g5['g5_shop_cart_table']} where od_id = '$od_id' ");

// 결제방법
$settle_case = $od['od_settle_case'];

$g5['title'] = '주문상세내역';
include_once(G5_MSHOP_PATH.'/_head.php');

// LG 현금영수증 JS
if($od['od_pg'] == 'lg') {
    if($default['de_card_test']) {
    echo '<script language="JavaScript" src="http://pgweb.uplus.co.kr:7085/WEB_SERVER/js/receipt_link.js"></script>'.PHP_EOL;
    } else {
        echo '<script language="JavaScript" src="http://pgweb.uplus.co.kr/WEB_SERVER/js/receipt_link.js"></script>'.PHP_EOL;
    }
}
?>

<script language="javascript">

	function _pay(_frm) 
	{
		// sndReply는 kspay_wh_rcv.php (결제승인 후 결과값들을 본창의 KSPayWeb Form에 넘겨주는 페이지)의 절대경로를 넣어줍니다. 
 		_frm.sndReply.value           = getLocalUrl("../mobile/shop/cardUpdate.php") ;

		var agent = navigator.userAgent;
		var midx		= agent.indexOf("MSIE");
		var out_size	= (midx != -1 && agent.charAt(midx+5) < '7');
		_frm.action ='http://kspay.ksnet.to/store/mb2/KSPayPWeb_utf8.jsp';
		_frm.submit();
    }

	function getLocalUrl(mypage) 
	{ 
		var myloc = location.href; 
		return myloc.substring(0, myloc.lastIndexOf('/')) + '/' + mypage;
	} 
	
</script>

<div id="sod_fin">

    <div id="sod_fin_no">주문번호 <strong><?php echo $od_id; ?></strong></div>
    
    <?php if($od[od_settle_case] =="신용카드" && $od[od_misu] > 0) { //카드결제 인데, 미결제야!! ?>
		<form name=authFrmFrame method=post>
			<div style="padding:10px;background-color:#ee2d38;margin-bottom: 5px;color:#fff;">
				본 주문의 결제 수단을 '<u>신용카드</u>'로 선택하셨지만, 아직 정상적으로 결제가 완료되지 않은 주문입니다. 아래의 버튼을 누르시면 신용카드 결제가 가능합니다.
			</div>
			<div style="padding:10px;background-color:#ee2d38;margin-bottom: 25px;color:#fff;text-align: center" onClick="javascript:_pay(document.authFrmFrame);">
				신용카드로 결제하시려면 <u><b>여기</b></u>를 클릭해주세요.
			</div>
			
		    <input type='hidden' id="sndPaymethod" name='sndPaymethod' value="1000000000" size='15' maxlength='10'>
		    <input type='hidden' id="sndStoreid" name='sndStoreid' value='2001105758' size='15' maxlength='10'>
		    <input type='hidden' id="1111111111" name='1111111111' value='2999199999' size='15' maxlength='10'>
		    
		    <input type='hidden' id="sndOrdernumber" value="<?=$od[od_id]?>" name='sndOrdernumber' size='30'>
			<input type='hidden' id="sndGoodname" value="<?=$ct[it_name]?>" name='sndGoodname' size='30'>
			<input type='hidden' id="sndAmount" name='sndAmount' value="<?=$od[od_misu]?>"  size='15' maxlength='9'>
			<input type='hidden' id="sndOrdername" value="<?=$od[od_name]?>" name='sndOrdername' size='30'>
			<input type='hidden' id="sndEmail" value="<?=$od[od_email]?>" name='sndEmail' size='30'>
			<input type='hidden' id="sndMobile" value="<?=$od[od_hp]?>" name='sndMobile' size='12' maxlength='12'>
			<!----------------------------------------------- <Part 2. 추가설정항목(메뉴얼참조)>  ----------------------------------------------->
		
			<!-- 0. 공통 환경설정 -->
			<input type=hidden	name=sndReply value="">
			<input type=hidden  name=sndGoodType value="1"> 	<!-- 상품유형: 실물(1),디지털(2) -->
			
			<input type=hidden name=sndStoreName       	value="주식회사 아트쉐어">   <!--회사명을 한글로 넣어주세요(최대20byte)-->
			<input type=hidden name=sndStoreNameEng    	value="artshare">   <!--회사명을 영어로 넣어주세요(최대20byte)-->
			<input type=hidden name=sndStoreDomain     	value="http://artshare.kr">   <!-- 회사 도메인을 http://를 포함해서 넣어주세요-->
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
	<?php } ?>
	<!--카드결제 미결제시 뜨는 거 끝-->
	
	
	
	
    <section class="sod_fin_list">
        <h2>주문하신 상품</h2>

        <?php
        $st_count1 = $st_count2 = 0;
        $custom_cancel = false;

        $sql = " select it_id, it_name, cp_price, ct_send_cost, it_sc_type
                    from {$g5['g5_shop_cart_table']}
                    where od_id = '$od_id'
                    group by it_id
                    order by ct_id ";
        $result = sql_query($sql);
        ?>
        <ul id="sod_list_inq" class="sod_list">
            <?php
            for($i=0; $row=sql_fetch_array($result); $i++) {
                $image_width = 50;
                $image_height = 50;
                $image = get_it_image($row['it_id'], 50, 50, '', '', $row['it_name']);

                // 옵션항목
                $sql = " select ct_id, it_name, ct_option, ct_qty, ct_price, ct_point, ct_status, io_type, io_price
                            from {$g5['g5_shop_cart_table']}
                            where od_id = '$od_id'
                              and it_id = '{$row['it_id']}'
                            order by io_type asc, ct_id asc ";
                $res = sql_query($sql);

                // 합계금액 계산
                $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                                SUM(ct_qty) as qty
                            from {$g5['g5_shop_cart_table']}
                            where it_id = '{$row['it_id']}'
                              and od_id = '$od_id' ";
                $sum = sql_fetch($sql);

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
                    $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $od_id);

                    if($sendcost == 0)
                        $ct_send_cost = '무료';
                }
            ?>
            <li class="sod_li">
                <div class="li_name">
                    <a href="./item.php?it_id=<?php echo $row['it_id']; ?>"><strong><?php echo $row['it_name']; ?></strong></a>
                </div>
            <?php
                for($k=0; $opt=sql_fetch_array($res); $k++) {
                    if($opt['io_type'])
                        $opt_price = $opt['io_price'];
                    else
                        $opt_price = $opt['ct_price'] + $opt['io_price'];

                    $sell_price = $opt_price * $opt['ct_qty'];
                    $point = $opt['ct_point'] * $opt['ct_qty'];
            ?>
                <div class="li_opt"><?php echo $opt['ct_option']; ?></div>
                <div class="li_prqty">
                    <span class="prqty_price"><span>판매가 </span><?php echo number_format($opt_price); ?></span>
                    <span class="prqty_qty"><span>수량 </span><?php echo number_format($opt['ct_qty']); ?></span>
                    <span class="prqty_sc"><span>배송비 </span><?php echo $ct_send_cost; ?></span>
                    <span class="prqty_stat"><span>상태 </span><?php echo $opt['ct_status']; ?></span>
                </div>
                <div class="li_total" style="padding-left:<?php echo $image_width + 10; ?>px;height:auto !important;height:<?php echo $image_height; ?>px;min-height:<?php echo $image_height; ?>px">
                    <a href="./item.php?it_id=<?php echo $row['it_id']; ?>" class="total_img"><?php echo $image; ?></a>
                    <span class="total_price total_span"><span>주문금액 </span><?php echo number_format($sell_price); ?></span>
                    <span class="total_point total_span"><span>적립포인트 </span><?php echo number_format($point); ?></span>
                </div>
            <?php
                    $tot_point       += $point;

                    $st_count1++;
                    if($opt['ct_status'] == '주문')
                        $st_count2++;
                }
            ?>

            </li>
            <?php
            }

            // 주문 상품의 상태가 모두 주문이면 고객 취소 가능
            if($st_count1 > 0 && $st_count1 == $st_count2)
                $custom_cancel = true;
            ?>
        </ul>

        <div id="sod_sts_wrap">
            <span class="sound_only">상품 상태 설명</span>
            <button type="button" id="sod_sts_explan_open" class="btn_frmline">상태설명보기</button>
            <div id="sod_sts_explan">
                <dl id="sod_fin_legend">
                    <dt>주문</dt>
                    <dd>주문이 접수되었습니다.</dd>
                    <dt>입금</dt>
                    <dd>입금(결제)이 완료 되었습니다.</dd>
                    <dt>준비</dt>
                    <dd>상품 준비 중입니다.</dd>
                    <dt>배송</dt>
                    <dd>상품 배송 중입니다.</dd>
                    <dt>완료</dt>
                    <dd>상품 배송이 완료 되었습니다.</dd>
                </dl>
                <button type="button" id="sod_sts_explan_close" class="btn_frmline">상태설명닫기</button>
            </div>
        </div>

        <?php
        // 총계 = 주문상품금액합계 + 배송비 - 상품할인 - 결제할인 - 배송비할인
        $tot_price = $od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2']
                        - $od['od_cart_coupon'] - $od['od_coupon'] - $od['od_send_coupon']
                        - $od['od_cancel_price'];
        ?>

        <dl id="sod_bsk_tot">
            <dt class="sod_bsk_dvr">주문총액</dt>
            <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_cart_price']); ?> 원</strong></dd>

            <?php if($od['od_cart_coupon'] > 0) { ?>
            <dt class="sod_bsk_dvr">상품할인</dt>
            <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_cart_coupon']); ?> 원</strong></dd>
            <?php } ?>

            <?php if($od['od_coupon'] > 0) { ?>
            <dt class="sod_bsk_dvr">결제할인</dt>
            <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_coupon']); ?> 원</strong></dd>
            <?php } ?>

            <?php if ($od['od_send_cost'] > 0) { ?>
            <dt class="sod_bsk_dvr">배송비</dt>
            <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_send_cost']); ?> 원</strong></dd>
            <?php } ?>

            <?php if($od['od_send_coupon'] > 0) { ?>
            <dt class="sod_bsk_dvr">배송비할인</dt>
            <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_send_coupon']); ?> 원</strong></dd>
            <?php } ?>

            <?php if ($od['od_send_cost2'] > 0) { ?>
            <dt class="sod_bsk_dvr">추가배송비</dt>
            <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_send_cost2']); ?> 원</strong></dd>
            <?php } ?>

            <?php if ($od['od_cancel_price'] > 0) { ?>
            <dt class="sod_bsk_dvr">취소금액</dt>
            <dd class="sod_bsk_dvr"><strong><?php echo number_format($od['od_cancel_price']); ?> 원</strong></dd>
            <?php } ?>

            <dt class="sod_bsk_cnt">총계</dt>
            <dd class="sod_bsk_cnt"><strong><?php echo number_format($tot_price); ?> 원</strong></dd>

            <dt class="sod_bsk_point">포인트</dt>
            <dd class="sod_bsk_point"><strong><?php echo number_format($tot_point); ?> 점</strong></dd>
        </dl>
    </section>

    <div id="sod_fin_view">
        <h2>결제/배송 정보</h2>
        <?php
        $receipt_price = $od['od_receipt_price']
                       + $od['od_receipt_point'];
        $cancel_price = $od['od_cancel_price'];

        $misu = true;
        $misu_price = $tot_price - $receipt_price - $cancel_price;

        if ($misu_price == 0 && ($od['od_cart_price'] > $od['od_cancel_price'])) {
            $wanbul = " (완불)";
            $misu = false; // 미수금 없음
        }
        else
        {
            $wanbul = display_price($receipt_price);
        }

        // 결제정보처리
        if($od['od_receipt_price'] > 0)
            $od_receipt_price = display_price($od['od_receipt_price']);
        else
            $od_receipt_price = '아직 입금되지 않았거나 입금정보를 입력하지 못하였습니다.';

        $app_no_subj = '';
        $disp_bank = true;
        $disp_receipt = false;
        if($od['od_settle_case'] == '신용카드') {
            $app_no_subj = '승인번호';
            $app_no = $od['od_app_no'];
            $disp_bank = false;
            $disp_receipt = true;
        } else if($od['od_settle_case'] == '휴대폰') {
            $app_no_subj = '휴대폰번호';
            $app_no = $od['od_bank_account'];
            $disp_bank = false;
            $disp_receipt = true;
        } else if($od['od_settle_case'] == '가상계좌' || $od['od_settle_case'] == '계좌이체') {
            $app_no_subj = '거래번호';
            $app_no = $od['od_tno'];
        }
        ?>

        <section id="sod_fin_pay">
            <h3>결제정보</h3>

            <div class="tbl_head01 tbl_wrap">
                <table>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row">주문번호</th>
                    <td><?php echo $od_id; ?></td>
                </tr>
                <tr>
                    <th scope="row">주문일시</th>
                    <td><?php echo $od['od_time']; ?></td>
                </tr>

                <tr>
                    <th scope="row">결제방식</th>
                    <td><?php echo $od['od_settle_case']; ?></td>
                </tr>
                <tr>
                    <th scope="row">결제금액</th>
                    <td><?php echo $od_receipt_price; ?></td>
                </tr>
                <?php
                if($od['od_receipt_price'] > 0)
                {
                ?>
                <tr>
                    <th scope="row">결제일시</th>
                    <td><?php echo $od['od_receipt_time']; ?></td>
                </tr>
                <?php
                }

                // 승인번호, 휴대폰번호, 거래번호
                if($app_no_subj && $od['od_receipt_price'] > 0)
                {
                ?>
                <tr>
                    <th scope="row"><?php echo $app_no_subj; ?></th>
                    <td><?php echo $app_no; ?></td>
                </tr>
                <?php
                }

                // 계좌정보
                if($disp_bank)
                {
                ?>
                <tr>
                    <th scope="row">입금자명</th>
                    <td><?php echo get_text($od['od_deposit_name']); ?></td>
                </tr>
                <tr>
                    <th scope="row">입금계좌</th>
                    <td><?php echo get_text($od['od_bank_account']); ?></td>
                </tr>
                <?php
                }

                if($disp_receipt) {
                ?>
                <tr>
                    <th scope="row">영수증</th>
                    <td>
                        <?php
                        if($od['od_settle_case'] == '신용카드')
                        {
                            if($od['od_pg'] == 'lg') {
                                require_once G5_SHOP_PATH.'/settle_lg.inc.php';
                                $LGD_TID      = $od['od_tno'];
                                $LGD_MERTKEY  = $config['cf_lg_mert_key'];
                                $LGD_HASHDATA = md5($LGD_MID.$LGD_TID.$LGD_MERTKEY);

                                $card_receipt_script = 'showReceiptByTID(\''.$LGD_MID.'\', \''.$LGD_TID.'\', \''.$LGD_HASHDATA.'\');';
                            } else {
                                $card_receipt_script = 'window.open(\''.G5_BILL_RECEIPT_URL.'card_bill&tno='.$od['od_tno'].'&order_no='.$od['od_id'].'&trade_mony='.$od['od_receipt_price'].'\', \'winreceipt\', \'width=470,height=815,scrollbars=yes,resizable=yes\');';
                            }
                        ?>영수증 출력은 PC에서 진행해주세요.
                        <?php
                        }
                        ?>
                    <td>
                    </td>
                </tr>
                <?php
                }

                if ($od['od_receipt_point'] > 0)
                {
                ?>
                <tr>
                    <th scope="row">포인트사용</th>
                    <td><?php echo display_point($od['od_receipt_point']); ?></td>
                </tr>

                <?php
                }

                if ($od['od_refund_price'] > 0)
                {
                ?>
                <tr>
                    <th scope="row">환불 금액</th>
                    <td><?php echo display_price($od['od_refund_price']); ?></td>
                </tr>
                <?php
                }

                // 현금영수증 발급을 사용하는 경우에만
                if ($default['de_taxsave_use']) {
                    // 미수금이 없고 현금일 경우에만 현금영수증을 발급 할 수 있습니다.
                    if ($misu_price == 0 && $od['od_receipt_price'] && ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '계좌이체' || $od['od_settle_case'] == '가상계좌')) {
                ?>
                <tr>
                    <th scope="row">현금영수증</th>
                    <td>
                    <?php
                    if ($od['od_cash'])
                    {
                        if($od['od_pg'] == 'lg') {
                            require_once G5_SHOP_PATH.'/settle_lg.inc.php';

                            switch($od['od_settle_case']) {
                                case '계좌이체':
                                    $trade_type = 'BANK';
                                    break;
                                case '가상계좌':
                                    $trade_type = 'CAS';
                                    break;
                                default:
                                    $trade_type = 'CR';
                                    break;
                            }
                            $cash_receipt_script = 'javascript:showCashReceipts(\''.$LGD_MID.'\',\''.$od['od_id'].'\',\''.$od['od_casseqno'].'\',\''.$trade_type.'\',\''.$CST_PLATFORM.'\');';
                        } else {
                            require_once G5_SHOP_PATH.'/settle_kcp.inc.php';

                            $cash = unserialize($od['od_cash_info']);
                            $cash_receipt_script = 'window.open(\''.G5_CASH_RECEIPT_URL.$default['de_kcp_mid'].'&orderid='.$od_id.'&bill_yn=Y&authno='.$cash['receipt_no'].'\', \'taxsave_receipt\', \'width=360,height=647,scrollbars=0,menus=0\');';
                        }
                    ?>
                        <a href="javascript:;" onclick="<?php echo $cash_receipt_script; ?>">현금영수증 확인하기</a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a href="javascript:;" onclick="window.open('<?php echo G5_SHOP_URL; ?>/taxsave.php?od_id=<?php echo $od_id; ?>', 'taxsave', 'width=550,height=400,scrollbars=1,menus=0');">현금영수증을 발급하시려면 클릭하십시오.</a>
                    <?php } ?>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
                </tbody>
                </table>
            </div>
        </section>

        <section id="sod_fin_orderer">
            <h3>주문하신 분</h3>

            <div class="tbl_head01 tbl_wrap">
                <table>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row">이 름</th>
                    <td><?php echo get_text($od['od_name']); ?></td>
                </tr>
                <tr>
                    <th scope="row">전화번호</th>
                    <td><?php echo get_text($od['od_tel']); ?></td>
                </tr>
                <tr>
                    <th scope="row">핸드폰</th>
                    <td><?php echo get_text($od['od_hp']); ?></td>
                </tr>
                <tr>
                    <th scope="row">주 소</th>
                    <td><?php echo get_text(sprintf("(%s-%s)", $od['od_zip1'], $od['od_zip2']).' '.print_address($od['od_addr1'], $od['od_addr2'], $od['od_addr3'], $od['od_addr_jibeon'])); ?></td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td><?php echo get_text($od['od_email']); ?></td>
                </tr>
                </tbody>
                </table>
            </div>

        </section>

        <section id="sod_fin_receiver">
            <h3>받으시는 분</h3>

            <div class="tbl_head01 tbl_wrap">
                <table>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row">이 름</th>
                    <td><?php echo get_text($od['od_b_name']); ?></td>
                </tr>
                <tr>
                    <th scope="row">전화번호</th>
                    <td><?php echo get_text($od['od_b_tel']); ?></td>
                </tr>
                <tr>
                    <th scope="row">핸드폰</th>
                    <td><?php echo get_text($od['od_b_hp']); ?></td>
                </tr>
                <tr>
                    <th scope="row">주 소</th>
                    <td><?php echo get_text(sprintf("(%s-%s)", $od['od_b_zip1'], $od['od_b_zip2']).' '.print_address($od['od_b_addr1'], $od['od_b_addr2'], $od['od_b_addr3'], $od['od_b_addr_jibeon'])); ?></td>
                </tr>
                <?php
                // 희망배송일을 사용한다면
                if ($default['de_hope_date_use'])
                {
                ?>
                <tr>
                    <th scope="row">희망배송일</th>
                    <td><?php echo substr($od['od_hope_date'],0,10).' ('.get_yoil($od['od_hope_date']).')' ;?></td>
                </tr>
                <?php }
                if ($od['od_memo'])
                {
                ?>
                <tr>
                    <th scope="row">전하실 말씀</th>
                    <td><?php echo conv_content($od['od_memo'], 0); ?></td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
            </div>
        </section>

        <section id="sod_fin_dvr">
            <h3>배송정보</h3>

            <div class="tbl_head01 tbl_wrap">
                <table>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <?php
                if ($od['od_invoice'] && $od['od_delivery_company'])
                {
                ?>
                <tr>
                    <th scope="row">배송회사</th>
                    <td><?php echo $od['od_delivery_company']; ?> <?php echo get_delivery_inquiry($od['od_delivery_company'], $od['od_invoice'], 'dvr_link'); ?></td>
                </tr>
                <tr>
                    <th scope="row">운송장번호</th>
                    <td><?php echo $od['od_invoice']; ?></td>
                </tr>
                <tr>
                    <th scope="row">배송일시</th>
                    <td><?php echo $od['od_invoice_time']; ?></td>
                </tr>
                <?php
                }
                else
                {
                ?>
                <tr>
                    <td class="empty_table">아직 배송하지 않았거나 배송정보를 입력하지 못하였습니다.</td>
                </tr>
                <?php
                }
                ?>
                </tbody>
                </table>
            </div>
        </section>
    </div>

    <section id="sod_fin_tot">
        <h2>결제합계</h2>

        <ul>
            <li>
                총 구매액
                <strong><?php echo display_price($tot_price); ?></strong>
            </li>
            <?php
            if ($misu_price > 0) {
            echo '<li>';
            echo '미결제액'.PHP_EOL;
            echo '<strong>'.display_price($misu_price).'</strong>';
            echo '</li>';
            }
            ?>
            <li id="alrdy">
                결제액
                <strong><?php echo $wanbul; ?></strong>
            </li>
        </ul>
    </section>

    <section id="sod_fin_cancel">
        <h2>주문취소</h2>
        <?php
        // 취소한 내역이 없다면
        if ($cancel_price == 0) {
            if ($custom_cancel) {
        ?>
        <button type="button" onclick="document.getElementById('sod_fin_cancelfrm').style.display='block';">주문 취소하기</button>

        <div id="sod_fin_cancelfrm">
            <form method="post" action="<?php echo G5_SHOP_URL; ?>/orderinquirycancel.php" onsubmit="return fcancel_check(this);">
            <input type="hidden" name="od_id"  value="<?php echo $od['od_id']; ?>">
            <input type="hidden" name="token"  value="<?php echo $token; ?>">

            <label for="cancel_memo">취소사유</label>
            <input type="text" name="cancel_memo" id="cancel_memo" required class="frm_input required"maxlength="100">
            <input type="submit" value="확인" class="btn_frmline">

            </form>
        </div>
        <?php
            }
        } else {
        ?>
        <p>주문 취소, 반품, 품절된 내역이 있습니다.</p>
        <?php } ?>
    </section>

     <?php if ($od['od_settle_case'] == '가상계좌' && $od['od_misu'] > 0 && $default['de_card_test'] && $is_admin && $od['od_pg'] == 'kcp') {
    preg_match("/\s{1}([^\s]+)\s?/", $od['od_bank_account'], $matchs);
    $deposit_no = trim($matchs[1]);
    ?>
    <p>관리자가 가상계좌 테스트를 한 경우에만 보입니다.</p>
    <div class="tbl_frm01 tbl_wrap">
        <form method="post" action="http://devadmin.kcp.co.kr/Modules/Noti/TEST_Vcnt_Noti_Proc.jsp" target="_blank">
        <table>
        <caption>모의입금처리</caption>
        <colgroup>
            <col class="grid_3">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="col"><label for="e_trade_no">KCP 거래번호</label></th>
            <td><input type="text" name="e_trade_no" value="<?php echo $od['od_tno']; ?>"></td>
        </tr>
        <tr>
            <th scope="col"><label for="deposit_no">입금계좌</label></th>
            <td><input type="text" name="deposit_no" value="<?php echo $deposit_no; ?>"></td>
        </tr>
        <tr>
            <th scope="col"><label for="req_name">입금자명</label></th>
            <td><input type="text" name="req_name" value="<?php echo $od['od_deposit_name']; ?>"></td>
        </tr>
        <tr>
            <th scope="col"><label for="noti_url">입금통보 URL</label></th>
            <td><input type="text" name="noti_url" value="<?php echo G5_SHOP_URL; ?>/settle_kcp_common.php"></td>
        </tr>
        </tbody>
        </table>
        <div id="sod_fin_test" class="btn_confirm">
            <input type="submit" value="입금통보 테스트" class="btn_submit">
        </div>
        </form>
    </div>
    <?php } ?>

</div>

<script>
$(function() {
    $("#sod_sts_explan_open").on("click", function() {
        var $explan = $("#sod_sts_explan");
        if($explan.is(":animated"))
            return false;

        if($explan.is(":visible")) {
            $explan.slideUp(200);
            $("#sod_sts_explan_open").text("상태설명보기");
        } else {
            $explan.slideDown(200);
            $("#sod_sts_explan_open").text("상태설명닫기");
        }
    });

    $("#sod_sts_explan_close").on("click", function() {
        var $explan = $("#sod_sts_explan");
        if($explan.is(":animated"))
            return false;

        $explan.slideUp(200);
        $("#sod_sts_explan_open").text("상태설명보기");
    });
});

function fcancel_check(f)
{
    if(!confirm("주문을 정말 취소하시겠습니까?"))
        return false;

    var memo = f.cancel_memo.value;
    if(memo == "") {
        alert("취소사유를 입력해 주십시오.");
        return false;
    }

    return true;
}
</script>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>