<h2>
	<?php echo anchor('/backend/edit_driver','Редактировать водителя'); ?>  &raquo; 
    <?php echo anchor('/backend/edit_car','Машина',array('class'=>'active')); ?>
</h2>
<div id="main"><br/>
<h3>Добавить Водителя</h3>
<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open_multipart("backend/edit_car/".$id,array('class'=>'jNice')); ?>
<?php echo form_hidden('edit_car','edit_car'); ?>
<p>
<label>Номер машины:</label>
	<?php 
    echo 
    form_input(array('name'=>'edit_car_no','class'=>'text-long','value'=>$info->car_no));
    ?>
</p>
<p>
	<label>Тип:</label>
	<?php 
    echo form_dropdown('edit_type',array("6111"=>"Легковая",
								   "6112"=>"Грузовая","6113"=>"Автобус"),$info->type); 
    ?>
</p>
<p>
<label>Модель:</label>
	<?php echo form_input(array('name'=>'edit_model','class'=>'text-long','value'=>$info->model));?>
</p>
<p>
	<label>Описание:</label>
    <?php
    echo form_textarea(array('name'=>'edit_description','class'=>'text-long','value'=>$info->description));
	?>
</p>
<p>
<label>Фото:</label>

<?php if (isset($info->photo)):?>
<div style="position:relative;">
<img height="150px" src="<?=$info->photo?>"/>
<span id="add" style="background-color:rgba(255,255,255,0.5);">Изменить</span>
</div>
<?php else: ?>
У вас нет фото
<br/>
<span id="add">Добавить</span>
<?php endif; ?>
<br />
</p>
<p>
	<?php echo form_submit('submit','Принять'); ?>
    <?php echo form_submit('cancel','Отменить'); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>
<div id="dialog" style="display:none;">
	Url:<br/>
	<?php 
		$hidden = array("user_id"=>$id);
	?>
	<?php echo form_open("backend/change_photo/1",'',$hidden)?>
		<input type="url" name="photo"/>
		<input type="submit"/>
	</form>
	<hr/>
	Upload:<br/>
	<?php echo form_open_multipart("backend/change_photo/1",'',$hidden)?>
		<input type="file" name="userfile"/>
		<input type="submit"/>
	</form>
</div>

<div class="clear"></div>
