<?php
$pageId = "cart";
include_once('./_common.php');

// cart id 설정
set_cart_id($sw_direct);

$s_cart_id = get_session('ss_cart_id');
// 선택필드 초기화
$sql = " update {$g5['g5_shop_cart_table']} set ct_select = '0' where od_id = '$s_cart_id' ";
sql_query($sql);

$cart_action_url = G5_SHOP_URL.'/cartupdate.php';

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/cart.php');
    return;
}

$g5['title'] = '장바구니';
include_once('./_head.php');
?>

<!-- 장바구니 시작 { -->
<script src="<?php echo G5_JS_URL; ?>/shop.js"></script>
<div id="sod_bsk">
    <form name="frmcartlist" id="sod_bsk_list" method="post" action="<?php echo $cart_action_url; ?>">
    <div class="tbl_head01 tbl_wrap">
        <table>
        <thead>
        <tr>
            <td colspan="9" class="bottomLineRed2px">
	            <div style="padding:17px 0 0 5px;float:left">
		            <span class="txts t3" style="background-position-y:-240px">제목</span>
				</div>
			</td>
        </tr>
        <tr>
            <th scope="col">
                <label for="ct_all" class="sound_only">상품 전체</label>
                <input type="checkbox" name="ct_all" value="1" id="ct_all" checked="checked">
            </th>
            <th scope="col"><span class="txts"style="width:43px;background-position: 0 -340px;">상품코드</span></th>
            <th scope="col" colspan="2"><span class="txts"style="width:43px;background-position: 0 -360px;">상품정보</span></th>
            <th scope="col"><span class="txts"style="width:35px;background-position: 0 -380px;">판매가</span></th>
            <th scope="col"><span class="txts"style="width:35px;background-position: 0 -400px;">총 수량</span></th>
            <th scope="col"><span class="txts"style="width:43px;background-position: 0 -420px;">주문금액</span></th>
            <th scope="col"><span class="txts"style="width:55px;background-position: 0 -440px;">적립포인트</span></th>
            <th scope="col">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $tot_point = 0;
        $tot_sell_price = 0;

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
                        b.ca_id3
                   from {$g5['g5_shop_cart_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
                  where a.od_id = '$s_cart_id' ";
        if($default['de_cart_keep_term']) {
            $ctime = date('Y-m-d', G5_SERVER_TIME - ($default['de_cart_keep_term'] * 86400));
            $sql .= " and substring(a.ct_time, 1, 10) >= '$ctime' ";
        }
        $sql .= " group by a.it_id ";
        $sql .= " order by a.ct_id ";
        $result = sql_query($sql);

        $it_send_cost = 0;

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

            if ($i==0) { // 계속쇼핑
                $continue_ca_id = $row['ca_id'];
            }

            $a1 = '<a href="./item.php?it_id='.$row['it_id'].'"><b>';
            $a2 = '</b></a>';
            $image = get_it_image($row['it_id'], 70, 70);

            $it_options = print_item_options($row['it_id'], $s_cart_id);
            $mod_options = "";
            $it_options_str = "";
            if($it_options) {
                $mod_options = '<div style="float:right;width:55px;"><div class="sod_option_btn"><button type="button" class="mod_options">수정</button></div></div><div style="clear:both"></div>';
                $it_options_str = '<div class="sod_opt">'.$it_options.'</div>';
            }
            
            $it_name = "<div><div style='float:left'>".$a1 . stripslashes($row['it_name']) . $a2."</div>".$mod_options."</div>".$it_options_str;

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

            $point      = $sum['point'];
            $sell_price = $sum['price'];
        ?>

        <tr>
            <td class="td_chk">
                <label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품</label>
                <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked">
            </td>
            <td class="td_it_id"><?php echo $row[it_id]; ?></td>
            <td class="sod_img"><?php echo $image; ?></td>
            <td>
                <input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $row['it_id']; ?>">
                <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo get_text($row['it_name']); ?>">
                <?php echo $it_name; ?>
            </td>
            <td class="td_numbig"><?php echo number_format($row['ct_price']); ?></td>
            <td class="td_num"><?php echo number_format($sum['qty']); ?><!--div><input type="text" id="qty<?php echo $row[it_id]; ?>" value="<?php echo number_format($sum['qty']); ?>" size="2" style="text-align:center;width:50px;height:21px"></div>
            	<div style="padding-top:5px"><img src="<?php echo G5_URL; ?>/images/btn_cart_modify.jpg" width="57" height="20" border="0" onclick="qty_modify('<?=$row[it_id]?>');" style="cursor:pointer"></div--></td>
            <td class="td_numbig"><span id="sell_price_<?php echo $i; ?>"><?php echo number_format($sell_price); ?></span></td>
            <td class="td_numbig"><?php echo number_format($point); ?></td>
            <td class="td_dvr"><a href="<?php echo G5_URL;?>/shop/cartupdate.php?act=seldelete&it_id=<?=$row[it_id]?>"><img src="<?php echo G5_URL; ?>/images/btn_cart_delete.jpg" width="15" height="15" border="0"></a></td>
        </tr>

        <?php
            $tot_point      += $point;
            $tot_sell_price += $sell_price;
        } // for 끝

        if ($i == 0) {
            echo '<tr><td colspan="9" class="empty_table">장바구니에 담긴 상품이 없습니다.</td></tr>';
        } else {
            // 배송비 계산
            $send_cost = get_sendcost($s_cart_id, 0);
        }
        ?>
        </tbody>
        </table>
    </div>

    <?php
    $tot_price = $tot_sell_price + $send_cost; // 총계 = 주문상품금액합계 + 배송비
    if ($tot_price > 0 || $send_cost > 0) {
    ?>
    <div id="sod_bsk_tot">
    	<div class="title">
    		총 주문 금액
    	</div>
    	<div class="cost_infor">
	    	<div class="cost">
	    		<div style="float:left;color:#595757;">상품 총 금액</div>
	    		<div style="float:right;color:#595757;font-weight:bold"><?php echo number_format($tot_price); ?>원</div>
	    	</div>
	    	<div class="cls"></div>
	    	<div class="cost_del">
	    		<div style="float:left;color:#595757;">배송비</div>
	    		<div style="float:right;color:#595757;font-weight:bold"><?php echo number_format($send_cost); ?>원</div>
	    	</div>	    	
    	</div>
    	<div class="cls"></div>
    	<div class="cost_result">결제 예정 금액 <span style="font-size:20px"><?php echo number_format($tot_price); ?></span> 원</div>
    
    </div>
    <?php } ?>

    <div id="sod_bsk_act">
        <?php if ($i == 0) { ?>
        <a href="<?php echo G5_SHOP_URL; ?>/" class="btn01">쇼핑 계속하기</a>
        <?php } else { ?>
        <input type="hidden" name="url" value="./orderform.php">
        <input type="hidden" name="records" value="<?php echo $i; ?>">
        <input type="hidden" name="act" value="">
        <a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $continue_ca_id; ?>" class="btn01" style="width:120px;">쇼핑 계속하기</a>
        <button type="button" onclick="return form_check('buy');" class="btn_submit">주문하기</button>
        <button type="button" onclick="return form_check('seldelete');" class="btn03">선택삭제</button>
        <button type="button" onclick="return form_check('alldelete');" class="btn03">비우기</button>
        <?php } ?>
    </div>

    </form>

</div>

<script>
$(function() {
    var close_btn_idx;

    // 선택사항수정
    $(".mod_options").click(function() {
        var it_id = $(this).closest("tr").find("input[name^=it_id]").val();
        var $this = $(this);
        close_btn_idx = $(".mod_options").index($(this));

        $.post(
            "./cartoption.php",
            { it_id: it_id },
            function(data) {
                $("#mod_option_frm").remove();
                $this.after("<div id=\"mod_option_frm\"></div>");
                $("#mod_option_frm").html(data);
                price_calculate();
            }
        );
    });

    // 모두선택
    $("input[name=ct_all]").click(function() {
        if($(this).is(":checked"))
            $("input[name^=ct_chk]").attr("checked", true);
        else
            $("input[name^=ct_chk]").attr("checked", false);
    });

    // 옵션수정 닫기
    $("#mod_option_close").live("click", function() {
        $("#mod_option_frm").remove();
        $(".mod_options").eq(close_btn_idx).focus();
    });
    $("#win_mask").click(function () {
        $("#mod_option_frm").remove();
        $(".mod_options").eq(close_btn_idx).focus();
    });

});
function qty_modify(it_id){
	location.href="<?php echo G5_URL;?>/shop/cartupdate.php?act=modify&it_id=" + it_id + "&it_qty=" + $("#qty" + it_id).val();
	
}
function form_check(act) {
    var f = document.frmcartlist;
    var cnt = f.records.value;

    if (act == "buy")
    {
        if($("input[name^=ct_chk]:checked").size() < 1) {
            alert("주문하실 상품을 하나이상 선택해 주십시오.");
            return false;
        }

        f.act.value = act;
        f.submit();
    }
    else if (act == "alldelete")
    {
        f.act.value = act;
        f.submit();
    }
    else if (act == "seldelete")
    {
        if($("input[name^=ct_chk]:checked").size() < 1) {
            alert("삭제하실 상품을 하나이상 선택해 주십시오.");
            return false;
        }

        f.act.value = act;
        f.submit();
    }

    return true;
}
</script>
<!-- } 장바구니 끝 -->

<?php
include_once('./_tail.php');
?>