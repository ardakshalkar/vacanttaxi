<script>
$(document).ready(function(){
	$('#edit_type').change(function(){
		if($('#edit_type').val() == "<?php echo MODERATOR; ?>")
		{
			$('#edit_category').removeAttr('disabled');
		}else
		{
			$('#edit_category').attr({'disabled':'disabled'});
		}
	});
	if($('#edit_type').val() != "<?php echo MODERATOR; ?>")
	{
		$('#edit_category').attr({'disabled':'disabled'});
	}
}); 
</script>

<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_users','Изменить администраторов',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Управление бакенд пользователями</h3>
    <fieldset>
    <font color="#990000">
    <?php echo $this->form_validation->error_string(); ?>
    </font>
    
    <?php 
		echo form_open('backend/manage_admin_user/'.$this->uri->segment(3).'/'.$userinfo->id); 
	?>
    
    <?php echo form_hidden('edit','edit'); ?>
    <p>
        <label>Пользователь:</label>
        <?php echo form_input(array('name'=>'edit_username','class'=>'text-long','value'=>$userinfo->username)); ?>
    </p>
    <p>
        <label>Почта:</label>
        <?php echo form_input(array('name'=>'edit_email','class'=>'text-long','value'=>$userinfo->email)); ?>
    </p>
    <p>
        <label>Тип:</label>
        <?php echo form_dropdown('edit_type',
                                array('1113'=>'Супер Админ',
                                      '1112'=>'Админ',
                                      '1111'=>'Компания',
                                      '1110'=>'Диспетчер'),
                                $userinfo->type,"id='edit_type'"); 
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
