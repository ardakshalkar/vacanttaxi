<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_dispatchers','Диспетчера',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?php if($dispatchers->num_rows() > 0): ?>
	<table>
	<?php foreach($dispatchers->result() as $row): ?>
	<tr>
		<td><?php echo $row->dname; ?></td>
        <td class="action">
               <?php echo anchor('backend/view_dispatcher/'.$row->user_id,
			   							'Просмотр',array('class'=>'view')); ?>
               
               <?php echo anchor('backend/edit_dispatcher/'.$row->user_id,
			   							'Ред.',array('class'=>'edit')); ?>
                                        
               <?php echo anchor('backend/manage_dispatchers/'.$row->user_id,
			   							'Удалить',array('class'=>'delete')); ?>
        </td>
    </tr>
	<?php endforeach; ?>
    </table>
<?php endif; ?>
<br/>
</div>

<div class="clear"></div>
