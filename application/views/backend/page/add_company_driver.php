<h2>
	<?php echo anchor('/backend/manage_company_drivers/0','Водители'); ?>  &raquo; 
    <?php echo anchor('/backend/add_company_driver','Добавить',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Добавить водителя</h3>
<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open_multipart("backend/add_company_driver",array('class'=>'jNice')); ?>
<?php echo form_hidden('add_company_driver','add_company_driver'); ?>
<p>
	<label>Водитель:</label>
	<?php echo form_input(array('name'=>'add_cname','class'=>'text-long','value'=>''));?>
</p>
<p>
	<label>Статус:</label>
    <?php echo form_dropdown('add_status',array("4111"=>"Заправка",
								   "4112"=>"Свободен","4113"=>"Занят")); ?>
</p>
<p>
	<label>Курящий:</label>
	<?php echo form_dropdown('add_smoke',array('0'=>'Нет','1'=>'Да')); ?>
</p>
<p>
    <label>Город:</label>
    <?php echo form_dropdown('add_city',$cities,'',"id='add_type'");?>
</p>
<p>
	<label>Категория:</label>
    <?php echo form_dropdown('add_category',array("5100"=>"По городу",
								   "5110"=>"На природу","5111"=>"Между городами")); ?>
</p>
<p>
	<label>Опыт работы:</label>
	<?php echo form_input(array('name'=>'add_experience','class'=>'text-long','value'=>''));?>
</p>
<p>
	<label>График работы:</label>
    <?php echo form_dropdown("add_schedule",array("1"=>"На один раз",
								   "2"=>"Частичный","3"=>"Постоянно"),''); ?>
</p>
<p>
	<label>Дом. телефон:</label>
    <?php
    echo form_input(array('name'=>'add_home_phone','class'=>'text-long','value'=>''));
	?>
</p>
<p>
	<label>Сотовый:</label>
    <?php
    echo form_input(array('name'=>'add_mobile_phone','class'=>'text-long','value'=>''));
	?>
</p>
<p>
	<label>Адрес:</label>
    <?php echo form_textarea(array('name'=>'add_address','class'=>'text-long','value'=>''));?>
</p>
<p>
	<label>О себе:</label>
    <?php
    echo form_textarea(array('name'=>'add_about','class'=>'text-long','value'=>''));
	?>
</p>
<p>
	<?php echo form_submit('submit','Сохранить',"class='button-submit1'"); ?>
    <?php echo form_submit('cancel','Отмена',"class='button-submit1'"); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>
