<?php
	include_once("./_common.php");
	$startNum = $_POST[startCount];
	$result = sql_query("select * from g5_insta where in_unuse < 1  order by in_datetime desc limit $startNum, 12");
	while($row=sql_fetch_array($result)){
?>
	<div class="item" id="<?=$row[in_id]?>">
		<div class="title">
			<?php if($is_admin) { ?>
				<div class="delete" onclick="del('<?=$row[in_id]?>');">X</div>
			<? } ?>
			<a href="http://instagram.com/<?=$row[in_name]?>" target="_blank">
				<div class="pic"><img src="<?=$row[in_profile]?>" width="40" height="40" border="0"></div>
				<div class="name"><?=$row[in_name]?></div>
				<div class="cls"></div>
			</a>
		</div>
		<a href="<?=$row[in_url]?>" target="_blank">
			<div class="imgs"><img src="<?=$row[in_img]?>" width="228" border="0"></div>
			<div class="text"><?=$row[in_text]?></div>
<!-- 			<div class="infors"><?=$row[in_cnt_comments]?> comments, <?=$row[in_cnt_comments]?> likes</div> -->
		</a>
		<div class="cls"></div>
	</div>
<?php
	}	
?>