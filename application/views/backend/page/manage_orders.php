<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_orders','Заказы',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>

<?= $orders;?>

<br/>
</div>

<div class="clear"></div>

