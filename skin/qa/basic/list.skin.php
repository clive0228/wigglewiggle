<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);

$board_skin_url = $board_skin_url."basic";
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx bottomLineRed2px" style="padding-bottom:5px;margin:0">
    	<?php 
			$bpy = -120;
			if($pageId == "mypage") $bpy = -280;
    	?>
		<div style="padding:17px 0 0 5px;float:left"><span class="txts t3" style="background-position-y:<?=$bpy?>px">제목</span></div>

    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->


    <form name="fqalist" id="fqalist" action="./qadelete.php" onsubmit="return fqalist_submit(this);" method="post">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" class="td_num"><span class="txts" style="width:20px;background-position-y:-0px">번호</span></th>
            <?php if ($is_checkbox) { ?>
            <th scope="col" class="td_chk">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th scope="col" class="td_datetime"><span class="txts" style="width:20px;background-position-y:-560px">제목</span></th>
            <th scope="col" class="td_subject"><span class="txts" style="width:20px;background-position-y:-20px">제목</span></th>
            <th scope="col" class="td_name sv_use"><span class="txts" style="width:30px;background-position-y:-40px">글쓴이</span></th>
            <th scope="col" class="td_numbig"><?php echo subject_sort_link('qa_status', $qstr2, 1) ?><span class="txts" style="width:20px;background-position-y:-580px">상태</span></a></th>
            <th scope="col" class="td_date"><?php echo subject_sort_link('date', $qstr2, 1) ?><span class="txts" style="width:20px;background-position-y:-60px">날짜</span></a></th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <td class="td_num"><?php echo $list[$i]['num']; ?></td>
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_qa_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject']; ?></label>
                <input type="checkbox" name="chk_qa_id[]" value="<?php echo $list[$i]['qa_id'] ?>" id="chk_qa_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td class="td_category" align="center"><?php echo $list[$i]['category']; ?></td>
            <td class="td_subject">
                <a href="<?php echo $list[$i]['view_href']; ?>">
                    <?php echo $list[$i]['subject']; ?>
                </a>
                <?php echo $list[$i]['icon_file']; ?>
            </td>
            <td class="td_name"><?php echo $list[$i]['name']; ?></td>
            <td class="td_stat <?php echo ($list[$i]['qa_status'] ? 'txt_done' : 'txt_rdy'); ?>" align="center"><?php echo ($list[$i]['qa_status'] ? '답변완료' : '답변대기'); ?></td>
            <td class="td_date"><?php echo $list[$i]['date']; ?></td>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
        <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
	            
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" ><img src="<?php echo $board_skin_url ?>/img/btn_list.png" border="0"></a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>"><img src="<?php echo $board_skin_url ?>/img/btn_qa_write.jpg" border="0"></a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $list_pages;  ?>

<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" style="width:200px; height:21px;border:1px solid:dddede" maxlength="15">
    <input type="image" src="<?php echo $board_skin_url ?>/img/btn_search.jpg" border="0">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>


<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fqalist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]")
            f.elements[i].checked = sw;
    }
}

function fqalist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
            return false;
    }

    return true;
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->