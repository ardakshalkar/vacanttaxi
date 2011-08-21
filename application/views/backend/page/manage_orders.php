<?php
$beaconpush->add_channel($company);
echo $beaconpush->embed(array('log' => TRUE, 'user' => $this->session->userdata['admin_id']	));
?>
<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_orders','Заказы',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?= $orders;?>

<br/>
<input type="text" id="date-range"/>

</div>

<div class="clear"></div>

