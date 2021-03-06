<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sct_sort_href = $_SERVER['PHP_SELF'].'?';
if($ca_id)
    $sct_sort_href .= 'ca_id='.$ca_id;
else if($ev_id)
    $sct_sort_href .= 'ev_id='.$ev_id;
if($skin)
    $sct_sort_href .= '&amp;skin='.$skin;
$sct_sort_href .= '&amp;sort=';

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>

<!-- 상품 정렬 선택 시작 { -->
<section id="sct_sort">
	<select name="sortinfor" onchange="location.href='<?php echo $sct_sort_href; ?>'+this.value;">
		<option value="it_update_time&amp;sortodr=desc" <?php if($sort=="it_update_time") echo "selected='selected'"; ?>>신상품순</option>
		<option value="it_sum_qty&amp;sortodr=desc" <?php if($sort=="it_sum_qty") echo "selected='selected'"; ?>>판매많은순</option>
		<option value="it_price&amp;sortodr=asc" <?php if($sort=="it_price" && $sortodr=="asc") echo "selected='selected'"; ?>>낮은가격순</option>
		<option value="it_price&amp;sortodr=desc" <?php if($sort=="it_price" && $sortodr=="desc") echo "selected='selected'"; ?>>높은가격순</option>
		<option value="it_use_avg&amp;sortodr=desc" <?php if($sort=="it_use_avg") echo "selected='selected'"; ?>>평점높은순</option>
		<option value="it_use_cnt&amp;sortodr=desc" <?php if($sort=="it_use_cnt") echo "selected='selected'"; ?>>후기많은순</option>
	</select>
</section>
<!-- } 상품 정렬 선택 끝 -->