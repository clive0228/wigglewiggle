<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

if($_SESSION["pt_view_today"] != "view") {
	set_session("pt_view_today", "view");
	goto_url("/pt/");
}

include_once(G5_MSHOP_PATH.'/_head.php');
?>
<style type="text/css">
	#hd{
		margin-bottom: 0;
	}
	#container{
		padding: 0;
	}
	#ft{
		margin-top:0;
	}
</style>
<img src="<?php echo G5_URL; ?>/images/aboutus_mobile.jpg" width="100%" border="0">

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>
