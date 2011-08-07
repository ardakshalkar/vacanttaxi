<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Transdmin Light</title>
</head>
<style>
input[type='text'],input[type='password']
{
border: 1px solid #ddd;
background: #fff url(../img/input-shaddow.gif) no-repeat left top;
color: #646464;
padding: 5px 7px;
width: 124px;
float: left;
margin: 0 10px 0 0;
}

input[type='submit']
{
	font: 11px Arial, Helvetica, sans-serif;
	color: #646464;
	width: 94px;
	height: 29px;
	cursor: pointer;
	border: none;
	background: url(http://localhost/VacanTaxi/style/img/button-submit.gif) no-repeat left top;
	margin-right:10px;
}

#main
{
position:absolute;
border:1px solid #999999;
padding:20px;
padding-left:30px;
padding-right:30px;
left:35%;
top:30%;

}
</style>
<?php 
	$admin_log_username = array('name'=>'admin_log_username');
	$admin_log_password = array('name'=>'admin_log_password');
?>
<body>
<div id="main">
<?php echo $admin_log_message; ?>

<?php echo form_open("backend/login"); ?>
<table>
    <tr>
        <td>Username</td><td><?php echo form_input($admin_log_username); ?></td>
    </tr>
    <tr>
        <td>Password</td><td><?php echo form_password($admin_log_password); ?></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo form_submit('submit','Login'); ?></td>
    </tr>
</table>
<?php echo form_close(); ?>
</div>

</body>
</html>
