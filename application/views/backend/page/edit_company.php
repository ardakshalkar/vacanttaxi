<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_companies','Компании',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Редактировать Компанию</h3>

<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/edit_company/".$id,"class='jNice'"); ?>
<?php echo form_hidden("edit_company","edit_company"); ?>
<p>
    <label>Пользователь:</label>
    <?php echo form_input(array('name'=>'edit_username','class'=>'text-long','value'=>$info1->username)); ?>
</p>
<p>
    <label>Почта:</label>
    <?php echo form_input(array('name'=>'edit_email','class'=>'text-long','value'=>$info1->email)); ?>
</p>
<p>
    <label>Пароль:</label>
    <?php echo form_password(array('name'=>'edit_password','class'=>'text-long','value'=>$info1->password)); ?>
</p>
<p>
    <label>Подтвердить:</label>
    <?php echo form_password(array('name'=>'edit_confirm','class'=>'text-long','value'=>$info1->password)); ?>
</p>
<p>
    <label>Название компании</label>
    <?php echo form_input(array('name'=>'edit_name','class'=>'text-long','value'=>$info2->company_name)); ?>
</p>
<p>
<label>Лого:</label>
<?php if (isset($info2->logo)):?>
<div style="position:relative;">
<img height="150px" src="<?echo $info2->logo?>"/>
<span id="add" style="background-color:rgba(255,255,255,0.5);">Изменить</span>
</div>
<?php else: ?>
У вас нет лого
<br/>
<span id="add">Добавить</span>
<?php endif; ?>
<br />
</p>

<p>
    <label>Количество водителей:</label>
    <?php echo form_input(array('name'=>'edit_driver_max','class'=>'text-medium','value'=>$info2->driver_max)); ?>
</p>
<p>
    <label>Количество диспетчеров:</label>
    <?php echo form_input(array('name'=>'edit_dispatcher_max','class'=>'text-medium','value'=>$info2->disp_max)); ?>
</p>
<p>
	<label>Город:</label>
	<?php 
    echo form_dropdown('edit_city',$cities,$info2->city); 
    ?>
</p>
<p>
	<label>Контакты:</label>
    <?php
    echo form_textarea(array('name'=>'edit_contacts','class'=>'text-long','value'=>$info2->contacts));
	?>
</p>
<p>
	<label>О компании:</label>
    <?php
    echo form_textarea(array('name'=>'edit_about','class'=>'text-long','value'=>$info2->about));
	?>
</p>
<p>
    <label>Сайт:</label>
    <?php echo form_input(array('name'=>'edit_site','class'=>'text-long','value'=>$info2->site)); ?>
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
		$hidden = array("user_id"=>$info2->user_id);
	?>
	<?php echo form_open("backend/change_photo/2",'',$hidden)?>
		<input type="url" name="photo"/>
		<input type="submit"/>
	</form>
	<hr/>
	Upload:<br/>
	<?php echo form_open_multipart("backend/change_photo/2",'',$hidden)?>
		<input type="file" name="userfile"/>
		<input type="submit"/>
	</form>
</div>
<div class="clear"></div>
