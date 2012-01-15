<?php include("header.php"); ?>

<h1><?=$this->lang->line('ui_user_management_label')?></h1>

<table class="adminTable">

<tr align="center" bgcolor="lightgray">
    <td><?=$this->lang->line('ui_user_login_label')?></td>
    <td><?=$this->lang->line('ui_user_password_label')?></td>
    <td><?=$this->lang->line('ui_user_name_label')?></td>
    <td><?=$this->lang->line('ui_user_surname_label')?></td>
    <td><?=$this->lang->line('ui_user_role_label')?></td>
    <td><?=$this->lang->line('ui_actions_label')?></td>
</tr>

<tr>
    <?=form_open(events_url('users/add/'))?>
    <td><?=form_input('login', '')?></td>
    <td><?=form_password('password', '')?></td>
    <td><?=form_input('name', '')?></td>
    <td><?=form_input('surname', '')?></td>
    <td><?=form_dropdown("role_id", $roles, array())?></td>
    <td align="left"><?=form_submit('add_user', $this->lang->line('ui_add_button'))?></td>
    <?=form_close();?>
</tr>

<?php foreach ($users as $user): ?>
<tr>
    <?=form_open(events_url('users/edit/'))?>
    <?=form_hidden('user_id', $user->id)?>
    <td><?=$user->login?></td>
    <td>*****</td>
    <td><?=form_input('name', $user->name)?></td>
    <td><?=form_input('surname', $user->surname)?></td>
    <td><?=form_dropdown("role_id", $roles, $user->role_id)?></td> <!--<select><option>user</option><option>admin</option></select>-->
    <!-- array("id" => "value") array("1" => "user", "2" => "admin") -->
    <td align="left">
        <?=form_submit('edit_user', $this->lang->line('ui_edit_button'))?>
        <a href='<?=events_url("users/delete?user_id=").$user->id?>'>
        <span class="deleteIcon"><?=img('images/delete_icon.png')?></span></a>
    </td>
    <?=form_close();?>
</tr>
<?php endforeach; ?>
</table>

<?php include("footer.php"); ?>
