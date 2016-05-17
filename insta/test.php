<?php
	include_once("./_common.php");
	require_once 'Instagram.php';
	use MetzWeb\Instagram\Instagram;
	
		$instagram = new Instagram('51964c0b9b054942b59262d60dc5775d');
				        
		$tag = "%EC%9C%84%EA%B8%80%EC%9C%84%EA%B8%80";
		$tag2 = $tag."%EC%9E%A5%EA%B0%91";
		$tag3 = "%EC%95%84%ED%8A%B8%EC%89%90%EC%96%B4";
		
		$result = $instagram->getTagMedia($tag3, 10);
		print_r($result);
		echo $result;
		exit;
		foreach ($result->data as $media) {
			$in_id = $media->id;
			
			$row = sql_fetch("select in_no from g5_insta where in_id='$in_id'");
			if($row[in_no]) continue;
			
			$time = $media->caption->created_time;
			$time = date("Y-m-d H:i:s",$time);  
			$link = $media->link;
			$text = $media->caption->text;
			$profile_img = $media->caption->from->profile_picture;
			$user_id = $media->caption->from->id;
			$img = $media->images->standard_resolution->url;
			$img = str_replace("_n.jpg","_a.jpg",$img);
			$username = $media->caption->from->username;
			$count_comment = $media->comments->count;
			$count_likes = $media->likes->count; 
			$text = str_replace('"',"'",$text);
			
			$unuse = " in_unuse='0', ";

			if(!strpos($text,"장갑") && !strpos($text,"케이스") && !strpos($text,"인사동") && !strpos($text,"핸드폰") && !strpos($text,"휴대폰"))
				$unuse = " in_unuse='1', ";
			
			$sql = 'insert into g5_insta set
				in_url ="'.$link.'",
				in_text="'.$text.'",
				in_img="'.$img.'",
				in_name="'.$username.'",
				in_profile="'.$profile_img.'",
				in_id="'.$in_id.'",
				in_user_id="'.$user_id.'",
				'.$unuse.'
				in_cnt_comments="'.$count_comment.'",
				in_cnt_likes="'.$count_likes.'",
				in_datetime="'.$time.'"';
			//sql_query($sql);
		}
			
?>