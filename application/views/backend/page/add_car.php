<h2>
	<?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/add_car','Добавить машину',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Добавить Машины</h3>
<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open_multipart("backend/add_car/".$id,array('class'=>'jNice')); ?>
<?php echo form_hidden('add_car','add_car'); ?>
<p>
<label>Номер машины:</label>
	<?php 
    echo 
    form_input(array('name'=>'add_car_no','class'=>'text-long','value'=>set_value('add_car_no'))); 
    ?>
</p>
<p>
	<label>Тип:</label>
	<?php 
    echo form_dropdown('add_type',array("6111"=>"Легковая",
								   "6112"=>"Грузовая","6113"=>"Автобус")); 
    ?>
</p>
<label>Модель:</label>
	<?php 
    echo 
    form_input(array('name'=>'add_model','class'=>'text-long','value'=>set_value('add_model'))); 
    ?>
</p>
<p>
	<label>Описание:</label>
    <?php
    echo form_textarea(array('name'=>'add_description','class'=>'text-long','value'=>''));
	?>
</p>
<!--<p>
    <label>Фото:</label>
    <?php if (isset($profile->photo)):?>
    <div style="position:relative;">
    <img height="150px" src="<?php echo $profile->photo;?>"/>
    <span id="add" style="position:absolute;bottom:0px;right:0px;background-color:rgba(255,255,255,0.5);">Изменить</span>
    </div>
    <?php else: ?>
    У вас нет фото
    <br/>
    <span id="add">Добавить</span>
    <?php endif; ?>
    <br />
</p>-->
<p>
	<?php echo form_submit('submit','Принять'); ?>
    <?php echo form_submit('cancel','Отменить'); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>


<div class="clear"></div>
