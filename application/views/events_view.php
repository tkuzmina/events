<?php include("header.php"); ?>

<div class='searchMenu'>

    <?php
    $search_params = $this->session->userdata('search_params');
    $search_category_id = $search_params ? $search_params['category_id'] : '';
    $search_user_login = $search_params ? $search_params['user_login'] : '';
    $search_tag_name = $search_params ? $search_params['tag_name'] : '';
    $search_search_text = $search_params ? $search_params['search_text'] : '';
    ?>

    <div class='searchPanel'>
        <?=form_open(events_url('events/filter/'))?>
        <input type='button' value='<?=$this->lang->line('ui_my_events_button')?>' class='searchButton' onclick='open_url("<?=events_url('events/my_events')?>")' />
        <?=form_submit(array('name' => 'filter', 'value' => $this->lang->line('ui_filter_button'), 'class' => 'searchButton'))?>
        <span class='searchParam'>
            <?=$this->lang->line('ui_filter_by_category_label')?>
            <?=form_dropdown("category_id", $categories, $search_category_id, "class='filterControl'")?>
        </span>
        <span class='searchParam'>
            <?=$this->lang->line('ui_filter_by_username_label')?>
            <?=form_input(array('name' => 'user_login', 'value' => $search_user_login, 'class' => 'filterControl'))?>
        </span>
        <span class='searchParam'>
            <?=$this->lang->line('ui_filter_by_tag_label')?>
            <?=form_input(array('name' => 'tag_name', 'value' => $search_tag_name, 'class' => 'filterControl'))?>
        </span>
        <?=form_close();?>
    </div>

    <div class='searchPanel'>
        <?=form_open(events_url('events/filter/'))?>
        <input type='button' value='<?=$this->lang->line('ui_reset_button')?>' class='searchButton' onclick='open_url("<?=events_url('events/clear_filter')?>")' />
        <?=form_submit(array('name' => 'filter', 'value' => $this->lang->line('ui_search_button'), 'class' => 'searchButton'))?>
        <span class='searchParam'>
            <?=form_input(array('name' => 'search_text', 'value' => $search_search_text, 'class' => 'searchControl'))?>
        </span>
        <?=form_close();?>
    </div>
</div>

<?php foreach ($events as $event): ?>
<?php include("event.php"); ?>
<?php endforeach; ?>

<?php include("footer.php"); ?>
