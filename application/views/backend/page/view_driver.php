<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/manage_drivers','Водители'); ?>  &raquo; 
    <?php echo anchor('/backend/view_driver'.$id,'Водители',array('class'=>'active')); ?>
</h2>

<div id="main">
<h3>Просмотр Водителя</h3>
<fieldset>
<table style="width:80%;">
<?php foreach($userinfo1 as $key=>$info): ?>
<tr>
	<td><?php echo $key; ?></td>
    <td><?php echo $info; ?></td>
</tr>
<?php endforeach; ?>
<?php if(isset($userinfo2)) {?>
<?php foreach($userinfo2 as $key=>$info): ?>
<tr>
<?php if($key != 'id' && $key != 'user_id') {?>
	<td><?php echo $key; ?></td>
    <td><?php echo $info; ?></td>
<?php }?>
</tr>
<?php endforeach; ?>
<?php } ?>
<?php if(isset($userinfo3)) {?>
<?php foreach($userinfo3->result() as $info): ?>
<tr>
	<td>Car: <?php echo $info->model; ?></td> 
<td class="action">
               <?php echo anchor('backend/view_car/'.$info->id,
			   							'Просмотр',array('class'=>'view')); ?>
               
               <?php echo anchor('backend/edit_car/'.$info->id,
			   							'Редактировать',array('class'=>'edit')); ?>
                                        
               <?php echo anchor('backend/delete_car/'.$info->id,
			   							'Удалить',array('class'=>'delete')); ?>
</td>
</tr>
<?php endforeach; ?>
<?php } ?>

</table>
</fieldset>
<br/>
<?php echo form_open("backend/manage_drivers"); ?>
<?php echo form_submit("back","Назад","class='button-submit1'"); ?>
<?php echo form_close(); ?>
<br/>
</div>

<div class="clear"></div>
