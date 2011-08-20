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
<table>
	<tr>
		<td><label>photo</label></td>
		<td>
			<?php if (isset($profile->photo)):?>
				<div style="position:relative;">
					<img height="150px" src="<?=$profile->photo?>"/>
					<span id="add" style="position:absolute;bottom:0px;right:0px;background-color:rgba(255,255,255,0.5);">Изменить</span>
				</div>
				
			<?php else: ?>
				У вас нет фото
				<br/>
				<span id="add">Добавить</span>
			<?php endif; ?>
		</td>
	</tr>
</table>

<div id="dialog" style="display:none;">
	Url:<br/>
	<?php 
		$hidden = array("user_id"=>$user_id);
	?>
	<?= form_open("auth/change_photo",'',$hidden)?>
		<input type="url" name="photo"/>
		<input type="submit"/>
	</form>
	<hr/>
	Upload:<br/>
	<?= form_open_multipart("auth/change_photo",'',$hidden)?>
		<input type="file" name="userfile"/>
		<input type="submit"/>
	</form>
</div>
</html>
