<?php include("header.php"); ?>

<h1><?=$this->lang->line('ui_category_management_label')?></h1>

<table class="adminTable">

<tr align="center" bgcolor="lightgray">
    <td><?=$this->lang->line('ui_category_name_label')?></td>
    <td><?=$this->lang->line('ui_actions_label')?></td>
</tr>

<tr>
    <?=form_open(events_url('categories/add/'))?> <!--<form action="categories/add/">-->
    <td><?=form_input('name', "")?></td> <!--<input type="text" name="name" value="" />-->
    <td align="left"><?=form_submit('add_category', $this->lang->line('ui_add_button'))?></td>
    <?=form_close();?>
</tr>

<?php foreach ($categories as $category): ?>
<tr>
    <?=form_open(events_url('categories/edit/'))?>
    <?=form_hidden('category_id', $category->id)?>
    <td>
        <?=form_input('name', $category->name)?>
    </td>
    <td align="left">
        <?=form_submit('edit_category', $this->lang->line('ui_edit_button'))?>
        <a href='<?=events_url('categories/delete?category_id=').$category->id?>'>
        <span class="deleteIcon"><?=img('images/delete_icon.png')?></span></a>
    </td>
    <?=form_close();?>
</tr>
<?php endforeach; ?>
</table>

<?php include("footer.php"); ?>
