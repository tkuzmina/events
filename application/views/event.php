<div class="event">
    <div class="eventHeader">
        <div class="eventTitle">
            <span class="eventTitleCategory">[<?=$event->category_name?>]</span> <span class="eventTitleName"><?=$event->name?></span>
        </div>
        <div class="eventInfo">
            <span class='loginUserId'>[<?=$event->user_login?>]</span> <?=$event->user_name?> <?=$event->user_surname?>
            <?php if(is_owner($current_user, $event)) : ?>
            <a href='<?=events_url('events/show_edit?event_id=').$event->id?>'><span class="deleteIcon"><?=img('images/edit_icon.png')?></span></a>
            <a href='<?=events_url('events/delete?event_id=').$event->id?>'><span class="deleteIcon"><?=img('images/delete_icon.png')?></span></a>
            <?php endif; ?>
        </div>
    </div>

    <?php if(count($event->tags) > 0 || is_owner($current_user, $event)) : ?>
    <div class="eventTags">

        <?php foreach ($event->tags as $tag): ?>
        <?php $delete_tag_url = events_url("tags/delete?tag_id=").$tag->id."&event_id=".$event->id; ?>
        <a href='<?=events_url('events/filter_tag?tag_id=').$tag->id?>'><?=$tag->name?></a>
        <?php if(is_owner($current_user, $event)) : ?>
        <a href='<?=$delete_tag_url?>'><span class="deleteIcon"><?=img('images/delete_icon.png')?></span></a>
        <?php endif; ?>
        <?php endforeach; ?>

        <?php if(is_owner($current_user, $event)) : ?>
        <div class="tagControls">
            <?php
            $tag_form_id = "tagForm_".$event->id;
            $add_tag_link = "addTagLink_".$event->id;
            ?>
            <div id='<?=$tag_form_id?>' class="tagForm">
                <?=form_open(events_url('tags/add/'))?>
                <?=form_input('name', "")?>
                <?=form_hidden('event_id', $event->id)?>
                <?=form_submit('add_tag', $this->lang->line('ui_add_tag_button'))?>
                <input type='button' value='<?=$this->lang->line('ui_cancel_button')?>' onclick="hide('<?=$tag_form_id?>'); show('<?=$add_tag_link?>'); " />
                <?=form_close();?>
            </div>
            <span id='<?=$add_tag_link?>' class="link" onclick="show('<?=$tag_form_id?>'); hide('<?=$add_tag_link?>')"><?=$this->lang->line('ui_add_tag_link')?></span>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="eventDescription"><?=$event->description?></div>
    <div class="eventComments">
        <?=$this->lang->line('ui_comment_count_label')?>: <?=$event->comment_count?>
        <?php if ($current_controller === 'comments') : ?>
            <?php if ($current_user) : ?>
            <span class="link" onclick="showCommentForm()"><?=$this->lang->line('ui_add_comment_link')?></span>
            <?php endif; ?>
        <?php else : ?>
        <a href='<?=events_url("comments?event_id=").$event->id?>'><?=$this->lang->line('ui_view_comments_link')?></a>
        <?php endif; ?>
    </div>

</div>