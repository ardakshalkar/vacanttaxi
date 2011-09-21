<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_dispatchers','Диспетчера',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Редактировать диспетчера</h3>

<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/edit_dispatcher/".$id,"class='jNice'"); ?>
<?php echo form_hidden("edit_dispatcher","edit_dispatchers"); ?>
<p>
    <label>Пользователь:</label>
    <?php 
		echo form_input(array('name'=>'edit_username','class'=>'text-long','value'=>$info1->username));
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
    <label>Подтвердить:</label>
    <?php echo form_password(array('name'=>'edit_confirm','class'=>'text-long','value'=>$info1->password)); ?>
</p>
<p>
    <label>Имя:</label>
    <?php echo form_input(array('name'=>'edit_dname','class'=>'text-long','value'=>$info2->dname)); ?>
</p>
<p>
    <label>Телефон:</label>
    <?php echo form_input(array('name'=>'edit_phone','class'=>'text-long','value'=>$info2->phone)); ?>
</p>
<?php if($this->session->userdata['admin_type'] >= ADMIN):?>
<p>
	<label>Компания:</label>
	<?php 
	$t='class="text-medium"';
    echo form_dropdown('edit_company',$companies,$info2->company_id,$t); 
    ?>
</p>
<?php endif;?>
<p>
	<label>График работы:</label>
	<?php $t='class="text-medium"'; 
    	echo form_dropdown("edit_mode",array("3111"=>"Полный",
								   "3112"=>"Не полный"),$info2->mode,$t); ?>
</p>
<p>
    	<?php echo form_submit(array('name'=>'submit','value'=>'Принять')); ?>
        <?php echo form_submit(array('name'=>'cancel','value'=>'Отмена')); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>
