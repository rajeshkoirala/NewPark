<link rel="stylesheet" href="km_lib/css/km-style.css"/>
<?php require "km_lib/km_lib.php" ?>

<div style="width: 300px">
    <?php echo kmBegin('123') ?>
    <div>Title<?php echo kmText('tit'); ?></div>
    <div><?php echo kmImage('course_img') ?></div>
    <?php /*while (kmLoop()) : */ ?><!--
        <hr/>
        <div>
            <div>Profile Pic<?php /*echo kmImage('profile_pic') */ ?></div>
            <div>First Name<?php /*echo kmText('first_name'); */ ?></div>
            <div>Last Name<?php /*echo kmText('last_name'); */ ?></div>
            <div>Tel<?php /*echo kmTextArea('tel1'); */ ?></div>
            <?php /*echo kmBtnClose() */ ?>
        </div>

    --><?php /*endwhile; */ ?>

    <?php while (kmLoop()) : ?>
        <div class="km-loop-div">
            <?php echo kmBtnClose() ?>
            <div>Address<?php echo kmText('address'); ?></div>
            <div>Tel<?php echo kmText('tel'); ?></div>
            <!--<div>
            <?php /*echo kmEditor('my-editor'); */ ?>
        </div>-->
        </div>
    <?php endwhile; ?>

    <!--<div><?php /*echo kmImage('course_img2') */ ?></div>-->

    <div><?php echo kmSelectBox('country', array('NP' => 'Nepal', 'IND' => 'India')); ?></div>
    <div>
        <?php echo kmSubmit(); ?>
    </div>

    <!--<input type="submit" value="Submit">-->
    <?php echo kmEnd() ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
<script src="km_lib/js/km-scripts.js"></script>



<?php include "km_lib/km_lib.php"; ?>
<?php
    $data = kmGetData('123', 'tit');
    $data = kmGetLoopData('1231', array('address', 'tel'));
    var_dump($data);
?>


