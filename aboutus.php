<?php
include_once('./_common.php');
include_once(G5_SHOP_PATH.'/shop.head.php');
?>		
<link rel="stylesheet" href="<?php echo G5_URL; ?>/css/supersized.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo G5_URL; ?>/theme/supersized.shutter.css" type="text/css" media="screen" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo G5_URL; ?>/js/jquery.easing.min.js"></script>

<script type="text/javascript" src="<?php echo G5_URL; ?>/js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="<?php echo G5_URL; ?>/theme/supersized.shutter.min.js"></script>

<script type="text/javascript">
	jQuery(function($){
		$.supersized({
			// Functionality
			slide_interval          :   3000,		// Length between transitions
			transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed		:	700,		// Speed of transition
													   
			// Components							
			slides 					:  	[			// Slideshow Images
					{image : '<?php echo G5_URL; ?>/images/aboutus.png', title : 'Image01', thumb : '', url : '#'}
										]
			
		});
		
		$(window).scroll(function () {
			
			if($(window).scrollTop() >130){
				$('html,body').delay(1500).animate({scrollTop:0},'slow');

			}
		});
    });
    
</script>

<?php
include_once(G5_SHOP_PATH.'/shop.tail.php');
?>