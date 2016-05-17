<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<section id="bo_v_ans">
    
        <h1 id="bo_v_title"style="border-bottom:2px solid #000;padding-bottom:5px;">
            답변 : <?php echo get_text($answer['qa_subject']); ?>
        </h1>

    <div id="ans_datetime">
        <?php echo $answer['qa_datetime']; ?>
    </div>

    <div id="ans_con">
        <?php echo conv_content($answer['qa_content'], $answer['qa_html']); ?>
    </div>

    <div id="ans_add">
        <?php if($answer_update_href) { ?>
        <a href="<?php echo $answer_update_href; ?>" class="btn_b01">답변수정</a>
        <?php } ?>
        <?php if($answer_delete_href) { ?>
        <a href="<?php echo $answer_delete_href; ?>" class="btn_b01" onclick="del(this.href); return false;">답변삭제</a>
        <?php } ?>
    </div>
</section>