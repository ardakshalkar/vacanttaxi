<h2>
 <?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/statistics','Заказы',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?php if($report->num_rows() > 0): ?>
 <table>
 <?php foreach($report->result() as $row): ?>
 <tr>
  <td><?php echo $row->name; ?></td>
        <td class="action">
     <?php echo anchor('backend/view_dispatcher/'.$row->id,
                                    'Просмотреть',array('class'=>'view')); ?>
           
           <?php echo anchor('backend/edit_dispatcher/'.$row->id,
                                    'Редактировать',array('class'=>'edit')); ?>
                                    
           <?php echo anchor('backend/delete_dispatcher/'.$row->id,
                                    'Удалить',array('class'=>'delete')); ?>
        </td>
    </tr>
 <?php endforeach; ?>
    </table>
<?php endif; ?>
<br/>
</div>

<div class="clear"></div>