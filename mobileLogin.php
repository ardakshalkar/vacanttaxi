<?php
require('application/libraries/phpass-0.1/PasswordHash.php');

$con = mysql_connect("localhost","root","");
$cdb = mysql_select_db("vacanttaxi");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$login = $_GET['login'];
$password = $_GET['password'];
//$_POST['login'] = 
$query = mysql_query("SELECT * FROM users WHERE username = '$login'");
if($row = mysql_fetch_array($query))
{
	$correct_password = $row['password'];
	$hasher = new PasswordHash(8, FALSE);
	$check = $hasher->CheckPassword($password, $correct_password);
	if ($check){
		$id = $row['id'];
		$query = mysql_query("SELECT * FROM driver_location WHERE uid = '$id'");
		$token = genToken();
		if($row = mysql_fetch_array($query))
		{
			$update = "UPDATE driver_location SET token='$token' WHERE uid=".$id;//lat='$lat' , lon='$lon' WHERE uid =".$id."";
			mysql_query($update);
		}
		else
		{
			$insert = "INSERT INTO driver_location (uid, token) VALUES('$id','$token')";
			mysql_query($insert);
		}
		echo $id." ".$token;
	}
	else
		echo "false";
}
else echo "false";
}
mysql_close($con);
?>
<?
function genToken( $len = 32, $md5 = true ) {
    mt_srand( (double)microtime()*1000000 );
    $chars = array(
        'Q', '@', '8', 'y', '%', '^', '5', 'Z', '(', 'G', '_', 'O', '`',
        'S', '-', 'N', '<', 'D', '{', '}', '[', ']', 'h', ';', 'W', '.',
        '/', '|', ':', '1', 'E', 'L', '4', '&', '6', '7', '#', '9', 'a',
        'A', 'b', 'B', '~', 'C', 'd', '>', 'e', '2', 'f', 'P', 'g', ')',
        '?', 'H', 'i', 'X', 'U', 'J', 'k', 'r', 'l', '3', 't', 'M', 'n',
        '=', 'o', '+', 'p', 'F', 'q', '!', 'K', 'R', 's', 'c', 'm', 'T',
        'v', 'j', 'u', 'V', 'w', ',', 'x', 'I', '$', 'Y', 'z', '*'
    );
    $numChars = count($chars) - 1; $token = '';
    for ( $i=0; $i<$len; $i++ )
        $token .= $chars[ mt_rand(0, $numChars) ];
    if ( $md5 ) {
        $chunks = ceil( strlen($token) / 32 ); $md5token = '';
        for ( $i=1; $i<=$chunks; $i++ )
            $md5token .= md5( substr($token, $i * 32 - 32, 32) );
        $token = substr($md5token, 0, $len);
    } 
    return $token;
}
?>
