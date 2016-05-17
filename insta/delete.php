<?php
	include_once("./_common.php");
	if($is_admin){
		$id = $_GET[id];
		$row=sql_fetch("select * from g5_insta where in_id='$id'");
		if($row[in_unuse] == 1){
			sql_query("update g5_insta set in_unuse='0' where in_id='$id'");
		}else{
			sql_query("update g5_insta set in_unuse='1' where in_id='$id'");
		}
	}
?>