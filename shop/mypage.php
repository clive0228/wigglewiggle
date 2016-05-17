<?php
$pageId="mypage";
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/mypage.php');
    return;
}

if (!$is_member)
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

<!-- 마이페이지 시작 { -->
<div id="smb_my">

    <section id="smb_my_od">
	    <div class="bo_fx bottomLineRed2px" style="padding-bottom:5px;margin:0">
			<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:-440px">제목</span></div>
	    </div>
        <?php
        // 최근 주문내역
        define("_ORDERINQUIRY_", true);

        $limit = " limit 0, 5 ";
        include G5_SHOP_PATH.'/orderinquiry.sub.php';
        ?>

        <div class="smb_my_more">
            <a href="./orderinquiry.php" class="btn01">주문내역 더보기</a>
        </div>
    </section>
    <!-- } 최근 주문내역 끝 -->

    <!-- 최근 위시리스트 시작 { -->
    <section id="smb_my_wish">
	    <div class="bo_fx bottomLineRed2px" style="padding-bottom:5px;margin:0">
			<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:-460px">제목</span></div>
	    </div>


        <div class="tbl_head01 tbl_wrap">
            <table>
            <thead>
            <tr>
                <th scope="col">이미지</th>
                <th scope="col">상품명</th>
                <th scope="col">보관일시</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = " select *
                       from {$g5['g5_shop_wish_table']} a,
                            {$g5['g5_shop_item_table']} b
                      where a.mb_id = '{$member['mb_id']}'
                        and a.it_id  = b.it_id
                      order by a.wi_id desc
                      limit 0, 3 ";
            $result = sql_query($sql);
            for ($i=0; $row = sql_fetch_array($result); $i++)
            {
                $image = get_it_image($row['it_id'], 70, 70, true);
            ?>

            <tr>
                <td class="smb_my_img"><?php echo $image; ?></td>
                <td><a href="./item.php?it_id=<?php echo $row['it_id']; ?>"><?php echo stripslashes($row['it_name']); ?></a></td>
                <td class="td_datetime"><?php echo $row['wi_time']; ?></td>
            </tr>

            <?php
            }

            if ($i == 0)
                echo '<tr><td colspan="3" class="empty_table">보관 내역이 없습니다.</td></tr>';
            ?>
            </tbody>
            </table>
        </div>

        <div class="smb_my_more">
            <a href="./wishlist.php" class="btn01">위시리스트 더보기</a>
        </div>
    </section>
    <!-- } 최근 위시리스트 끝 -->
</div>

<script>
$(function() {
    $(".win_coupon").click(function() {
        var new_win = window.open($(this).attr("href"), "win_coupon", "left=100,top=100,width=700, height=600, scrollbars=1");
        new_win.focus();
        return false;
    });
});

function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}
</script>
<!-- } 마이페이지 끝 -->

<?php
include_once("./_tail.php");
?>