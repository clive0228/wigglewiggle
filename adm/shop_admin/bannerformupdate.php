<?php
$sub_menu = '500500';
include_once('./_common.php');

check_demo();

if ($W == 'd')
    auth_check($auth[$sub_menu], "d");
else
    auth_check($auth[$sub_menu], "w");

@mkdir(G5_DATA_PATH."/banner", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/banner", G5_DIR_PERMISSION);

$bn_bimg      = $_FILES['bn_bimg']['tmp_name'];
$bn_bimg_name = $_FILES['bn_bimg']['name'];

if ($bn_bimg_del)  @unlink(G5_DATA_PATH."/banner/$bn_id");

if ($w=="")
{
    if (!$bn_bimg_name) alert('배너 이미지를 업로드 하세요.');

    sql_query(" alter table {$g5['g5_shop_banner_table']} auto_increment=1 ");

    $sql = " insert into {$g5['g5_shop_banner_table']}
                set
                    bn_url        = '$bn_url',
                    bn_position   = '$bn_position',
                    bn_new_win    = '$bn_new_win',
                    bn_time       = '$now' ";
    sql_query($sql);

    $bn_id = mysql_insert_id();
}
else if ($w=="u")
{
    $sql = " update {$g5['g5_shop_banner_table']}
                set 
                    bn_url        = '$bn_url',
                    bn_position   = '$bn_position',
                    bn_new_win    = '$bn_new_win'
              where bn_id = '$bn_id' ";
    sql_query($sql);
}
else if ($w=="d")
{
    @unlink(G5_DATA_PATH."/banner/$bn_id");

    $sql = " delete from {$g5['g5_shop_banner_table']} where bn_id = $bn_id ";
    $result = sql_query($sql);
}


if ($w == "" || $w == "u")
{
    if ($_FILES['bn_bimg']['name']) upload_file($_FILES['bn_bimg']['tmp_name'], $bn_id, G5_DATA_PATH."/banner");

    goto_url("./bannerform.php?w=u&amp;bn_id=$bn_id");
} else {
    goto_url("./bannerlist.php");
}
?>
