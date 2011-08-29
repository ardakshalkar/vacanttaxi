<?php
mysql_connect("localhost","root","");
mysql_select_db("vacantaxi");

if( (isset($_GET['lat'])) and (isset($_GET['lon'])) ){
	
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$id= $_GET['id'];
	

	$query = mysql_query("SELECT * FROM driver_location WHERE u_id = '$id'");
	if($row = mysql_fetch_array($query))
	{
		$update = "UPDATE driver_location SET lat='$lat' , lon='$lon' WHERE u_id =".$id."";
		mysql_query($update);
	}
	else
	{
		$insert = "INSERT INTO driver_location (u_id, lat, lon) VALUES('$id', '$lat', '$lon')";
		mysql_query($insert);
	}
}
else
{
echo "Can not take lat and lon";
}
mysql_close($con);
?>
