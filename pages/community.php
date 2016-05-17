<?php
$pageId = "community";
include_once('./_common.php');
include_once(G5_PATH.'/_head.php');
?>
<div>
	<div style="float:left;width:490px">
		<div style="width:100%;border-bottom:2px solid #000">
			<div style="padding:0 0 2px 5px"><a href="<?php echo G5_URL; ?>/bbs/board.php?bo_table=notice"><span class="txts t3" style="background-position-y:-100px">공지사항</span></a></div>	
		</div>
		<div style="padding:10px;height:120px">
			<?php echo latest("shop_basic","notice",7, 30); ?>
		</div>
	</div>
	<div style="float:right;width:490px">
		<div style="width:100%;border-bottom:2px solid #000">
			<div style="padding:0 0 2px 5px"><a href="<?php echo G5_URL; ?>/bbs/qalist.php"><span class="txts t3" style="background-position-y:-120px">Q&A</span></a></div>	
		</div><div style="padding:10px;height:120px">
			<?php
				$sql = " select * from g5_qa_content where qa_type='0' order by qa_id desc limit 0,7";
				$result = sql_query($sql);
				for ($i=0; $row = sql_fetch_array($result); $i++) {
					$list[$i][subject] = $row[qa_subject];
					$list[$i][datetime] = substr($row[qa_datetime],0,10);
					$list[$i][href] = G5_URL."/bbs/qaview.php?qa_id=".$row[qa_id];
				}
			?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<?php for ($i=0; $i<count($list); $i++) {  ?>
			        <tr>
			        	<td width="400" height="23" style="color:#727272;font-size:11px">
			            <?php
			            //echo $list[$i]['icon_reply']." ";
			            echo "<a href=\"".$list[$i]['href']."\">";
			            if ($list[$i]['is_notice'])
			                echo "<strong>".$list[$i]['subject']."</strong>";
			            else
			                echo $list[$i]['subject'];
			
			            if ($list[$i]['comment_cnt'])
			                echo $list[$i]['comment_cnt'];
			
			            echo "</a>";
			
			            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
			            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
			
			            if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
			            if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
			            if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
			            if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
			            if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
			             ?>
			        	</td>
			        	<td width="90" align="right" style="color:#727272;font-size:11px"><?=$list[$i][datetime]?></td>
			        </tr>
			    <?php }  ?>	
			</table>
		</div>
	</div>
	<div class="clr"></div>
</div>
<div style="padding-top:50px">
	<div style="float:left;width:490px">
		<div style="width:100%;border-bottom:2px solid #000">
			<div style="padding:0 0 2px 5px"><a href="<?php echo G5_URL; ?>/bbs/board.php?bo_table=free"><span class="txts t3" style="background-position-y:-140px">게시판</span></a></div>	
		</div>
		<div style="padding:10px;height:120px">
			<?php echo latest("shop_basic","free",7, 30); ?>
		</div>
	</div>
	<div style="float:right;width:490px">
		<div style="width:100%;border-bottom:2px solid #000">
			<div style="padding:0 0 2px 5px"><a href="<?php echo G5_URL; ?>/shop/itemuselist.php"><span class="txts t3" style="background-position-y:-160px">사용후기</span></a></div>	
		</div>
		<div style="padding:10px;height:120px">
			<?php
				$sql = " select * from g5_shop_item_use where is_confirm='1' order by is_id desc limit 0,7";
				$result = sql_query($sql);
				for ($i=0; $row = sql_fetch_array($result); $i++) {
					$list[$i][subject] = $row[is_subject];
					$list[$i][datetime] = substr($row[is_time],0,10);
					$list[$i][href] = G5_URL."/shop/itemuseview.php?is_id=".$row[is_id];
				}
			?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<?php for ($i=0; $i<count($list); $i++) {  ?>
			        <tr>
			        	<td width="400" height="23" style="color:#727272;font-size:11px">
			            <?php
			            //echo $list[$i]['icon_reply']." ";
			            echo "<a href=\"".$list[$i]['href']."\">";
			            if ($list[$i]['is_notice'])
			                echo "<strong>".$list[$i]['subject']."</strong>";
			            else
			                echo $list[$i]['subject'];
			
			            if ($list[$i]['comment_cnt'])
			                echo $list[$i]['comment_cnt'];
			
			            echo "</a>";
			
			            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
			            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
			
			            if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
			            if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
			            if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
			            if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
			            if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
			             ?>
			        	</td>
			        	<td width="90" align="right" style="color:#727272;font-size:11px"><?=$list[$i][datetime]?></td>
			        </tr>
			    <?php }  ?>	
			</table>
		</div>
	</div>
	<div class="clr"></div>
</div>

<?php
include_once(G5_PATH.'/_tail.php');
?>
