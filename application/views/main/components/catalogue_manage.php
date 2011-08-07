<?php echo form_open('catalogue'); 
$options=array("0"=>lang("vech_type"),"6111"=>lang("car"),"6113"=>lang("bus"));
$types	=array("0"=>lang("trip_type"),"1"=>lang("incity"),"2"=>lang("suburb"),"3"=>lang("cities"))
?>
<input type="text" name="search" value="search..." />
<?= form_dropdown('vechicle_type', $options,0,"id='vechicle_type'");?>
<?= form_dropdown('trip_type', $types,0,"id='trip_type'");?>
<input type="submit"/>
<?= form_close(); ?>
<?= $drivers;?>
<button id="deleteButton"><?=lang("delete");?></button>
<div id='dialog-confirm' class="dialog" title='Delete drivers'><p>Delete drivers from list. Are yoy sure?</p></div>
<div id='dialog-error' class="dialog" title="No rows are selected"><p>You have not selected any row.</p></div>
