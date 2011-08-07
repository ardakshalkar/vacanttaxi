<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_companies','Компании',array('class'=>'active')); ?>
</h2>

<div id="main">
<h3>Просмотр Компании</h3>
<fieldset>
<table style="width:80%;">
<?php foreach($userinfo1 as $key=>$info): ?>
<tr>
	<td><?php echo $key; ?></td>
    <td><?php echo $info; ?></td>
</tr>
<?php endforeach; ?>

<?php foreach($userinfo2 as $key=>$info): ?>
<tr>
	<td><?php echo $key; ?></td>
    <td><?php echo $info; ?></td>
</tr>
<?php endforeach; ?>
</table>
</fieldset>
<br/>
<?php echo form_open("backend/manage_companies"); ?>
<?php echo form_submit("back","Назад","class='button-submit1'"); ?>
<?php echo form_close(); ?>
<br/>
</div>

<div class="clear"></div>
