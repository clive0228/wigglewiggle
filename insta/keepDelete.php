<?php
	include_once("./_common.php");
	if($is_admin){
		sql_query("delete from g5_insta where in_unuse='1'");
		alert("삭제되었습니다.");
	}
?>