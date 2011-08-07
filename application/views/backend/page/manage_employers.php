<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_employers','Работодатели',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?php if($users->num_rows() > 0): ?>
	<table>
	<?php foreach($users->result() as $row): ?>
	<tr>
		<td><?php echo $row->username; ?></td>
        <td class="action">
               <?php echo anchor('backend/view_employer/'.$row->id,
			   							'Просмотр',array('class'=>'view')); ?>
               
               <?php echo anchor('backend/edit_employer/'.$row->id,
			   							'Ред.',array('class'=>'edit')); ?>
                                        
               <?php echo anchor('backend/manage_employers/'.$row->id,
			   							'Удалить',array('class'=>'delete')); ?>
        </td>
    </tr>
	<?php endforeach; ?>
    </table>
<?php endif; ?>
<br/>
</div>

<div class="clear"></div>
