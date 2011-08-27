<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/manage_users','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_drivers','Водители',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?php if($users->num_rows() > 0): ?>
	<table>
	<?php foreach($users->result() as $row): ?>
	<tr>
		<td><?php echo $row->username; ?></td>
		<td><?php echo $row->email; ?></td>
        <td class="action">
               <?php echo anchor('backend/add_car/'.$row->id,
			   							'Добавить машину',array('class'=>'view')); ?>
                                        
               <?php echo anchor('backend/view_driver/'.$row->id,
			   							'Просмотр',array('class'=>'view')); ?>
               
               <?php echo anchor('backend/edit_driver/'.$row->id,
			   							'Редактировать',array('class'=>'edit')); ?>
                                        
               <?php echo anchor('backend/manage_drivers/'.$row->id,
			   							'Удалить',array('class'=>'delete')); ?>
        </td>
    </tr>
	<?php endforeach; ?>
    </table>
<?php endif; ?>
<br/>
</div>

<div class="clear"></div>
