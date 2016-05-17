<?php
exit;
?><div id="popupLogin" class="popup">
	<div style="width:100%;height:37px;background-color:#ffe907">
		<div style="float:left"><img src="<?php echo G5_URL; ?>/images/login_title.jpg" width="94" height="37" border="0"></div>
		<div style="float:right;cursor:pointer" class="close"><img src="<?php echo G5_URL; ?>/images/btn_close.jpg" width="38" height="37" border="0"></div>
		<div class="cls"></div>
	</div>
	<form name="plogin" id="plogin" action="<?php echo G5_URL; ?>/bbs/login_check.php" method="post" onsubmit="return login_submit(this);">
	<div style="padding:60px 50px 0 50px">
		<div style="padding-bottom:25px">
			<div style="float:left;text-align:center;width:250px;"><img src="<?php echo G5_URL; ?>/images/ltitle01.png" width="60" height="15" border="0"></div>
			<div style="float:right;text-align:center;width:250px;font-size:14px" class="noto bold"><img src="<?php echo G5_URL; ?>/images/ltitle01.png" width="48" height="15" border="0"></div>
			<div class="cls"></div>
		</div>
		<div>
			<div style="float:left;width:249px;border-right:1px solid #ccc;">
					<div style="padding-right:20px;float:right">
						<div>
							<div style="float:right"><input type="text" name="mb_id_" id="mb_id_" style="width:195px;height:35px;"></div>
							<div style="float:right;padding:12px 5px 0 0"><img src="<?php echo G5_URL; ?>/images/blit_id.jpg" width="24" height="10" border="0"></div>
							<div class="cls"></div>
						</div>
						<div style="padding-top:5px">
							<div style="float:right"><input type="password" name="mb_password_" id="mb_password_" style="width:195px;height:35px;"></div>
							<div style="float:right;padding:13px 5px 0 0"><img src="<?php echo G5_URL; ?>/images/blit_pw.jpg" width="24" height="9" border="0"></div>
							<div class="cls"></div>
						</div>
						<div style="padding-top:5px">
							<div style="float:left;font-size:10px" class="noto"></div>
							<div style="float:right;font-size:10px" class="noto"><img src="<?php echo G5_URL; ?>/images/find_id_ment.jpg" width="80" height="10" border="0"></div>
							<div class="cls"></div>
						</div>
					</div>
				<div class="cls"></div>
			</div>
			<div style="float:left;width:250px">
				<div style="padding:15px 0 0 20px;text-align:center">
					<img src="<?php echo G5_URL; ?>/images/register_ment.jpg" width="110" height="51" border="0">
				</div>
			</div>
			<div class="cls"></div>
		</div>
		<div>
			<div style="float:left;width:249px;border-right:1px solid #ccc;">
				<div style="padding-right:20px;float:right">
					<div style="padding-top:25px">
						<div style="float:right"><input type="image" src="<?php echo G5_URL; ?>/images/btn_login.jpg" width="214" height="36"></div>
						<div class="cls"></div>
					</div>
				</div>
				<div class="cls"></div>
			</div>
			<div style="float:left;width:250px">
				<div style="padding-left:20px">
					<div style="padding-top:25px">
						<div><a href="<?php echo G5_URL; ?>/bbs/register_form.php"><img src="<?php echo G5_URL; ?>/images/btn_register.jpg" width="214" height="36" border="0"></a></div>
					</div>
				</div>
			</div>
			<div class="cls"></div>
		</div>
	</div>
	</form>
</div>