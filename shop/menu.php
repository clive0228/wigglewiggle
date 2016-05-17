
<div id="loading">
    <div id="heart_loading">
        <img src="http://artshare.speedgabia.com/wiggle_new_web/heart_loading.png" width="100%">
    </div>
</div>
<div class="menu">
    <div id="menu_logo">
        <a href="/shop/main.php"><img src="http://artshare.speedgabia.com/wiggle_new_web/menu_logo.png" width="100%"/></a>
    </div>
    <div id="menu_list">
        <ul class="menu_ul">
            <?php if ($is_member) { ?>
            <li id="menu_login"><a href="/shop/mypage.php">MY PAGE</a></li>
            <li class="divider" id="menu_join"><a href="/bbs/logout.php?url=shop">LOG OUT</a></li>
            <?php } else { ?>
            <li id="menu_login"><a href="/bbs/login.php">LOG IN</a></li>
            <li class="divider" id="menu_join"><a href="/bbs/register_form.php">JOIN</a></li>
            <?php } ?>
            <li><a href="/shop/aboutus.php">ABOUT US</a></li>
            <li><a href="/shop/list.php?ca_id=10">PRODUCTS</a></li>
            <li><a href="/shop/stockist.php">STOCKISTS</a></li>
            <li><a href="/shop/street.php">STREET PEOPLE</a></li>
            <li class="divider"><a href="/insta">#WIGGLE WIGGLE</a></li>
            <li><a href="/shop/cart.php">CART</a></li>
            <li><a href="/shop/cart.php">WISHLIST</a></li>
            <li class="divider"><a href="/shop/orderinquiry.php">ORDER</a></li>
            <li><a href="/bbs/board.php?bo_table=qa">Q&A</a></li>
            <li><a href="/bbs/board.php?bo_table=notice">NOTICE</a></li>
            <li><a href="/shop/itemuselist.php">REVIEW</a></li>
        </ul>
    </div>
    <div id="menu_footer">
        <a href="http://instagram.com/wigglewiggle.ny" target="_blank"><img src="http://artshare.speedgabia.com/wiggle_new_web/menu_insta.png" width="100%"></a>
    </div>
</div>