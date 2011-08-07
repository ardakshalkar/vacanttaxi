<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_drivers','Водители',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Добавить Водителя</h3>
<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open_multipart("backend/add_driver",array('class'=>'jNice')); ?>
<?php echo form_hidden('add_driver','add_driver'); ?>
<p>
<label>Пользователь:</label>
	<?php 
    echo 
    form_input(array('name'=>'add_username','class'=>'text-long','value'=>set_value('add_username'))); 
    ?>
</p>

<p>
	<label>Почта:</label>
	<?php 
    echo form_input(array('name'=>'add_email','class'=>'text-long','value'=>set_value('add_email'))); 
    ?>
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
	<label>ФИО:</label>
	<?php 
    echo form_input(array('name'=>'add_cname','class'=>'text-long','value'=>set_value('add_cname'))); 
    ?>
</p>
<p>
	<label>Местоположение:</label>
	<?php 
    echo form_dropdown('add_city',$city_list); 
    ?>
</p>

<p>
	<label>Категория:</label>
	<?php 
    echo form_dropdown('add_category',array("5100"=>"По городу",
								   "5110"=>"На природу","5111"=>"Между городами")); 
    ?>
</p>
<p>
	<label>Опыт работы:</label>
	<?php 
    echo form_input(array('name'=>'add_experience','class'=>'text-small','value'=>set_value('add_experience'))); 
    ?>
</p>
<p>
	<label>График работы:</label>
    <?php echo form_dropdown("add_schedule",array("1"=>"На один раз",
								   "2"=>"Не часто","3"=>"Постоянно")); ?>
</p>
<p>
	<label>Курящий:</label>
    <?php echo form_dropdown("add_smoke",array("0"=>"Нет",
								   "2"=>"Да")); ?>
</p>
<p>
	<label>Статус:</label>
    <?php echo form_dropdown("add_status",array("4111"=>"Заправка",
								   "4112"=>"Свободен","4113"=>"Занят")); ?>
</p>
<p>
	<label>Дом телефон:</label>
    <?php
    echo form_input(array('name'=>'add_home_phone','class'=>'text-long','value'=>set_value('add_home_phone')));
	?>
</p>
<p>
	<label>Сотовый:</label>
    <?php
    echo form_input(array('name'=>'add_mobile_phone','class'=>'text-long','value'=>set_value('add_mobile_phone')));
	?>
</p>
<p>
	<label>О себе:</label>
    <?php
    echo form_textarea(array('name'=>'add_about','class'=>'text-long','value'=>set_value('add_about')));
	?>
</p>
<p>
	<label>Адрес:</label>
    <?php
    echo form_input(array('name'=>'add_address','class'=>'text-long','value'=>set_value('add_address')));
	?>
</p>
<p>
	<?php echo form_submit('submit','Принять'); ?>
    <?php echo form_submit('cancel','Отменить'); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>


<div class="clear"></div>
