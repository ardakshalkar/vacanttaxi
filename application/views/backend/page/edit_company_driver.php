<h2>
	<?php echo anchor('/backend/manage_company_drivers/0','Водители'); ?>  &raquo; 
    <?php echo anchor('/backend/edit_company_driver','Редактировать данные',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Редактировать данные о водителе</h3>
<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/edit_company_driver/".$id,"class='jNice'"); ?>
<?php echo form_hidden('edit_company_driver','edit_company_driver'); ?>
<p>
	<label>Водитель:</label>
	<?php echo form_input(array('name'=>'edit_cname','class'=>'text-long','value'=>$info1->c_name));?>
</p>
<p>
	<label>Статус:</label>
    <?php echo form_dropdown('edit_status',array("4111"=>"Заправка",
								   "4112"=>"Свободен","4113"=>"Занят"),$info1->status); ?>
</p>
<p>
	<label>Курящий:</label>
	<?php echo form_dropdown('edit_smoke',array('0'=>'Нет','1'=>'Да'),$info1->smoke); ?>
</p>
<p>
    <label>Город:</label>
    <?php echo form_dropdown('edit_city',$cities,$info1->city,"id='add_type'");?>
</p>
<p>
	<label>Опыт работы:</label>
	<?php 
    echo form_input(array('name'=>'edit_experience','class'=>'text-long','value'=>$info1->experience)); 
    ?>
</p>
<p>
	<label>Категория:</label>
    <?php echo form_dropdown('edit_category',array("5100"=>"По городу",
								   "5110"=>"На природу","5111"=>"Между городами"),$info1->status); ?>
</p>
<p>
	<label>График работы:</label>
    <?php echo form_dropdown("mode",array("1"=>"На один раз",
								   "2"=>"Частичный","3"=>"Постоянно"),$info1->schedule); ?>
</p>
<p>
	<label>Дом. телефон:</label>
    <?php
    echo form_input(array('name'=>'edit_home_phone','class'=>'text-long','value'=>$info1->h_phone));
	?>
</p>
<p>
	<label>Сотовый:</label>
    <?php
    echo form_input(array('name'=>'edit_mobile_phone','class'=>'text-long','value'=>$info1->m_phone));
	?>
</p>
<p>
	<label>Адрес:</label>
    <?php
    echo form_textarea(array('name'=>'edit_address','class'=>'text-long','value'=>$info1->address));
	?>
</p>
<p>
	<label>О себе:</label>
    <?php
    echo form_textarea(array('name'=>'edit_about','class'=>'text-long','value'=>$info1->about));
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
