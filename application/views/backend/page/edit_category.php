<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_cities','Города',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?php echo form_open("backend/edit_category/".$this->uri->segment(3),"class='jNice'"); ?>
<fieldset>
    <p>
        <label>Редактировать категорию</label>
            <?php echo form_input(array('name'=>'edit_name','class'=>'text-long','value'=>$category->name)); ?>
    </p>
    <p>
        <?php echo form_submit("submit","Принять"); ?>
        <?php echo form_submit("cancel","Отменить"); ?>
    </p>        
</fieldset>
<?php echo form_close(); ?>
<br/>
</div>

<div class="clear"></div>
