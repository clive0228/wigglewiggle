<?php
define('_INDEX_', true);
include_once('./_common.php');
$unuse = 1;
if(!$is_admin) alert("관리자만 접근 가능합니다.");
include_once('./_head.php');
?>
<style type="text/css">
	#ma_con{
		margin:0 auto;
		position: relative;
	}
	
	.item {
		float: left;
		width: 228px;	
		margin:10px;
		border:1px solid #ddd;
		position: relative;
	}	
	.item .title{
		padding:10px;
		border-bottom: 1px solid #ddd;
	}
	.item .title .pic{
		float: left;
		width: 50px;
	}
	.item .title .name{
		float: left;
		font-weight: bold;
		font-family: 'Nanum Gothic';
		color:#555;
		font-size: 14px;
		padding-top:8px;
	}
	.item .text{
		padding:10px;
		font-family: 'Nanum Gothic';
		color:#555;
		border-bottom: 1px solid #ddd;
	}
	.imgs{
		clear: both;
		height: 228px;
		position: relative;
	}
	.infors{
		padding:10px;
		font-family: 'Nanum Gothic';
		color:#888;
	}
	.cls{
		clear:both;
	}
	.item a{
		text-decoration: none;
	}
	.delete{
		width: 40px;
		height: 40px;
		background-color: red;
		float: left;
		margin-right: 10px;
		font-size: 26px;
		text-align: center;
		color:#fff;
		vertical-align: middle;
		cursor: pointer;
	}
	a:hover{
		text-decoration: none;
	}
	.btnUpdate{
		padding:0 10px 0 10px;
	}
	.btnUpdate .inner{
		width: 100%;
		padding:20px 0 20px 0;
		font-size: 20px;
		font-weight: bold;
		text-align: center;
		background-color: #ff2d38;
		color: #fff;
	}
</style>
<script src="<?php echo G5_JS_URL; ?>/jquery.masonry.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/jquery.infinitescroll.min.js"></script>
<br><br><br><br><br><br><br>
<a href='./'><div class="btnUpdate"><div class="inner">이전 페이지로 돌아가기</div></div></a><br>
<a href='./keepDelete.php'><div class="btnUpdate"><div class="inner">보류중인 게시글 모두 삭제하기</div></div></a>

<?	
	$row = sql_fetch("select count(*) as cnt from g5_insta where in_unuse='$unuse'");
?><br>
<div class="btnUpdate"><div class="inner"><?=$row[cnt]?>개의 보류중인 posts</div></div>
<div id="ma_con">
<?php
	$result = sql_query("select * from g5_insta where in_unuse='$unuse' order by in_datetime desc limit 0, 12");
	while($row=sql_fetch_array($result)){
		
//		if(!strpos($row[in_text],"장갑")) continue;
?>
	<div class="item" id="<?=$row[in_id]?>">
		<div class="title">
			<?php if($is_admin) { ?>
				<div id="delete<?=$row[in_id]?>" class="delete" onclick="del('<?=$row[in_id]?>');">R</div>
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
</div>

<script type="text/javascript">
var startCount	 = "12";
var startCountPrev = 0;
var width;
var colWidth = 250;
var docWidth;
var colCount;
var dt;
var dt_prev = -2000;
$(function(){
	var $container = $('#ma_con');
	$container.masonry({
		// options
		itemSelector : '.item',
		columnWidth : 250
	});
});
$(window).scroll(function () {
    var scrollHeight = $(window).scrollTop() + $(window).height();
    var documentHeight = $(document).height();
    //스크롤 시 아래 추가 함. 
    dt = new Date();
    dt = dt.getTime();
    if (scrollHeight + 300 >= documentHeight && startCount != startCountPrev && dt > dt_prev+600) {
		dt_prev = dt;
    	$.ajax({
			type : "POST"
			, async : true
			, url : "./ajax.getDate.php"
			, dataType : "html" // xml , html, script, json 등
			, timeout : 30000
			, chche : false	
			, data : "startCount=" + startCount + "&unuse="+<?=$unuse?> //$("#inputForm").serialize()  이걸 하면, 폼 내용들을  a=b&c=d식으로 바꿔 준다네.
			, contentType : "application/x-www-form-urlencoded; charset=UTF-8"
			, error : function (request, status, error){
				location.href="/insta";
			}
			, success : function (response, status, request){
				var $boxes = $(response);
				$('#ma_con').append( $boxes ).masonry( 'appended', $boxes );
			}
			,beforeSend : function() {
		startCountPrev = startCount;
		startCount  = parseInt(startCount) + 12;
			}
			, complete : function() {
			}
		});
    }
});   
function del(n){
	var str = $("#delete"+n).html();
	
	if(str == "R"){
		$("#delete"+n).html("X");
		$("#"+n).animate({opacity:0.2},200);
	}else{
		$("#delete"+n).html("R");
		$("#"+n).animate({opacity:1},200);
	}
	
	hiddenframe.location.href="./delete.php?id="+n;
}
</script>
<iframe width=0 height=0 name='hiddenframe' style='display:none;'></iframe>

<?php
include_once('./_tail.php');
?>
