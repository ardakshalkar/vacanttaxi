<?php
require('/application/libraries/phpass-0.1/PasswordHash.php');

$con = mysql_connect("localhost","root","");
$cdb = mysql_select_db("vacantaxi");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$str = trim(file_get_contents('php://input')); 
list($login, $password) = split(' ', $str);

$query = mysql_query("SELECT * FROM users WHERE username = '$login'");
if($row = mysql_fetch_array($query))
{
$correct_password = $row['password'];
$hasher = new PasswordHash(8, FALSE);
$check = $hasher->CheckPassword($password, $correct_password);
	if ($check)
		echo $row['id'];
	else
		echo "false";
}
else echo "false";
}
mysql_close($con);
?>
