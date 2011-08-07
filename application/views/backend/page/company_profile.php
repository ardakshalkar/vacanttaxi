<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/company_profile','Изменить параметры компании',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3>Параметры Компании</h3>
    <fieldset>
    <font color="#990000">
    <?php echo $this->form_validation->error_string(); ?>
    </font>
    
    <?php 
		echo form_open("backend/company_profile/","class='jNice'"); 
	?>
    
    <?php echo form_hidden('edit','edit'); ?>
    <p>
        <label>Компания:</label>
        <?php echo form_input(array('name'=>'edit_company_name','class'=>'text-long','value'=>$company_profile->company_name)); ?>
    </p>
    <p>
        <label>Контакты:</label>
        <?php echo form_textarea(array('name'=>'edit_contacts','class'=>'text-long','cols'=>'25','rows'=>'2','value'=>$company_profile->contacts)); ?>
    </p>
   	<p>
        <label>Наш сайт:</label>
        <?php echo form_input(array('name'=>'edit_site','class'=>'text-long','value'=>$company_profile->site)); ?>
    </p>
    <p>
        <label>О нас:</label>
        <?php echo form_textarea(array('name'=>'edit_about','class'=>'text-long','cols'=>'25','rows'=>'2','value'=>$company_profile->about)); ?>
    </p>
    <p>
        <label>Город:</label>
        <?php echo form_dropdown('edit_city',$cities,$company_profile->city,"id='edit_type'");?>
    </p>
	<!--<p>
    	<?php echo form_open_multipart('upload/do_upload');?>
        <label>Логотип:</label>
        <?php echo form_upload(array('name'=>'company_logo','class'=>'text-long','size'=>10));?>
    </p>-->
    <p>
    <?php echo form_submit('save','Сохранить',"class='button-submit1'"); ?>
    <?php echo form_submit('cancel','Отменить',"class='button-submit1'"); ?>
    </p>
    
    <?php echo form_close(); ?>
    </fieldset>
    </div>

<div class="clear"></div>
