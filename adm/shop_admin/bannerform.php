<?php
$sub_menu = '500500';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

$html_title = '배너';
$g5['title'] = $html_title.'관리';

if ($w=="u")
{
    $html_title .= ' 수정';
    $sql = " select * from {$g5['g5_shop_banner_table']} where bn_id = '$bn_id' ";
    $bn = sql_fetch($sql);
}
else
{
    $html_title .= ' 입력';
    $bn['bn_url']        = "http://";
    $bn['bn_begin_time'] = date("Y-m-d 00:00:00", time());
    $bn['bn_end_time']   = date("Y-m-d 00:00:00", time()+(60*60*24*31));
}

include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="fbanner" action="./bannerformupdate.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="bn_id" value="<?php echo $bn_id; ?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row">이미지</th>
        <td>
            <input type="file" name="bn_bimg">
            <?php
            $bimg_str = "";
            $bimg = G5_DATA_PATH."/banner/{$bn['bn_id']}";
            if (file_exists($bimg) && $bn['bn_id']) {
                $size = @getimagesize($bimg);
                if($size[0] && $size[0] > 750)
                    $width = 750;
                else
                    $width = $size[0];

                echo '<input type="checkbox" name="bn_bimg_del" value="1" id="bn_bimg_del"> <label for="bn_bimg_del">삭제</label>';
                $bimg_str = '<img src="'.G5_DATA_URL.'/banner/'.$bn['bn_id'].'" width="'.$width.'">';
                //$size = getimagesize($bimg);
                //echo "<img src='$g5[admin_path]/img/icon_viewer.gif' border=0 align=absmiddle onclick=\"imageview('bimg', $size[0], $size[1]);\"><input type=checkbox name=bn_bimg_del value='1'>삭제";
                //echo "<div id='bimg' style='left:0; top:0; z-index:+1; display:none; position:absolute;'><img src='$bimg' border=1></div>";
            }
            if ($bimg_str) {
                echo '<div class="banner_or_img">';
                echo $bimg_str;
                echo '</div>';
            }
            ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_url">링크</label></th>
        <td>
            <?php echo help("배너클릭시 이동하는 주소입니다."); ?>
            <input type="text" name="bn_url" size="80" value="<?php echo $bn['bn_url']; ?>" id="bn_url" class="frm_input">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_position">출력위치</label></th>
        <td>
            <select name="bn_position" id="bn_position">
            	<?
            		$result = sql_query("select * from g5_shop_category where length(ca_id) = 2 order by ca_id asc");
            		while($row = sql_fetch_array($result)){
            			$sel = "";
            			if($bn[bn_position] == $row[ca_id])
	            			$sel = "selected='selected'";
	            		echo "<option value='$row[ca_id]' $sel>[카테고리] $row[ca_name] </option>";
            		}
            	?>
                <option value="-">---------------</option>
            	<?
            		$result = sql_query("select * from g5_board  order by bo_table asc");
            		while($row = sql_fetch_array($result)){
            			$sel = "";
            			if($bn[bn_position] == $row[bo_table])
	            			$sel = "selected='selected'";
	            		echo "<option value='$row[bo_table]' $sel>[게시판] $row[bo_subject] </option>";
            		}
            	?>
                <option value="-">---------------</option>
                <option value="mypage" <?php echo get_selected($bn['bn_position'], 'mypage'); ?>>마이페이지</option>
                <option value="community" <?php echo get_selected($bn['bn_position'], 'community'); ?>>Community</option>
                <option value="register" <?php echo get_selected($bn['bn_position'], 'register'); ?>>회원가입</option>
                <option value="-">---------------</option>
                <option value="cart" <?php echo get_selected($bn['bn_position'], 'cart'); ?>>장바구니</option>
                <option value="orderform" <?php echo get_selected($bn['bn_position'], 'orderform'); ?>>주문서작성</option>
			</select>
			<br>
			*[메인] 슬라이드 : 해당 위치에 업로드 된 모든 이미지가 메인에 노출되어 슬라이드 됩니다.<br>
			* 그 외 : 동일 위치로 업로드 된 모든 이미지 중 가장 최근 1개의 이미지가 해당 포지션에 노출됩니다.
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_new_win">새창</label></th>
        <td>
            <?php echo help("배너클릭시 새창을 띄울지를 설정합니다.", 50); ?>
            <select name="bn_new_win" id="bn_new_win">
                <option value="0" <?php echo get_selected($bn['bn_new_win'], 0); ?>>사용안함</option>
                <option value="1" <?php echo get_selected($bn['bn_new_win'], 1); ?>>사용</option>
            </select>
        </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./bannerlist.php">목록</a>
</div>

</form>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
