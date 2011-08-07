<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_employees','Работники',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Добавить работника</h3>
<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
<?php echo $image_error_message; ?>
</font>
<?php echo form_open_multipart("backend/add_employee",array('class'=>'jNice')); ?>
<?php echo form_hidden('add_employee','add_employee'); ?>
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
    <label>Фото:</label>
      <input type="file" name="userfile" size="30" />    
</p>
<p>
	<label>Имя:</label>
	<?php 
    echo form_input(array('name'=>'add_firstname','class'=>'text-long','value'=>set_value('add_firstname'))); 
    ?>
</p>

<p>
	<label>Фамилия:</label>
	<?php 
    echo form_input(array('name'=>'add_lastname','class'=>'text-long','value'=>set_value('add_lastname'))); 
    ?>
</p>

<p>
	<label>Очество:</label>
	<?php 
    echo form_input(array('name'=>'add_middlename','class'=>'text-long','value'=>set_value('add_middlename'))); 
    ?>
</p>

<p>
<label>Зарплата:</label>
<?php 
echo form_input(array('name'=>'add_salary','class'=>'text-small','value'=>set_value('add_salary'))); 
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
    echo form_dropdown('add_category',$category_list); 
    ?>
</p>
<p>
	<label>Образование:</label>
	<?php 
    echo form_input(array('name'=>'add_education','class'=>'text-long','value'=>set_value('add_education'))); 
    ?>
</p>
<p>
	<label>Опыт:</label>
	<?php 
    echo form_input(array('name'=>'add_experience','class'=>'text-long','value'=>set_value('add_experience'))); 
    ?>
</p>
<p>
	<label>Навыки:</label>
	<?php 
    echo form_input(array('name'=>'add_experience','class'=>'text-long','value'=>set_value('add_experience'))); 
    ?>
</p>
<p>
	<label>Языки:</label>
	<?php 
    echo form_input(array('name'=>'add_experience','class'=>'text-long','value'=>set_value('add_experience'))); 
    ?>
</p>
<p>
	<label>График работы:</label>
    <?php echo form_dropdown("mode",array("3111"=>"Полный",
								   "3112"=>"Не полный")); ?>
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
	<label>Опубликовано:</label>
    <?php echo form_dropdown("published",array("1"=>"Yes",
								   "0"=>"No")); ?>
</p>
<p>
	<?php echo form_submit('submit','Принять'); ?>
    <?php echo form_submit('cancel','Отменить'); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>
