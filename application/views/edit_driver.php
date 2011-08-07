<html>
<head>
<script src="<?php echo base_url()."style/js/jquery.js"; ?>"></script>
<link rel="stylesheet" href="<?php echo base_url()."style/js/jquery-ui.css"; ?>"/>
<script src="<?php echo base_url()."style/js/jquery-ui.js"; ?>"></script>
<script>
	$(document).ready(function(){
		$("#add").click(function(event){
		$("#dialog").dialog({modal:true});
			$("#dialog").dialog('open');
		});
		
	});
</script>
</head>

<?= form_open('auth/save_driver') ?>
<table>
	<tr>
		<td>Category</td>
		<td>
			<?= form_checkbox('category[]','incity',(int)(($category-5000)/100)==1,'id="incity"')?><label for='incity'>Incity</label>
			<?= form_checkbox('category[]','cities',(int)(($category-5000)/10%10)==1,'id="cities"')?><label for='cities'>Cities</label>
			<?= form_checkbox('category[]','suburb',(int)(($category-5000)%10)==1,'id="suburb"')?><label for='suburb'>Suburb</label>
		</td>
	</tr>
	<tr>
		<td>City</td>
		<td><?= form_dropdown('city',$cities)?></td>
	</tr>
	<tr>
		<td>Experience</td>
		<td><?= form_input('experience',$experience)?></td>
	</tr>
	<tr>
		<td>Schedule</td>
		<td>
			<?= form_radio('schedule','1',$schedule=='1','id="once"')?><label for='once'>Once</label>
			<?= form_radio('schedule','2',$schedule=='2','id="rare"')?><label for='rare'>Rare</label>
			<?= form_radio('schedule','3',$schedule=='3','id="always"')?><label for='always'>Always</label>
		</td>
	</tr>
	<tr>
		<td>Home Phone</td>
		<td><?= form_input('h_phone',$h_phone)?></td>
	</tr>
	<tr>
		<td>Mobile Phone</td>
		<td><?= form_input('m_phone',$m_phone)?></td>
	</tr>
	<tr>
		<td>Address</td>
		<td><?= form_textarea('address',$address)?></td>
	</tr>
	<tr>
		<td>About</td>
		<td><?= form_textarea('about',$about)?></td>
	</tr>
</table>
<input type="submit"/>
</form>
