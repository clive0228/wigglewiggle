<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$colspan = 6;
$width = "1000px";
$board_skin_url = $board_skin_url."basic";
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 1);
?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx bottomLineRed2px" style="padding-bottom:5px;margin:0">
		<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:-160px">제목</span></div>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" class="td_num"><span class="txts" style="width:20px;background-position-y:-0px">번호</span></th>
            <th scope="col" class="td_subject" colspan="2"><span class="txts" style="width:20px;background-position-y:-20px">제목</span></th>
			<th scope="col" class="td_name sv_use"><span class="txts" style="width:30px;background-position-y:-40px">글쓴이</span></th>
            <th scope="col" class="td_datetime"><span class="txts" style="width:40px;background-position-y:-460px">평점</span></th>
			<th scope="col" class="td_datetime"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?><span class="txts" style="width:20px;background-position-y:-60px">날짜</span></a></th>
			<?php if ($is_admin || $row['mb_id'] == $member['mb_id']) { ?>
			<th scope="col" class="td_datetime"></th>
			<?php } ?>
                
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++){
	        $num = $total_count - ($page - 1) * $rows - $i;
	        $star = get_star($row['is_score']);
	
	        $is_content = get_view_thumbnail($row['is_content'], $thumbnail_width);
	
	        $row2 = sql_fetch(" select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['it_id']}' ");
	        $it_href = G5_SHOP_URL."/item.php?it_id={$row['it_id']}";
	
	
	
			$itemuse_form = "./itemuseform.php?it_id=".$row[it_id];
			$itemuse_formupdate = "./itemuseformupdate.php?it_id=".$row[it_id];
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <td class="td_num">
            <?php
                echo $num;
             ?>
            </td>
            <td width="100">
            	<div class="sps_img">
		            <a href="<?php echo $it_href; ?>">
		                <?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 80, 80); ?>
		                <span><?php echo $row2['it_name']; ?></span>
		                
		            </a>
		        </div>
            </td>
            <td class="td_subject">
		        <a href="<?php echo G5_URL; ?>/shop/itemuseview.php?is_id=<?=$row[is_id]?>&page=<?=$page?>"><?php echo $row['is_subject']; ?></a>
            </td>
            <td class="td_name sv_use"><?php echo $row['is_name']; ?></td>
            <td class="td_date"><img src="<?php echo G5_URL; ?>/shop/img/s_star<?php echo $star; ?>.png" alt="별<?php echo $star; ?>개"></td>
            <td class="td_date"><?php echo substr($row['is_time'],0,10); ?></td>
            <?php if ($is_admin || $row['mb_id'] == $member['mb_id']) { ?>
			<td class="td_datetime">
				<div class="sit_use_cmd">
                    <a href="<?php echo $itemuse_form."&amp;is_id={$row['is_id']}&amp;w=u"; ?>" class="itemuse_form btn01" onclick="return false;">수정</a>
                    <a href="<?php echo $itemuse_formupdate."&amp;is_id={$row['is_id']}&amp;w=d&amp;hash={$hash}"; ?>" class="itemuse_delete btn01">삭제</a>
				</div>
            </td>
			<?php } ?>
        </tr>
        <?php } ?>
        <?php if ($i == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
        <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
	            
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" ><img src="<?php echo $board_skin_url ?>/img/btn_list.png" border="0"></a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>"><img src="<?php echo $board_skin_url ?>/img/btn_write.png" border="0"></a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php 	echo get_paging($config['cf_write_pages'], $page, $total_page, "{$_SERVER['PHP_SELF']}?$qstr&amp;page="); ?>


<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

	<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" required style="height:21px;border:1px solid:dddede">
        <option value="">선택</option>
        <option value="b.it_name"   <?php echo get_selected($sfl, "b.it_name"); ?>>상품명</option>
        <option value="a.it_id"     <?php echo get_selected($sfl, "a.it_id"); ?>>상품코드</option>
        <option value="a.is_subject"<?php echo get_selected($sfl, "a.is_subject"); ?>>후기제목</option>
        <option value="a.is_content"<?php echo get_selected($sfl, "a.is_content"); ?>>후기내용</option>
        <option value="a.is_name"   <?php echo get_selected($sfl, "a.is_name"); ?>>작성자명</option>
        <option value="a.mb_id"     <?php echo get_selected($sfl, "a.mb_id"); ?>>작성자아이디</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" style="width:200px; height:21px;border:1px solid:dddede" maxlength="15">
    <input type="image" src="<?php echo $board_skin_url ?>/img/btn_search.jpg" border="0">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->

<script>
$(function(){
    $(".itemuse_form").click(function(){
        window.open(this.href, "itemuse_form", "width=810,height=680,scrollbars=1");
        return false;
    });

    $(".itemuse_delete").click(function(){
        if (confirm("정말 삭제 하시겠습니까?\n\n삭제후에는 되돌릴수 없습니다.")) {
            return true;
        } else {
            return false;
        }
    });
});
</script>
<!-- } 전체 상품 사용후기 목록 끝 -->