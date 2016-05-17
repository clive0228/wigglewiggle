<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (!defined("_ORDERINQUIRY_")) exit; // 개별 페이지 접근 불가
?>

<!-- 주문 내역 목록 시작 { -->
<?php if (!$limit) { ?>총 <?php echo $cnt; ?> 건<?php } ?>

<div class="tbl_head01 tbl_wrap">
    <table>
    <thead>
    <tr>
        <th scope="col" class="td_long"><span class="txts" style="width:50px;background-position-y:-180px">주문서번호</span></th>
        <th scope="col" class="td_long"><span class="txts" style="width:40px;background-position-y:-200px">주문일시</span></th>
        <th scope="col"><span class="txts" style="width:40px;background-position-y:-220px">상품상품</span></th>
        <th scope="col" class="td_numbig"><span class="txts" style="width:56px;background-position-y:-240px">주문금액</span></th>
        <th scope="col" class="td_numbig"><span class="txts" style="width:30px;background-position-y:-260px">입금액</span></th>
        <th scope="col" class="td_numbig"><span class="txts" style="width:40px;background-position-y:-280px">미입금액</span></th>
        <th scope="col" class="td_numbig"><span class="txts" style="width:40px;background-position-y:-300px">주문상태</span></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = " select *
               from {$g5['g5_shop_order_table']}
              where mb_id = '{$member['mb_id']}'
              order by od_id desc
              $limit ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
    	$r = sql_fetch("select count(*) as cnt, a.it_name from g5_shop_item as a, g5_shop_order as b,g5_shop_cart as c where b.od_id='$row[od_id]' and b.od_id=c.od_id and c.it_id=a.it_id");
    
		$subject = $r[it_name];
		if($r[cnt] > 1){
			$subject.=" 외 ".($r[cnt]-1)."건";
		}
        $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);

        switch($row['od_status']) {
            case '주문':
                $od_status = '입금확인중';
                break;
            case '입금':
                $od_status = '입금완료';
                break;
            case '준비':
                $od_status = '상품준비중';
                break;
            case '배송':
                $od_status = '상품배송';
                break;
            case '완료':
                $od_status = '배송완료';
                break;
            default:
                $od_status = '주문취소';
                break;
        }
    ?>

    <tr>
        <td>
            <input type="hidden" name="ct_id[<?php echo $i; ?>]" value="<?php echo $row['ct_id']; ?>">
            <?php echo $row['od_id']; ?>
        </td>
        <td><?php echo substr($row['od_time'],2,14); ?> (<?php echo get_yoil($row['od_time']); ?>)</td>
        <td><a href="<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>"><u><?php echo $subject; ?></u></a></td>
        <td class="td_numbig"><?php echo display_price($row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2']); ?></td>
        <td class="td_numbig"><?php echo display_price($row['od_receipt_price']); ?></td>
        <td class="td_numbig"><?php echo display_price($row['od_misu']); ?></td>
        <td align="center"><?php echo $od_status; ?></td>
    </tr>

    <?php
    }

    if ($i == 0)
        echo '<tr><td colspan="7" class="empty_table">주문 내역이 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>
<!-- } 주문 내역 목록 끝 -->