<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_users','Пользователи',array('class'=>'active')); ?>
</h2>

<div id="main">
    <br/>
<?php if($query === true): ?>
	Выберите одного из пользователей
<?php else: ?>
	<?php if($query->num_rows() > 0): ?>
        <table cellpadding="0" cellspacing="0">
        <?php foreach($query->result() as $row): ?>
            <tr>
                <td><?php echo $row->username; ?></td>
                <td class="action">
                   <?php echo anchor('','Просмотреть',array('class'=>'view')); ?>
                   
                   <?php echo anchor('','Редактировать',array('class'=>'edit')); ?>
                                            
                   <?php echo anchor('','Удалить',array('class'=>'delete')); ?>
                </td>
            </tr>  
        <?php endforeach; ?>
        </table>
    <?php else: ?>
        <br/>Нет доступных пользователей<br/>
    <?php endif; ?>
<?php endif; ?>
<br/>
</div>

<div class="clear"></div>
