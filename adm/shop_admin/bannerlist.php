<?php
$sub_menu = '500500';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '배너관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from {$g5['g5_shop_banner_table']} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
?>

<div class="local_ov01 local_ov">
    등록된 배너 <?php echo $total_count; ?>개
</div>

<div class="btn_add01 btn_add">
    <a href="./bannerform.php">배너추가</a>
</div>

<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" rowspan="2" id="th_id">ID</th>
        <th scope="col" id="th_loc" width="200">위치</th>
        <th scope="col" id="th_target" width="200">새창여부</th>
        <th scope="col" id="th_link" width="">링크</th>
        <th scope="col" id="th_mng" width="100">관리</th>
    </tr>
    <tr>
        <th scope="col" colspan="4" id="th_img">이미지</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = " select * from {$g5['g5_shop_banner_table']}
          order by bn_id desc
          limit $from_record, $rows  ";
    $result = sql_query($sql);
    for ($i=0; $row=mysql_fetch_array($result); $i++) {
        // 테두리 있는지
        $bn_border  = $row['bn_border'];
        // 새창 띄우기인지
        $bn_new_win = ($row['bn_new_win']) ? 'target="_new"' : '';

        $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
        if(file_exists($bimg)) {
            $size = @getimagesize($bimg);
            if($size[0] && $size[0] > 800)
                $width = 800;
            else
                $width = $size[0];

            $bn_img = "";
            if ($row['bn_url'] && $row['bn_url'] != "http://")
                $bn_img .= '<a href="'.$row['bn_url'].'" '.$bn_new_win.'>';
            $bn_img .= '<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" width="'.$width.'" alt="'.$row['bn_alt'].'"></a>';
        }

        $bn_begin_time = substr($row['bn_begin_time'], 2, 14);
        $bn_end_time   = substr($row['bn_end_time'], 2, 14);

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="th_id" rowspan="2" class="td_num"><?php echo $row['bn_id']; ?></td>
        <td headers="th_loc"><?php
        		if($row[bn_position] == "mypage")
        			echo "마이페이지";
        		else if($row[bn_position] == "community")
        			echo "커뮤니티";
        		else if($row[bn_position] == "register")
        			echo "회원가입";
        		else if($row[bn_position] == "mypage")
        			echo "마이페이지";
        		else if($row[bn_position] == "cart")
        			echo "장바구니";
        		else if($row[bn_position] == "orderform")
        			echo "주문서작성";
        		else{
	        		$cr = sql_fetch("select ca_name from g5_shop_category where ca_id='$row[bn_position]'");
	        		if($cr[ca_name]){
		        		echo "[카테고리] $cr[ca_name]";
	        		}else{
		        		$cr = sql_fetch("select bo_subject from g5_board where bo_table='$row[bn_position]'");
		        		if($cr[bo_subject]){
			        		echo "[게시판] $cr[bo_subject]";
		        		}else{
			        		echo "위치를 찾을 수 없음";
		        		}
	        		}
	        		
	        		
        		} ?></td>
        <td headers="th_st" class="td_target"><?php 
        	if($row[bn_url] == "http://"){
				echo "링크없음";	        	
        	}else{
	        	if($row[bn_new_win]) echo "새창";
	        	else echo "현재창";
        	}  ?></td>
        <td headers="th_st" class="td_link"><?php
        	if($row[bn_url] == "http://"){
				echo "링크없음";	        	
        	}else{
        		echo $row[bn_url];
        	} ?></td>
        <td headers="th_mng" class="td_mngsmall">
            <a href="./bannerform.php?w=u&amp;bn_id=<?php echo $row['bn_id']; ?>">수정</a></li>
            <a href="./bannerformupdate.php?w=d&amp;bn_id=<?php echo $row['bn_id']; ?>" onclick="return delete_confirm();">삭제</a>
        </td>
    </tr>
    <tr class="<?php echo $bg; ?>">
        <td headers="th_img" colspan="4" class="td_img_view sbn_img">
            <div  class="sbn_image"><?php echo $bn_img; ?></div>
            <button type="button" class="sbn_img_view btn_frmline">이미지확인</button>
        </td>
    </tr>

    <?php
    }
    if ($i == 0) {
    echo '<tr><td colspan="8" class="empty_table">자료가 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>

</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['PHP_SELF']}?$qstr&amp;page="); ?>

<script>
$(function() {
    $(".sbn_img_view").on("click", function() {
        $(this).closest(".td_img_view").find(".sbn_image").slideToggle();
    });
});
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
