<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_users/0','Пользователи',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?php if($users->num_rows() > 0): ?>
	<table>
	<?php foreach($users->result() as $row): ?>
	<tr>
		<td><?php echo $row->username; ?></td>
        <td class="action">
		   <?php echo anchor('backend/view_agency/'.$row->id,
                                    'Просмотреть',array('class'=>'view')); ?>
           
           <?php echo anchor('backend/edit_agency/'.$row->id,
                                    'Редактировать',array('class'=>'edit')); ?>
                                    
           <?php echo anchor('backend/manage_agencies/'.$row->id,
                                    'Удалить',array('class'=>'delete')); ?>
        </td>
    </tr>
	<?php endforeach; ?>
    </table>
<?php endif; ?>
<br/>
</div>

<div class="clear"></div>