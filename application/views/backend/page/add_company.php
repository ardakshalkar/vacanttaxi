<h2>
	<?php echo anchor('/backend/manage_users/0','Users'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_agencies','Agency',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Добавить агентство</h3>

<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/add_company","class='jNice'"); ?>
<?php echo form_hidden('add_company','add_company'); ?>
<p>
    <label>Пользователь:</label>
    <?php echo form_input(array('name'=>'add_username','class'=>'text-long','value'=>set_value('add_username'))); ?>
</p>
<p>
    <label>Почта:</label>
    <?php echo form_input(array('name'=>'add_email','class'=>'text-long','value'=>set_value('add_email'))); ?>
</p>
<p>
    <label>Пароль:</label>
    <?php echo form_password(array('name'=>'add_password','class'=>'text-long')); ?>
</p>
<p>
    <label>Подтвердить:</label>
    <?php echo form_password(array('name'=>'add_confirm','class'=>'text-long')); ?>
</p>
<p>
    <label>Название компании</label>
    <?php echo form_input(array('name'=>'add_name','class'=>'text-long','value'=>set_value('add_name'))); ?>
</p>
<p>
    <label>Количество водителей:</label>
    <?php echo form_input(array('name'=>'add_driver_max','class'=>'text-medium','value'=>set_value('add_amount'))); ?>
</p>
<p>
    <label>Количество диспетчеров:</label>
    <?php echo form_input(array('name'=>'add_dispatcher_max','class'=>'text-medium','value'=>set_value('add_amount'))); ?>
</p>
<p>
	<label>Город:</label>
	<?php 
    echo form_dropdown('add_city',$cities); 
    ?>
</p>
<p>
	<label>Контакты:</label>
    <?php
    echo form_textarea(array('name'=>'add_contacts','class'=>'text-long','value'=>set_value('add_about')));
	?>
</p>
<p>
	<label>О компании:</label>
    <?php
    echo form_textarea(array('name'=>'add_about','class'=>'text-long','value'=>set_value('add_about')));
	?>
</p>
<p>
    <label>Сайт:</label>
    <?php echo form_input(array('name'=>'add_site','class'=>'text-long','value'=>set_value('add_email'))); ?>
</p>
<p>
<?php echo form_submit('submit','Принять'); ?>
<?php echo form_submit('cancel','Отменить'); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>
