<?php
define('_INDEX_', true);
include_once('./_common.php');
require_once 'Instagram.php';
use MetzWeb\Instagram\Instagram;

$unuse = 0;


include_once('./_head.php');
?><?php
function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($ch)!==FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}

?>
<style type="text/css">
	#ma_con{
		margin:0 auto 0 auto;
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
		width: 40px;
		height: 40px;
		margin-right: 10px;
		background-size: 40px 40px;
	}
	.item .title .pic_nouser{
		position: absolute;
		top:10px;
		left:60px;
		width: 40px;
		height: 40px;
		background-size: 40px 40px;
	}
	.item .title .pic_user{
		position: absolute;
		top:10px;
		left:60px;
		width: 40px;
		height: 40px;
		background-size: 40px 40px;
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
		background-color: #ff3eb3;
		color: #fff;
	}
</style>
<div style="display:none">
	<form id="sync" action="http://www.wiggle-wiggle.com/syncArtshare.php" method="post" enctype="multipart/form-data" style="display:none">
		<textarea name="data"><?php
			$result = sql_query("select * from g5_insta where in_unuse='$unuse' order by in_datetime desc");
			while($row=sql_fetch_array($result)){
				echo "$row[in_no]^^$row[in_profile]||";
			}
		?></textarea>
	</form>
</div>
<script src="<?php echo G5_JS_URL; ?>/jquery.masonry.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/jquery.infinitescroll.min.js"></script><br><br>
<?php if (!G5_IS_MOBILE) echo "<br><br><br><br><br>"; ?>
<?php if($is_admin) { ?>
	<a href='./keep.php'><div class="btnUpdate"><div class="inner">[관리] 보류 중인 게시글 확인하기</div></div></a><br>
	<a  style="cursor:pointer;" onclick="if(confirm('정말 하시겠습니까?'))location.href='./profileUpdate.php';"><div class="btnUpdate" style="width:48%;float:left;"><div class="inner" style="font-size:16px;">[관리] 프로필사진 엑박 고치기(프로필 사진 업데이트)</div></div></a>
	<a  style="cursor:pointer" onclick="if(confirm('정말 하시겠습니까?'))document.getElementById('sync').submit();"><div class="btnUpdate" style="width:48%;float:right;"><div class="inner"style="font-size:16px;">[관리] 위글위글 웹사이트 동기화(아트쉐어->위글위글)</div></div></a>
	<div style="clear:both"></div>
<?php } ?>
<?	
	$row = sql_fetch("select count(*) as cnt from g5_insta where in_unuse='$unuse'");
?>
<?php if (!G5_IS_MOBILE) { ?><Br>
	<div class="btnUpdate"><div class="inner">'#아트쉐어' '#위글위글'이 태그된 <?=$row[cnt]?>개의 후기</div></div>
	<?php } ?>
<div id="ma_con">
<?php
	$result = sql_query("select * from g5_insta where in_unuse='$unuse' order by in_datetime desc limit 0, 12");
	while($row=sql_fetch_array($result)){
		/*
if(!checkRemoteFile($row[in_profile])) {
			$row[in_profile] = "aa.jpg";
		}
*/
	//	if(!$file_exists) $row[in_profile] = "aa.jpg";
//		if(!strpos($row[in_text],"장갑")) continue;



/*
		$instagram2 = new Instagram('51964c0b9b054942b59262d60dc5775d');
		$media = $instagram2->getMedia($row[in_id]);
		$profile = $media->data->caption->from->id;
		sql_query("update g5_insta set in_user_id='$profile' where in_id='$row[in_id]'");
		continue;
*/

/*		
		
		
		$media = $instagram2->getUser($row[in_user_id]);
		$profile = $media->data->profile_picture;
		sql_query("update g5_insta set in_profile='$profile' where in_id='$row[in_id]'");
*/

?>
	<div class="item" id="<?=$row[in_id]?>">
		<div class="title">
			<?php if($is_admin) { ?>
				<div id="delete<?=$row[in_id]?>" class="delete" onclick="del('<?=$row[in_id]?>');">X</div>
			<? } ?>
			<a href="http://instagram.com/<?=$row[in_name]?>" target="_blank">
				<div class="pic">
					<div class="pic_nouser" style="background-image:url('<?php echo G5_URL; ?>/images/nouser.jpg');"></div>
					<div class="pic_user" style="background-image:url('<?=$row[in_profile]?>');"></div>
				</div>
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
	
	if(str == "X"){
		$("#delete"+n).html("R");
		$("#"+n).animate({opacity:0.2},200);
	}else{
		$("#delete"+n).html("X");
		$("#"+n).animate({opacity:1},200);
	}
	
	hiddenframe.location.href="./delete.php?id="+n;
}
</script>
<iframe width=0 height=0 name='hiddenframe' style='display:none;'></iframe>

<?php
include_once('./_tail.php');
?>
