<?php
include_once("./_common.php");
require_once 'Instagram.php';
use MetzWeb\Instagram\Instagram;

$instagram = new Instagram('6110dbe0862e43cd8bf15811ec94a84e');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - popular photos</title>
    <link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/4.2/video.js"></script>
  </head>
  <body>
    <div class="container">
      <header class="clearfix">
        <h1>Flea / Free Market <span>tags photos</span></h1>
      </header>
      <div class="main">
        <ul class="grid">
        <?php
	        
	        
	$media = $instagram->getMedia("920156790831774903_340168134");
	$time = $media->data->caption->created_time;
	$time = date("Y-m-d H:i:s",$time);  
	
	print_r($media);
	exit;
	$link = $media->data->link;
	$text = $media->data->caption->text;
	$profile_img = $media->data->caption->from->profile_picture;
	$img = $media->data->images->standard_resolution->url;
	$username = $media->data->caption->from->username;
	$count_comment = $media->data->comments->count;
	$count_likes = $media->data->likes->count; 
	$in_id = $media->data->id;
	$text = str_replace('"',"'",$text);
	$text = removeEmoji($text);
	echo $img;
	exit;
	$sql = 'insert into g5_insta set
		in_url ="'.$link.'",
		in_text="'.$text.'",
		in_img="'.$img.'",
		in_name="'.$username.'",
		in_profile="'.$profile_img.'",
		in_id="'.$in_id.'",
		in_cnt_comments="'.$count_comment.'",
		in_cnt_likes="'.$count_likes.'",
		in_datetime="'.$time.'",
		in_unuse="1"';
		echo $sql;
	//sql_query($sql);
	function removeEmoji($text) {

    $clean_text = "";

    // Match Emoticons
    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
    $clean_text = preg_replace($regexEmoticons, '', $text);

    // Match Miscellaneous Symbols and Pictographs
    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clean_text = preg_replace($regexSymbols, '', $clean_text);

    // Match Transport And Map Symbols
    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
    $clean_text = preg_replace($regexTransport, '', $clean_text);

    // Match Miscellaneous Symbols
    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
    $clean_text = preg_replace($regexMisc, '', $clean_text);

    // Match Dingbats
    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
    $clean_text = preg_replace($regexDingbats, '', $clean_text);

    return $clean_text;
}
	 ?>
  </body>
</html>