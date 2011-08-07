<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_un_orders','Заказы',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<table>
<?php foreach($orders->result() as $order): ?>
<tr>
	<td><?php echo $order->name."<br/>"; ?></td>
	<td><?php echo "A:".$order->from."<br/>"; ?></td>
    <td><?php echo "B:".$order->to."<br/>"; ?></td>
    <td><?php echo $order->date."<br/>"; ?></td>
    <td class="action">       
       <?php echo anchor('backend/edit_un_order/'.$order->id,
                                'Редактировать',array('class'=>'edit')); ?>
                                
       <?php echo anchor('backend/manage_un_orders/'.$order->id,
                                'Удалить',array('class'=>'delete')); ?>
    </td>
<tr/>
<?php endforeach; ?>
</table><br/>
</div>

<div class="clear"></div>