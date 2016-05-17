<?php
include_once("./_common.php");
require_once 'Instagram.php';
use MetzWeb\Instagram\Instagram;
if(!$is_admin) goto_url("./");

	$result = sql_query("select in_user_id,in_id from g5_insta where in_unuse='$unuse' order by in_datetime desc limit 0, 20");
	while($row=sql_fetch_array($result)){
		$instagram2 = new Instagram('51964c0b9b054942b59262d60dc5775d');
		$media = $instagram2->getUser($row[in_user_id]);
		$profile = $media->data->profile_picture;
		
		sql_query("update g5_insta set in_profile='$profile' where in_id='$row[in_id]'");
	}
	alert("업데이트 되었습니다.","./");
 ?>
