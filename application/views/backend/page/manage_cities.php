<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_cities','Города',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<table>
<?php foreach($cities->result() as $city): ?>
<tr>
	<td><?php echo $city->name."<br/>"; ?></td>
    <td class="action">       
       <?php echo anchor('backend/manage_districts/'.$city->id,
                                'Редактировать',array('class'=>'edit')); ?>
                                
       <?php echo anchor('backend/manage_cities/'.$city->id,
                                'Удалить',array('class'=>'delete')); ?>
    </td>
<tr/>
<?php endforeach; ?>
</table><br/>

<?php echo form_open("backend/manage_cities","class='jNice'"); ?>
<?php echo form_hidden("add_city","add_city"); ?>
	<fieldset>
		<p>
			<label>Добавить город</label>
				<?php echo form_input(array('name'=>'add_name','class'=>'text-long')); ?>
		</p>
		<p>
			<?php echo form_submit("submit","Добавить"); ?>
		</p>        
	</fieldset>
<?php echo form_close(); ?>
<br/>
</div>

<div class="clear"></div>
