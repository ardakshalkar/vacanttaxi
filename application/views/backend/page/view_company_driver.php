<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/manage_company_drivers','Водители'); ?>  &raquo; 
    <?php echo anchor('/backend/view_company_driver/'.$this->uri->segment(3),'Все данные о водителе',array('class'=>'active')); ?>
</h2>
<div id="main">
<h3>Просмотр данных</h3>
<fieldset>
<table style="width:80%;">
<?php foreach($userinfo1 as $key=>$info): ?>
<tr>
	<td><?php echo $key; ?></td>
    <td><?php echo $info; ?></td>
</tr>
<?php endforeach; ?>
</table>
</fieldset>
<br/>
<?php echo form_open("backend/manage_company_drivers"); ?>
<?php echo form_submit("back","Назад","class='button-submit1'"); ?>
<?php echo form_close(); ?>
<br/>
</div>

<div class="clear"></div>
