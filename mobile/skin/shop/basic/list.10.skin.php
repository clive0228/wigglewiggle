<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>
<!-- 상품진열 10 시작 { -->
<?php
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i == 0) {
        if ($this->css) {
            echo "<ul id=\"sct_wrap\" class=\"{$this->css}\">\n";
        } else {
            echo "<ul id=\"sct_wrap\" class=\"sct sct_10\">\n";
        }
    }
	
	$divId = "id='divLeft'";
	if($i % 2 == 1){
		$divId = "id='divRight'";
	}
	
    echo "<li class=\"sct_li\">\n";
	echo "<div $divId>";
    if ($this->href) {
        echo "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_icon) {
        echo "<div class=\"sct_icon\">".item_icon($row)."</div>\n";
    }

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

	

    echo "<div class=\"sct_txt\" style='padding-bottom:30px'>";
        echo "<div style='float:left;font-weight:bold;font-size:14px'><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
        echo stripslashes($row['it_name'])."\n";
        echo "</a></div>\n";
		echo "<div style='float:right;font-weight:bold;font-size:14px'>".display_price(get_price($row), $row['it_tel_inq'])."</div>";
	echo "</div>";

    if ($this->view_it_basic && $row['it_basic']) {
        echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
    }


    if ($this->href) {
        echo "</a>\n";
    }
	echo "</div>";
    echo "</li>\n";
}

if ($i > 0) echo "</ul>\n";

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->

<script>
$(function() {
    $("#sct_wrap").fancyList("li.sct_li", "sct_clear");
});
</script>