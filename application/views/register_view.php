<?php include("header.php"); ?>

<div class='registerFormContainer'>

<div class='registerForm'>
    <div class='registerFormTitle'><?=$this->lang->line('ui_complete_registration_label')?>:</div>
    <?=form_open(events_url('users/do_register/'))?>
        <table class="registerFormContent">
            <tr><td width='80px'><?=$this->lang->line('ui_user_login_label')?>:</td><td><?=form_input('login', '')?></td></tr>
            <tr><td><?=$this->lang->line('ui_user_password_label')?>:</td><td><?=form_password('password')?></td></tr>
            <tr><td><?=$this->lang->line('ui_user_name_label')?>:</td><td><?=form_input('name', '')?></td></tr>
            <tr><td><?=$this->lang->line('ui_user_surname_label')?>:</td><td><?=form_input('surname', '')?></td></tr>
            <tr><td></td><td><input class='loginFormButton' type='submit' value='<?=$this->lang->line('ui_register_button')?>' /></td></tr>
        </table>
    <?=form_close();?>
</div>

</div>

<?php include("footer.php"); ?>
