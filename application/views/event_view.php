<?php include("header.php"); ?>

<div id="eventForm" class="eventForm">

    <?php
    $is_edit = $current_action === 'show_edit';
    $form_action = $is_edit ? 'events/edit/' : 'events/add/';
    $category_value = $is_edit ? $event->category_id : array();
    $name_value = $is_edit ? $event->name : '';
    $description_value = $is_edit ? $event->description : '';
    ?>

    <?=form_open(events_url($form_action))?>
    <?php if ($is_edit) : ?>
    <?=form_hidden('event_id', $event->id)?>
    <?php endif; ?>
    <div class="eventNameCategoryHolder">
        <?=$this->lang->line('ui_category_label')?>: <?=form_dropdown('category_id', $categories, $category_value, "class='eventCategoryDropdown'")?>
        <?=$this->lang->line('ui_category_name_label')?>: <?=form_input(array('name' => 'name', 'value' => $name_value, 'class' => 'eventNameInput'))?>
    </div>
    <?=form_textarea(array('name' => 'description', 'class' => 'eventDescriptionArea', 'value' => $description_value))?>
    <?=form_submit('add_event', $this->lang->line('ui_save_event_button'))?>
    <?=form_close();?>
</div>

<?php include("footer.php"); ?>

