<?
include_once("./_common.php");
exit;
$mb_id       = $_GET[mb_id_];
$mb_password = $_GET[mb_password_];

$mb_password = sql_password($mb_password);

$row = sql_fetch("select mb_no from g5_member where mb_id='$mb_id' and mb_password='$mb_password'");
if($row[mb_no]){
?>
<script type="text/javascript">
	parent.document.getElementById("plogin").submit();
</script>
<?	
}else{
?>
<script type="text/javascript">
	alert("E-MAIL 혹은 PASSWORD가 정확하지 않습니다. <?=$mb_id?> 1 <?=$mb_password?>");
</script>
<? } ?>
