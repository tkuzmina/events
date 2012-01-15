<?php include("header.php"); ?>

<?php include("event.php"); ?>

<div id="commentForm" class="commentForm">
    <?php if($current_user) : ?>
    <?=form_open(events_url('comments/add/'))?>
        <?=form_textarea(array("name" => "text", "class" => "commentArea"))?>
        <?=form_hidden('event_id', $event->id)?>
        <?=form_submit('add_comment', $this->lang->line('ui_add_comment_button'))?>
        <input type='button' value='<?=$this->lang->line('ui_cancel_button')?>' onclick="hideCommentForm()" />
    <?=form_close();?>
    <?php endif; ?>
</div>

<?php foreach ($comments as $comment): ?>
<div class="comment">
    <div class="commentHeader">
        <span class='loginUserId'>[<?=$comment->user_login?>]</span> <?=$comment->user_name?> <?=$comment->user_surname?>
        <?php if(is_admin($current_user)) : ?>
        <a href='<?=events_url('comments/delete?comment_id=').$comment->id?>'><span class="deleteIcon"><?=img('images/delete_icon.png')?></span></a>
        <?php endif; ?>
    </div>
    <div class="commentBody"><?=$comment->text?></div>
</div>
<?php endforeach; ?>

<?php include("footer.php"); ?>
