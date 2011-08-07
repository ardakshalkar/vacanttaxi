<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/manage_cities','Города'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_districts/'.$this->uri->segment(3),'Районы',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<fieldset>
<?php echo form_open("backend/manage_districts/".$this->uri->segment(3)); ?>
<?php echo form_hidden("rename","rename"); ?>
<p>
<label>Name</label>
<?php echo form_input(array('name'=>'name','class'=>'text-long','value'=>$city->name)); ?>
</p>
<p>
<?php echo form_submit("submit","Переименовать","class='button-submit1'"); ?>
</p>        
<?php echo form_close(); ?>
</fieldset>
<br/>
<table>
<?php foreach($districts as $district): ?>
<tr>
	<td><?php echo $district->name."<br/>"; ?></td>
    <td class="action">       
       <?php echo anchor('backend/edit_district/'.$this->uri->segment(3)."/".$district->id,
                                'Редактировать',array('class'=>'edit')); ?>
                                
       <?php echo anchor('backend/manage_districts/'.$this->uri->segment(3)."/".$district->id,
                                'Удалить',array('class'=>'delete')); ?>
    </td>
<tr/>
<?php endforeach; ?>
</table>
<br/>
</div>

<div class="clear"></div>
