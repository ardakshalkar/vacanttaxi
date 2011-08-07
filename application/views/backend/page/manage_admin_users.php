<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_admin_users/0','Упраление администраторами',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?php echo form_open('backend/add_admin_user',array('class'=>'jNice')); ?>
<?php echo form_hidden('add_user','add_user'); ?>
<?php echo form_submit('submit','Добавить'); ?>
<?php echo form_close(); ?>
<br/><br/><br/>
<?php if($query->num_rows() > 0): ?>
    <table cellpadding="0" cellspacing="0">
    <?php foreach($query->result() as $row): ?>
        <tr>
            <td><?php echo $row->username; ?></td>
            <td class="action">
               <?php echo anchor('backend/view_admin_user/'.$this->uri->segment(3).'/'.$row->id,
			   							'Просмотр',array('class'=>'view')); ?>
               
               <?php echo anchor('backend/manage_admin_user/'.$this->uri->segment(3).'/'.$row->id,
			   							'Редактировать',array('class'=>'edit')); ?>
                                        
               <?php echo anchor('backend/manage_admin_users/'.$this->uri->segment(3).'/'.$row->id,
			   							'Удалить',array('class'=>'delete')); ?>
            </td>
        </tr>  
    <?php endforeach; ?>
    </table>
<?php else: ?>
	<br/>Нет пользователей<br/>
<?php endif; ?>
<br/>
</div>

<div class="clear"></div>
