<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 상품 정보 시작 { -->
<section id="sit_inf">
	<div id="detail_tabs" style="z-index:999">
		<ul>
			<li id="tabs_inf_explan" class="active" onclick="goTabs('inf_explan');">상품설명</li>
			<li id="tabs_use" onclick="goTabs('use');">상품후기</li>
			<li id="tabs_qa" onclick="goTabs('qa');">상품문의</li>
			<li id="tabs_dvr" onclick="goTabs('dvr');">배송 / 교환 / 환불</li>
			<li id="tabs_rel" onclick="goTabs('rel');">추천상품</li>
			<li>&nbsp;</li>
		</ul>
		<div class="cls"></div>
	</div>
    <div id="sit_inf_explan">
	    <?php if ($it['it_explan']) { // 상품 상세설명 ?>
	        <?php echo conv_content($it['it_explan'], 1); ?>
	    <?php } ?>
    </div>

<!--

    <?php
    if ($it['it_info_value']) { // 상품 정보 고시
        $info_data = unserialize(stripslashes($it['it_info_value']));
        if(is_array($info_data)) {
            $gubun = $it['it_info_gubun'];
            $info_array = $item_info[$gubun]['article'];
    ?>
    <h3>상품 정보 고시</h3>
    <table id="sit_inf_open">
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <?php
    foreach($info_data as $key=>$val) {
        $ii_title = $info_array[$key][0];
        $ii_value = $val;
    ?>
    <tr>
        <th scope="row"><?php echo $ii_title; ?></th>
        <td><?php echo $ii_value; ?></td>
    </tr>
    <?php } //foreach?>
    </tbody>
    </table>
    <?php
        } else {
            if($is_admin) {
                echo '<p>상품 정보 고시 정보가 올바르게 저장되지 않았습니다.<br>config.php 파일의 G5_ESCAPE_FUNCTION 설정을 addslashes 로<br>변경하신 후 관리자 &gt; 상품정보 수정에서 상품 정보를 다시 저장해주세요. </p>';
            }
        }
    } //if
    ?>
-->

</section>
<!-- } 상품 정보 끝 -->

<!-- 사용후기 시작 { -->
<section id="sit_use">
    <h2>상품후기</h2>
    <?php echo pg_anchor('use'); ?>
    <div id="itemuse"><?php include_once('./itemuse.php'); ?></div>
</section>
<!-- } 사용후기 끝 -->

<!-- 상품문의 시작 { -->
<section id="sit_qa">
    <h2>상품문의</h2>
    <?php echo pg_anchor('qa'); ?>

    <div id="itemqa"><?php include_once('./itemqa.php'); ?></div>
</section>
<!-- } 상품문의 끝 -->

<?php if ($default['de_baesong_content']) { // 배송정보 내용이 있다면 ?>
<!-- 배송정보 시작 { -->
<section id="sit_dvr">
    <h2>배송 / 교환 / 환불 안내</h2>
    <div style="padding:10px 0 20px 0;border-bottom:1px solid #dedede">
		<table width="1000" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="150" align="center" style="font-size:12px;font-weight:bold">배송정보</td>
				<td width="850"><?php echo conv_content($default['de_baesong_content'], 1); ?></td>
			</tr>
		</table>
    </div>
    <div style="padding:20px 0 20px 0;border-bottom:1px solid #dedede">
		<table width="1000" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="150" align="center" style="font-size:12px;font-weight:bold">교환 / 환불</td>
				<td width="850"><?php echo conv_content($default['de_change_content'], 1); ?></td>
			</tr>
		</table>
    </div>
    
</section>
<!-- } 배송정보 끝 -->
<?php } ?>


<?php if ($default['de_rel_list_use']) { ?>
<!-- 관련상품 시작 { -->
<section id="sit_rel">
    <h2>추천상품</h2>
    <?php echo pg_anchor('rel'); ?>

    <div class="sct_wrap">
        <?php
        $rel_skin_file = $skin_dir.'/'.$default['de_rel_list_skin'];
        if(!is_file($rel_skin_file))
            $rel_skin_file = G5_SHOP_SKIN_PATH.'/'.$default['de_rel_list_skin'];

        $sql = " select b.* from {$g5['g5_shop_item_relation_table']} a left join {$g5['g5_shop_item_table']} b on (a.it_id2=b.it_id) where a.it_id = '{$it['it_id']}' and b.it_use='1' ";
        $list = new item_list($rel_skin_file, $default['de_rel_list_mod'], 0, $default['de_rel_img_width'], $default['de_rel_img_height']);
        $list->set_query($sql);
        echo $list->run();
        ?>
    </div>
</section>
<!-- } 관련상품 끝 -->
<?php } ?>

<script>
var detail_tabs_top = 0;
$(window).on("scroll", function() {
	if($(window).scrollTop() > $("#detail_tabs").offset().top-93){
		detail_tabs_top = $("#detail_tabs").offset().top - 93;
		$("#detail_tabs").css("top","93px");	
		$("#detail_tabs").css("position","fixed");
	}
	if($(window).scrollTop() < detail_tabs_top){
		$("#detail_tabs").css("top","auto");	
		$("#detail_tabs").css("position","absolute");	
	}
});
$(window).on("load", function() {
    $("#sit_inf_explan").viewimageresize2();
});
function goTabs(id){
	// 해당메뉴 위치로 스크롤 변경 (스크롤 = 해당매뉴 위치 - 탑메뉴 높이)
	$('html,body').animate({scrollTop: $("#sit_"+id).offset().top-$("#detail_tabs").outerHeight()-100},'slow');
	$('#detail_tabs > ul > li').removeClass('active');
	$("#tabs_"+id).addClass("active");
}
</script>