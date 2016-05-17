<?php
include_once("./_common.php");
require_once 'Instagram.php';
use MetzWeb\Instagram\Instagram;

$instagram = new Instagram('6110dbe0862e43cd8bf15811ec94a84e');


$result = sql_query("select in_id from g5_insta where in_unuse='0'");

while($row=sql_fetch_array($result)){
	$media = $instagram->getMedia($row[in_id]);
	$text = str_replace('"',"'",$media->data->caption->text);
	$text = removeEmoji($text);
	$sql = 'update g5_insta set in_text="'.$text.'" where in_id="'.$row[in_id].'"';
	sql_query($sql);
	
}
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