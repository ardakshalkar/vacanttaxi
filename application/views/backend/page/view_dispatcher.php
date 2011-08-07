<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/manage_dispatchers','Диспетчера'); ?>  &raquo; 
    <?php echo anchor('/backend/view_dispatcher/'.$id,'Диспетчер',array('class'=>'active')); ?>
</h2>

<div id="main">
<h3>Просмотр Диспетчера</h3>
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
<br/>
<?php echo form_open("backend/manage_dispatchers"); ?>
<?php echo form_submit("back","Назад","class='button-submit1'"); ?>
<?php echo form_close(); ?>
<br/>
</fieldset>
</div>

<div class="clear"></div>
