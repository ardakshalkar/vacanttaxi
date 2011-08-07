<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_drivers','Водители',array('class'=>'active')); ?>
</h2>
<div id="main"><br/>
<h3>Добавить Водителя</h3>
<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
<?php if(isset($image_error_message)) echo $image_error_message; ?>
</font>
<?php echo form_open_multipart("backend/edit_driver/".$id,array('class'=>'jNice')); ?>
<?php echo form_hidden('edit_driver','edit_driver'); ?>
<p>
<label>Пользователь:</label>
	<?php 
    echo 
    form_input(array('name'=>'edit_username','class'=>'text-long','value'=>$info1->username)); 
    ?>
</p>

<p>
	<label>Почта:</label>
	<?php 
    echo form_input(array('name'=>'edit_email','class'=>'text-long','value'=>$info1->email)); 
    ?>
</p>

<p>
    <label>Пароль:</label>
    <?php echo form_password(array('name'=>'edit_password','class'=>'text-long','value'=>$info1->password)); ?>
</p>

<p>
<label>Фото:</label>

<?php if (isset($profile->photo)):?>
<div style="position:relative;">
<img height="150px" src="<?=$profile->photo?>"/>
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
    <label>Подтвердить:</label>
    <?php echo form_password(array('name'=>'edit_confirm','class'=>'text-long','value'=>$info1->password)); ?>
</p>
<p>
	<label>ФИО:</label>
	<?php 
    echo form_input(array('name'=>'edit_cname','class'=>'text-long','value'=>$info2->c_name)); 
    ?>
</p>
<p>
	<label>Местоположение:</label>
	<?php 
    echo form_dropdown('edit_city',$city_list,$info2->city); 
    ?>
</p>

<p>
	<label>Категория:</label>
	<?php 
    echo form_dropdown('edit_category',array("5100"=>"По городу",
								   "5110"=>"На природу","5111"=>"Между городами"),$info2->category); 
    ?>
</p>
<p>
	<label>Опыт работы:</label>
	<?php 
    echo form_input(array('name'=>'edit_experience','class'=>'text-small','value'=>$info2->experience)); 
    ?>
</p>
<p>
	<label>График работы:</label>
    <?php echo form_dropdown("edit_schedule",array("1"=>"На один раз",
								   "2"=>"Частичный","3"=>"Постоянно"),$info2->schedule); ?>
</p>
<p>
	<label>Курящий:</label>
    <?php echo form_dropdown("edit_smoke",array("0"=>"Нет",
								   "2"=>"Да"),$info2->smoke); ?>
</p>
<p>
	<label>Статус:</label>
    <?php echo form_dropdown("edit_status",array("4111"=>"Заправка",
								   "4112"=>"Свободен","4113"=>"Занят"),$info2->status); ?>
</p>
<p>
	<label>Дом телефон:</label>
    <?php
    echo form_input(array('name'=>'edit_home_phone','class'=>'text-long','value'=>$info2->h_phone));
	?>
</p>
<p>
	<label>Сотовый:</label>
    <?php
    echo form_input(array('name'=>'edit_mobile_phone','class'=>'text-long','value'=>$info2->m_phone));
	?>
</p>
<p>
	<label>О себе:</label>
    <?php
    echo form_textarea(array('name'=>'edit_about','class'=>'text-long','value'=>$info2->about));
	?>
</p>
<p>
	<label>Адрес:</label>
    <?php
    echo form_input(array('name'=>'edit_address','class'=>'text-long','value'=>$info2->address));
	?>
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
	<?php echo form_open("backend/change_photo/0",'',$hidden)?>
		<input type="url" name="photo"/>
		<input type="submit"/>
	</form>
	<hr/>
	Upload:<br/>
	<?php echo form_open_multipart("backend/change_photo/0",'',$hidden)?>
		<input type="file" name="userfile"/>
		<input type="submit"/>
	</form>
</div>
<div class="clear"></div>
