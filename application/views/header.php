<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?=link_tag('css/events.css')?>
    <script type="text/javascript" src="<?=events_url('js/events.js')?>"></script>

    <title><?=$this->lang->line('ui_title')?></title>
</head>

<body onload="applicationLoad()">

<div style='text-align: center'>
<div class='mainPage'>

<?php $current_user = $this->session->userdata('current_user') ?>
<?php $current_controller = $this->uri->segment(1) ?>
<?php $current_action = $this->uri->segment(2) ?>

<?php if($current_user) : ?>
<div class='loginInfo'>
    <span class='loginUserId'>[<?=$current_user->login?>]</span> <?=$current_user->name?> <?=$current_user->surname?>
    <input type='button' value='<?=$this->lang->line('ui_logout_button')?>' onclick='open_url("<?=events_url('users/logout')?>")' />
</div>
<?php endif; ?>

<?php if($this->session->flashdata('message')) : ?>
<div class='messagePanel'><?=$this->session->flashdata('message')?></div>
<?php endif; ?>

<?php if(!$current_user && !($current_controller === 'users' && $current_action === 'register'))  : ?>
<div class='loginForm'>
    <?=form_open(events_url('users/login/'))?>
        <table>
            <tr>
                <td><?=$this->lang->line('ui_login_label')?>:</td>
                <td><?=$this->lang->line('ui_password_label')?>:</td>
                <td><input class='loginFormButton' type='button' value='<?=$this->lang->line('ui_register_button')?>' onclick="window.location.href='users/register'" /></td></tr>
            <tr>
                <td><?=form_input('login', set_value('login'))?></td>
                <td><?=form_password('password')?></td>
                <td><?=form_submit(array('name' => 'login_form', 'value' => $this->lang->line('ui_login_button'), 'class' => 'loginFormButton'))?></td></tr>
        </table>
    <?=form_close();?>
</div>
<?php endif; ?>

<div class='menuPanel'>
    <div class='menuItemLeft' onclick='open_url("<?=events_url('events')?>")'><?=$this->lang->line('ui_events_button')?></div>
    <?php if(is_admin($current_user)) : ?>
    <div class='menuItemLeft' onclick='open_url("<?=events_url('users')?>")'><?=$this->lang->line('ui_manage_users_button')?></div>
    <div class='menuItemLeft' onclick='open_url("<?=events_url('categories')?>")'><?=$this->lang->line('ui_manage_categories_button')?></div>
    <?php endif; ?>

    <?php if($current_user && $current_controller === 'events' && !$current_action) : ?>
    <div class='menuItemRight' onclick='open_url("<?=events_url('events/show_add')?>")'><?=$this->lang->line('ui_new_event_button')?></div>
    <?php endif; ?>
</div>
    
<div class='menuPanelEnd'></div>



