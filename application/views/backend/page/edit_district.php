<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/manage_districts/'.$this->uri->segment(3),'Районы'); ?>  &raquo; 
    <?php echo anchor('/backend/edit_district/'.$this->uri->segment(3)."/".$this->uri->segment(4),'Район',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?php echo $this->form_validation->error_string(); ?>
<?php 
echo form_open("backend/edit_district/".$this->uri->segment(3)."/".$this->uri->segment(4),"class='jNice'");
?>

<p>
    <label>Имя:</label>
    <?php 
		echo form_input(array('name'=>'edit_name','class'=>'text-long','value'=>$district->name));
	?>
</p>
<br/>
<?php echo form_submit('submit','Принять'); ?>
<?php echo form_submit('cancel','Отменить'); ?>
<?php echo form_close(); ?>
<br/><br/><br/>
</div>
<div class="clear"></div>
