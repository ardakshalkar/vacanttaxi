<div id="middlepart">
		<?php echo $this->load->view("main/twits");?>
</div>
<div style="clear:both;"></div>
<div id="map_container">
	<div id="showPosition">
		<form id="addressForm" action="/">
			<? /*<label for="address" id="label">Address:</label>*/ ?>
			<input type="text" id="address" title="Enter address"/>
			<input type="button" id="addressButton" value="Show location" />
			<input type="button" id="mapCloseButton" value="Close" />
		</form>
	</div>
	<div id="map"></div>
</div>
