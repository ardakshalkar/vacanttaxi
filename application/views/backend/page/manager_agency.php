<h2>
	<?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_users','Управление Администраторами',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Управление агентством</h3>
<table>
<?php foreach($users->result() as $user): ?>
<tr>
<td><?php echo $user->firstname; ?></td>
<td class="action">
   <?php echo anchor('backend/view_employer/'.$user->id,
                            'Просмотр',array('class'=>'view')); ?>
   
   <?php echo anchor('backend/edit_employer/'.$user->id,
                            'Редактировать',array('class'=>'edit')); ?>
                            
   <?php echo anchor('backend/manage_employers/'.$user->id,
                            'Удалить',array('class'=>'delete')); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<br/>
</div>

<div class="clear"></div>
