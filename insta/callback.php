<?php
	include_once("./_common.php");
	require_once 'Instagram.php';
	use MetzWeb\Instagram\Instagram;
	
	if($_GET[hub_challenge]){
		echo $_GET[hub_challenge];
	}else{
		$instagram = new Instagram('51964c0b9b054942b59262d60dc5775d');
				        
				        
		//$tag = urlencode("string");
		$tag = "%EC%9C%84%EA%B8%80%EC%9C%84%EA%B8%80"; //위글위글
		$tag2 = "%EC%9C%84%EA%B8%80%EC%9C%84%EA%B8%80%EC%9E%A5%EA%B0%91"; //위글위글장갑
		$result = $instagram->getTagMedia($tag, 30);
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
			//$img = str_replace("_n.jpg","_a.jpg",$img);
			$username = $media->caption->from->username;
			$count_comment = $media->comments->count;
			$count_likes = $media->likes->count; 
			$text = str_replace('"',"'",$text);
			
			$unuse = " in_unuse='0', ";

			if(!strpos($text,"장갑") && !strpos($text,"케이스") && !strpos($text,"인사동") && 
				!strpos($text,"핸드폰") && !strpos($text,"휴대폰") && !strpos($text,"커먼") && 
				!strpos($text,"커먼그라운드") && !strpos($text,"폰케이스") && !strpos($text,"common") && !strpos($text,"commonground") && !strpos($text,"case") && 
				!strpos($text,"우산") && !strpos($text,"신촌"))
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
			sql_query($sql);
		}
		
		$result = $instagram->getTagMedia($tag2, 30);
		foreach ($result->data as $media) {
			$in_id = $media->id;
			
			$row = sql_fetch("select in_no from g5_insta where in_id='$in_id'");
			if($row[in_no]) continue;
			
			$time = $media->caption->created_time;
			$time = date("Y-m-d H:i:s",$time);  
			$link = $media->link;
			$text = $media->caption->text;
			$profile_img = $media->caption->from->profile_picture;
			$img = $media->images->standard_resolution->url;
			$user_id = $media->caption->from->id;
			$username = $media->caption->from->username;
			$count_comment = $media->comments->count;
			$count_likes = $media->likes->count; 
			$text = str_replace('"',"'",$text);
			
			
			$unuse = " in_unuse='0', ";

			if(!strpos($text,"장갑") && !strpos($text,"케이스") && !strpos($text,"인사동") && 
				!strpos($text,"핸드폰") && !strpos($text,"휴대폰") && !strpos($text,"커먼") && 
				!strpos($text,"커먼그라운드") && !strpos($text,"폰케이스") && !strpos($text,"common") && !strpos($text,"commonground") && !strpos($text,"case") && 
				!strpos($text,"우산") && !strpos($text,"신촌"))
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
			sql_query($sql);
		}
		
		$d = date("Y-m-d H:i:s",time());
		sql_query("insert into g5_insta_log set mode='auto', datetime='$d'");
	}
	
?>