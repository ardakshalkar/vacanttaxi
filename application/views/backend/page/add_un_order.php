<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/add_un_order','Добавить Заказ',array('class'=>'active'));?>
</h2>

<div id="main"><br/>
<h3>Добавить заказ</h3>

<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/add_un_order/","class='jNice'"); ?>
<?php echo form_hidden("add_un_order","add_un_order"); ?>
<p>
    <label>Имя:</label>
    <?php 
		echo form_input(array('name'=>'add_name','class'=>'text-long'));
	?>
</p>
<p>
    <label>Сообщение:</label>
    <?php 
		echo form_input(array('name'=>'add_message','class'=>'text-long'));
	?>
</p>
<p>
    <label>Контакты:</label>
    <?php echo form_input(array('name'=>'add_contacts','class'=>'text-long')); ?>
</p>
<p>
    <label>Откуда:</label>
    <?php echo form_input(array('name'=>'add_from','class'=>'text-long')); ?>
</p>
<p>
    <label>Куда:</label>
    <?php echo form_input(array('name'=>'add_to','class'=>'text-long')); ?>
</p>
<p>
    <label>Тип:</label>
    <?php
    $options = array('0'  => 'Клиент',
                  '1'    => 'Таксист');
    $t='class="text-medium"';
	echo form_dropdown('add_type', $options, '0', $t);
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
