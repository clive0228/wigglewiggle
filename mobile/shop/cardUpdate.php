<?php
	include_once('./_common.php');
	
	
	include "./KSPayWebHost.inc";
	$rcid       = $_POST["reCommConId"];
	$rctype     = $_POST["reCommType"];
	$rhash      = $_POST["reHash"];
	
	// rcid 없으면 결제를 끝까지 진행하지 않고 중간에 결제취소 
	$ipg = new KSPayWebHost($rcid, null);

	$authyn		= "";
	$trno		= "";
	$trddt		= "";
	$trdtm		= "";
	$amt		= "";
	$authno		= "";
	$msg1		= "";
	$msg2		= "";
	$ordno		= "";
	$isscd		= "";
	$aqucd		= "";
	$temp_v		= "";
	$result		= "";

	$resultcd =  "";

	if ($ipg->send_msg("1"))
	{
		$authyn	 = $ipg->getValue("authyn");
		$trno	 = $ipg->getValue("trno"  );
		$trddt	 = $ipg->getValue("trddt" );
		$trdtm	 = $ipg->getValue("trdtm" );
		$amt	 = $ipg->getValue("amt"   );
		$authno	 = $ipg->getValue("authno");
		$msg1	 = $ipg->getValue("msg1"  );
		$msg1 = iconv("euc-kr","utf-8",$msg1 );		
		$msg2	 = $ipg->getValue("msg2"  );
		$msg2 = iconv("euc-kr","utf-8",$msg2 );		
		$ordno	 = $ipg->getValue("ordno" );
		$isscd	 = $ipg->getValue("isscd" );
		$aqucd	 = $ipg->getValue("aqucd" );
		//$temp_v	 = $ipg->getValue("temp_v");
		$result	 = $ipg->getValue("result");

		if (!empty($authyn) && 1 == strlen($authyn))
		{
			if ($authyn == "O")
			{
				$resultcd = "0000";
			}else
			{
				$resultcd = trim($authno);
			}

			$ipg->send_msg("3");
		}
	}
	
	
	$od_id = $ordno;
	$sql = "select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ";
	$od = sql_fetch($sql);
	
	
	if($resultcd != "0000"){
		
		// orderview 에서 사용하기 위해 session에 넣고
		$uid = md5($od_id.G5_TIME_YMDHIS.$REMOTE_ADDR);
		set_session('ss_orderview_uid', $uid);
		if($od_id)
			alert("죄송합니다. 결제가 실패하였습니다. 다시 시도해주세요. 에러코드 : $resultcd",G5_SHOP_URL.'/orderinquiryview.php?od_id='.$od_id.'&amp;uid='.$uid);
		else
			alert("죄송합니다. 결제가 실패하였습니다. 다시 시도해주세요.",G5_SHOP_URL.'/mypage.php');
	}
	if(!$od[od_id]){
		// orderview 에서 사용하기 위해 session에 넣고
		$uid = md5($od_id.G5_TIME_YMDHIS.$REMOTE_ADDR);
		set_session('ss_orderview_uid', $uid);
		alert("심각한 오류입니다. 결제는 정상적으로 되었지만, 주문한 상품이 존재하지 않습니다. 꼭 관리자에게 문의주세요!!!",G5_SHOP_URL.'/orderinquiryview.php?od_id='.$od_id.'&amp;uid='.$uid);
	}





    $od_tno             = $trno;
    $od_app_no          = $authno;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $trddt.$trdtm);
    $od_bank_account    = $msg1;
    $od_receipt_price = $amt;
    $od_misu            = $od[od_misu] - $amt;
        
    $sql = " update {$g5['g5_shop_order_table']}
        set 
            od_receipt_price  = '$od_receipt_price',
            od_bank_account   = '$od_bank_account',
            od_receipt_time   = '$od_receipt_time',
            od_misu           = '$od_misu',
            od_tno            = '$od_tno',
            od_app_no         = '$od_app_no',
            od_status         = '입금'
    where od_id='$ordno'";
	
	$result = sql_query($sql, false);


	$sql = "update {$g5['g5_shop_cart_table']}
	           set ct_status = '입금'
	         where od_id = '$ordno'";
	$result = sql_query($sql, false);


	// orderview 에서 사용하기 위해 session에 넣고
	$uid = md5($od_id.G5_TIME_YMDHIS.$REMOTE_ADDR);
	set_session('ss_orderview_uid', $uid);
	
	
	
// SMS BEGIN --------------------------------------------------------
// 주문고객과 쇼핑몰관리자에게 SMS 전송
if($config['cf_sms_use'] && ($default['de_sms_use4'])) {
    $is_sms_send = false;

    // 충전식일 경우 잔액이 있는지 체크
    if($config['cf_icode_id'] && $config['cf_icode_pw']) {
        $userinfo = get_icode_userinfo($config['cf_icode_id'], $config['cf_icode_pw']);

        if($userinfo['code'] == 0) {
            if($userinfo['payment'] == 'C') { // 정액제
                $is_sms_send = true;
            } else {
                $minimum_coin = 100;
                if(defined('G5_ICODE_COIN'))
                    $minimum_coin = intval(G5_ICODE_COIN);

                if((int)$userinfo['coin'] >= $minimum_coin)
                    $is_sms_send = true;
            }
        }
    }

    if($is_sms_send) {
        $sms_contents = array($default['de_sms_cont4']);
        $recv_numbers = array($od[od_hp], $default['de_sms_hp']);
        $send_numbers = array($default['de_admin_company_tel'], $od[od_hp]);

        include_once(G5_LIB_PATH.'/icode.sms.lib.php');

        $SMS = new SMS; // SMS 연결
        $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
        $sms_count = 0;

        for($s=0; $s<count($sms_contents); $s++) {
            $sms_content = $sms_contents[$s];
            $recv_number = preg_replace("/[^0-9]/", "", $recv_numbers[$s]);
            $send_number = preg_replace("/[^0-9]/", "", $send_numbers[$s]);

            $sms_content = str_replace("{이름}", $od[od_name], $sms_content);
            $sms_content = str_replace("{보낸분}", $od[od_name], $sms_content);
            $sms_content = str_replace("{받는분}", $od[od_b_name], $sms_content);
            $sms_content = str_replace("{입금액}", number_format($amt), $sms_content);
            $sms_content = str_replace("{주문번호}", $od[od_id], $sms_content);
            $sms_content = str_replace("{주문금액}", number_format($amt), $sms_content);
            $sms_content = str_replace("{회원아이디}", $member['mb_id'], $sms_content);
            $sms_content = str_replace("{회사명}", $default['de_admin_company_name'], $sms_content);

            $idx = 'de_sms_use'.($s + 4);

            if($default[$idx] && $recv_number) {
                $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
                $sms_count++;
            }
        }


        if($sms_count > 0)
            $SMS->Send();
    }
}
// SMS END   --------------------------------------------------------


	    
	    
	goto_url(G5_SHOP_URL.'/orderinquiryview.php?od_id='.$od_id.'&amp;uid='.$uid);
?>
