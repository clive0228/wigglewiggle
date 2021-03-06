<?php
$pageId = "mypage";
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/wishlist.php');
    return;
}

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_SHOP_URL.'/wishlist.php'));

$g5['title'] = "위시리스트";
include_once('./_head.php');
?>

<!-- 위시리스트 시작 { -->
<div id="sod_ws">
    <div class="bo_fx bottomLineRed2px" style="padding-bottom:5px;margin:0">
		<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:-320px">제목</span></div>
    </div>

    <form name="fwishlist" method="post" action="./cartupdate.php">
    <input type="hidden" name="act"       value="multi">
    <input type="hidden" name="sw_direct" value="">
    <input type="hidden" name="prog"      value="wish">

    <div class="tbl_head01 tbl_wrap">
        <table>
        <thead>
        <tr>
            <th scope="col"><span class="txts" style="width:20px;background-position-y:-480px">선택</span></th>
            <th scope="col"><span class="txts" style="width:30px;background-position-y:-500px">이미지</span></th>
            <th scope="col"><span class="txts" style="width:30px;background-position-y:-520px">상품명</span></th>
            <th scope="col"><span class="txts" style="width:30px;background-position-y:-380px">판매가</span></th>
            <th scope="col"><span class="txts" style="width:40px;background-position-y:-540px">보관일시</span></th>
            <th scope="col"><span class="txts" style="width:20px;background-position-y:-160px">삭제</span></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql  = " select a.wi_id, a.wi_time, b.* from {$g5['g5_shop_wish_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id ) ";
        $sql .= " where a.mb_id = '{$member['mb_id']}' order by a.wi_id desc ";
        $result = sql_query($sql);
        for ($i=0; $row = mysql_fetch_array($result); $i++) {

            $out_cd = '';
            $sql = " select count(*) as cnt from {$g5['g5_shop_item_option_table']} where it_id = '{$row['it_id']}' and io_type = '0' ";
            $tmp = sql_fetch($sql);
            if($tmp['cnt'])
                $out_cd = 'no';

            $it_price = get_price($row);

            if ($row['it_tel_inq']) $out_cd = 'tel_inq';

            $image = get_it_image($row['it_id'], 70, 70);
        ?>

        <tr>
            <td class="td_chk">
                <?php
                // 품절검사
                if(is_soldout($row['it_id']))
                {
                ?>
                품절
                <?php } else { //품절이 아니면 체크할수 있도록한다 ?>
                <label for="chk_it_id_<?php echo $i; ?>" class="sound_only"><?php echo $row['it_name']; ?></label>
                <input type="checkbox" name="chk_it_id[<?php echo $i; ?>]" value="1" id="chk_it_id_<?php echo $i; ?>" onclick="out_cd_check(this, '<?php echo $out_cd; ?>');">
                <?php } ?>
                <input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $row['it_id']; ?>">
                <input type="hidden" name="io_type[<?php echo $row['it_id']; ?>][0]" value="0">
                <input type="hidden" name="io_id[<?php echo $row['it_id']; ?>][0]" value="">
                <input type="hidden" name="io_value[<?php echo $row['it_id']; ?>][0]" value="<?php echo $row['it_name']; ?>">
                <input type="hidden"   name="ct_qty[<?php echo $row['it_id']; ?>][0]" value="1">
            </td>
            <td class="sod_ws_img"><?php echo $image; ?></td>
            <td><a href="./item.php?it_id=<?php echo $row['it_id']; ?>"><?php echo stripslashes($row['it_name']); ?></a></td>
            <td class="td_numbig"><?php echo number_format($row['it_price']); ?>원</td>
            <td class="td_datetime"><?php echo $row['wi_time']; ?></td>
            <td class="td_mngsmall"><a href="./wishupdate.php?w=d&amp;wi_id=<?php echo $row['wi_id']; ?>"><img src="<?php echo G5_URL; ?>/images/btn_wish_delete.png" border="0"></a></td>
        </tr>
        <?php
        }

        if ($i == 0)
            echo '<tr><td colspan="6" class="empty_table">보관함이 비었습니다.</td></tr>';
        ?>
        </tr>
        </tbody>
        </table>
    </div>

    <div id="sod_ws_act">
        <button type="submit" class="btn01" onclick="return fwishlist_check(document.fwishlist,'');">장바구니 담기</button>
        <button type="submit" class="btn02" onclick="return fwishlist_check(document.fwishlist,'direct_buy');">주문하기</button>
    </div>
    </form>
</div>

<script>
<!--
    function out_cd_check(fld, out_cd)
    {
        if (out_cd == 'no'){
            alert("옵션이 있는 상품입니다.\n\n상품을 클릭하여 상품페이지에서 옵션을 선택한 후 주문하십시오.");
            fld.checked = false;
            return;
        }

        if (out_cd == 'tel_inq'){
            alert("이 상품은 전화로 문의해 주십시오.\n\n장바구니에 담아 구입하실 수 없습니다.");
            fld.checked = false;
            return;
        }
    }

    function fwishlist_check(f, act)
    {
        var k = 0;
        var length = f.elements.length;

        for(i=0; i<length; i++) {
            if (f.elements[i].checked) {
                k++;
            }
        }

        if(k == 0)
        {
            alert("상품을 하나 이상 체크 하십시오");
            return false;
        }

        if (act == "direct_buy")
        {
            f.sw_direct.value = 1;
        }
        else
        {
            f.sw_direct.value = 0;
        }

		f.submit();
    }
//-->
</script>
<!-- } 위시리스트 끝 -->

<?php
include_once('./_tail.php');
?>