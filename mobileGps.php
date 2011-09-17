<?php
mysql_connect("localhost","root","");
mysql_select_db("vacanttaxi");

if( (isset($_GET['lat'])) and (isset($_GET['lon'])) ){
	
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$id= $_GET['id'];
	$token = $_GET['token'];
	$update = "UPDATE driver_location SET lat='$lat',lon='$lon' WHERE uid =".$id." AND token='$token'";
	mysql_query($update);
	
}
else
{
	echo "Can not take lat and lon";
}
mysql_close($con);
?>
