<?php
include_once("./_common.php");
require_once 'Instagram.php';
use MetzWeb\Instagram\Instagram;
$result = sql_query("select in_text from g5_insta");
while($row=sql_fetch_array($result)){
	$str = explode("아트쉐어",$row[in_text]);
	if(count($str) > 1){
		echo $row[in_text]."<br><br><br>";
	}
}
$instagram = new Instagram('51964c0b9b054942b59262d60dc5775d');    	        
$tag = "%EC%95%84%ED%8A%B8%EC%89%90%EC%96%B4";

$result = $instagram->searchMedia($tag);
	print_r($result->data);
	
foreach ($result->data as $media) {
	print_r($media);
	$in_id = $media->id;
	echo $in_id."<br>";
}
?>
  </body>
</html>