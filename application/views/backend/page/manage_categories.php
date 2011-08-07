<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_categories','Категории',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<table>
<?php foreach($categories->result() as $category): ?>
<tr>
	<td><?php echo $category->name."<br/>"; ?></td>
    <td class="action">       
       <?php echo anchor('backend/edit_category/'.$category->id,
                                'Редактировать',array('class'=>'edit')); ?>
                                
       <?php echo anchor('backend/manage_categories/'.$category->id,
                                'Удалить',array('class'=>'delete')); ?>
    </td>
<tr/>
<?php endforeach; ?>
</table><br/>

<?php echo form_open("backend/manage_categories","class='jNice'"); ?>
<?php echo form_hidden("add_category","add_category"); ?>
	<fieldset>
		<p>
			<label>Добавить категорию</label>
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
