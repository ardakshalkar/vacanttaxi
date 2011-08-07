<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_un_orders','Заказы',array('class'=>'active'));?>
</h2>

<div id="main"><br/>
<h3>Редактировать Заказ</h3>

<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/edit_un_order/".$id,"class='jNice'"); ?>
<?php echo form_hidden("edit_un_order","edit_un_order"); ?>
<p>
    <label>Имя:</label>
    <?php 
		echo form_input(array('name'=>'edit_name','class'=>'text-long','value'=>$order->name));
	?>
</p>
<p>
    <label>Сообщение:</label>
    <?php 
		echo form_input(array('name'=>'edit_message','class'=>'text-long','value'=>$order->message));
	?>
</p>
<p>
    <label>Контакты:</label>
    <?php echo form_input(array('name'=>'edit_contacts','class'=>'text-long','value'=>$order->contacts)); ?>
</p>
<p>
    <label>Откуда:</label>
    <?php echo form_input(array('name'=>'edit_from','class'=>'text-long','value'=>$order->from)); ?>
</p>
<p>
    <label>Куда:</label>
    <?php echo form_input(array('name'=>'edit_to','class'=>'text-long','value'=>$order->to)); ?>
</p>
<p>
    <label>Тип:</label>
    <?php
    $options = array('0'  => 'Клиент',
                  '1'    => 'Таксист');
    $t='class="text-medium"';
	echo form_dropdown('edit_type', $options, $order->type, $t);
    ?>
</p>
<p>
    	<?php echo form_submit(array('name'=>'submit','value'=>'Принять')); ?>
        <?php echo form_submit(array('name'=>'cancel','value'=>'Отменить')); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>