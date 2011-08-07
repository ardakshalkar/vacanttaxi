<h2>
	<?php echo anchor('/backend/manage_users/0','Пользователи'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_agencies','Агентства',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Редактировать Агентство</h3>

<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("backend/edit_agency/".$id,"class='jNice'"); ?>
<?php echo form_hidden("edit_agency","edit_agency"); ?>
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
    <label>Потвердить:</label>
    <?php echo form_password(array('name'=>'edit_confirm','class'=>'text-long','value'=>$info1->password)); ?>
</p>
<p>
    <label>Имя:</label>
    <?php echo form_input(array('name'=>'edit_name','class'=>'text-long','value'=>$info2->name)); ?>
</p>
<p>
    <label>Количество:</label>
    <?php echo form_input(array('name'=>'edit_amount','class'=>'text-medium','value'=>$info2->amount)); ?>
</p>
<p>
    	<?php echo form_submit(array('name'=>'submit','value'=>'Принять')); ?>
        <?php echo form_submit(array('name'=>'cancel','value'=>'Отменить')); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>
