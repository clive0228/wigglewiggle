<?php
include_once("./_common.php");
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$data = $_POST[data];

$data = explode("||",$data);
for($i=0;$i<count($data)-1;$i++){
	$str = explode("^^", "$data[$i]");
	//sql_query("insert into g5_insta set in_profile='$str[1]',in_img='$str[2]',in_unuse='$str[3]'");

	//echo "update g5_insta set in_profile='$str[1]',in_img='$str[2]',in_unuse='$str[3]' where in_id='$str[0]'<br>";
}
//alert("완료되었습니다.","http://www.artshare.kr/insta");
?>
