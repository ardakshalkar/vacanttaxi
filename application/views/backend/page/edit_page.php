<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/manage_pages/edit_page/'.$this->uri->segment(3),'Страницы',array('class'=>'active')); ?>
</h2>

<div id="main"><br/>
<h3><?php echo $page->title; ?></h3>

<fieldset>
<font color="#990000">
<?php echo $this->form_validation->error_string(); ?>
</font>
<?php echo form_open("manage_pages/edit_page/".$this->uri->segment(3)); ?>
<p>
<label>Титул:</label>
<input type="text" name="edit_title" style="width:500px;" class="text-long" value="<?php echo $page->title; ?>"/>
</p>
<p>
	<label>Текст</label>    
    <textarea name="edit_text" style="width:500px;height:400px;" ><?php echo $page->text; ?></textarea>
</p>
<p>
<?php echo form_submit("submit","Принять","class='button-submit1'"); ?>&nbsp;
<?php echo form_submit("cancel","Отмена","class='button-submit1'"); ?>
</p>
<?php echo form_close(); ?>

</fieldset>
</div>

<div class="clear"></div>
