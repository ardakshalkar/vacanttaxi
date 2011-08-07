<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_employers','Работодатель',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Добавить Диспетчера</h3>

<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/add_dispatcher","class='jNice'"); ?>
<?php echo form_hidden("add_dispatcher","add_dispatcher"); ?>
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
    <label>Имя:</label>
    <?php echo form_input(array('name'=>'add_name','class'=>'text-long','value'=>set_value('add_name'))); ?>
</p>
<p>
    <label>Телефон:</label>
    <?php echo form_input(array('name'=>'add_phone','class'=>'text-long','value'=>set_value('add_phone'))); ?>
</p>
<?php if($this->session->userdata['admin_type'] >= ADMIN):?>
<p>
	<label>Компания:</label>
	<?php 
    echo form_dropdown('add_company',$companies); 
    ?>
</p>
<?php endif;?>
<p>
	<label>График работы:</label>
    <?php echo form_dropdown("add_mode",array("3111"=>"Полный",
								   "3112"=>"Не полный")); ?>
</p>
<p>
    	<?php echo form_submit(array('name'=>'submit','value'=>'Принять')); ?>
        <?php echo form_submit(array('name'=>'cancel','value'=>'Отменить')); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>
