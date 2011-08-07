<script>
$(document).ready(function(){
	$('#add_type').change(function(){
		if($('#add_type').val() == "<?php echo SUPERADMIN; ?>")
		{
			$('#add_category').removeAttr('disabled');
		}else
		{
			$('#add_category').attr({'disabled':'disabled'});
		}
	});
	if($('#add_type').val() != "<?php echo SUPERADMIN; ?>")
	{
		$('#add_category').attr({'disabled':'disabled'});
	}
}); 
</script>

<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_admin_users/0','Администраторы',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Добавить пользователя</h3>
    <fieldset>
    <font color="#990000">
    <?php echo $this->form_validation->error_string(); ?>
    </font>
    
    <?php 
		echo form_open('backend/add_admin_user/'); 
	?>
    
    <?php echo form_hidden('add','add'); ?>
    <p>
        <label>Пользователь:</label>
        <?php echo form_input(array('name'=>'add_username','class'=>'text-long','value'=>set_value('add_username'))); ?>
    </p>
    <p>
        <label>Почта:</label>
        <?php echo form_input(array('name'=>'add_email','class'=>'text-long','value'=>set_value('add_email'))); ?>
    </p>
    <p>
        <label>Пароль:</label>
        <?php echo form_input(array('name'=>'add_password','class'=>'text-long')); ?>
    </p>
    <p>
        <label>Подтвердить:</label>
        <?php echo form_input(array('name'=>'add_confirm','class'=>'text-long')); ?>
    </p>
    <p>
        <label>Тип:</label>
        <?php echo form_dropdown('add_type',
                                array('1113'=>'Супер Админ',
                                      '1112'=>'Администратор',
                                      '1111'=>'Компания',
                                      '1110'=>'Диспетчер'),0,"id='add_type'"); 
		?>
    </p>
    <p>
    <?php echo form_submit('save','Сохранить',"class='button-submit1'"); ?>
    <?php echo form_submit('cancel','Отменить',"class='button-submit1'"); ?>
    </p>
    
    <?php echo form_close(); ?>
    </fieldset>
    </div>

<div class="clear"></div>
