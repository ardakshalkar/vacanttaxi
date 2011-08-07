<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_employees','Работники',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Редактировать работника</h3>
<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/edit_employee/".$this->uri->segment(3),"class='jNice'"); ?>
<?php echo form_hidden('edit_employee','edit_employee'); ?>
<p>
<label>Пользователь:</label>
	<?php 
    echo 
    form_input(array('name'=>'add_username','class'=>'text-long','value'=>$info1->username)); 
    ?>
</p>

<p>
	<label>Почта:</label>
	<?php 
    echo form_input(array('name'=>'add_email','class'=>'text-long','value'=>$info1->email)); 
    ?>
</p>

<p>
	<label>Имя:</label>
	<?php 
    echo form_input(array('name'=>'add_firstname','class'=>'text-long','value'=>$info2->firstname)); 
    ?>
</p>

<p>
	<label>Фамилия:</label>
	<?php 
    echo form_input(array('name'=>'add_lastname','class'=>'text-long','value'=>$info2->lastname)); 
    ?>
</p>

<p>
	<label>Очество:</label>
	<?php 
    echo form_input(array('name'=>'add_middlename','class'=>'text-long','value'=>$info2->middlename)); 
    ?>
</p>

<p>
<label>Зарплата:</label>
<?php 
echo form_input(array('name'=>'add_salary','class'=>'text-small','value'=>$info2->salary)); 
?>
</p>

<p>
	<label>Местоположение:</label>
	<?php 
    echo form_dropdown('add_city',$city_list,$info2->city); 
    ?>
</p>

<p>
	<label>Категория:</label>
	<?php 
    echo form_dropdown('add_category',$category_list,$info2->category); 
    ?>
</p>
<p>
	<label>Образование:</label>
	<?php 
    echo form_input(array('name'=>'add_education','class'=>'text-long','value'=>$info2->education)); 
    ?>
</p>
<p>
	<label>Опыт работы:</label>
	<?php 
    echo form_input(array('name'=>'add_experience','class'=>'text-long','value'=>$info2->experience)); 
    ?>
</p>
<p>
	<label>Навыки:</label>
	<?php 
    echo form_input(array('name'=>'add_experience','class'=>'text-long','value'=>$info2->skills)); 
    ?>
</p>
<p>
	<label>Языки:</label>
	<?php 
    echo form_input(array('name'=>'add_experience','class'=>'text-long','value'=>$info2->skills)); 
    ?>
</p>
<p>
	<label>График работы:</label>
    <?php echo form_dropdown("mode",array("3111"=>"Полный",
								   "3112"=>"Частичный"),$info2->mode); ?>
</p>
<p>
	<label>Дом. телефон:</label>
    <?php
    echo form_input(array('name'=>'add_home_phone','class'=>'text-long','value'=>$info2->home_phone));
	?>
</p>
<p>
	<label>Сотовый:</label>
    <?php
    echo form_input(array('name'=>'add_mobile_phone','class'=>'text-long','value'=>$info2->mobile_phone));
	?>
</p>
<p>
	<label>О себе:</label>
    <?php
    echo form_textarea(array('name'=>'add_about','class'=>'text-long','value'=>$info2->about));
	?>
</p>
<p>
	<label>Опубликовано:</label>
    <?php echo form_dropdown("add_published",array("1"=>"Да",
								   "0"=>"Нет"),$info2->published); ?>
</p>
<p>
	<?php echo form_submit('submit','Принять'); ?>
    <?php echo form_submit('cancel','Отмена'); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>
