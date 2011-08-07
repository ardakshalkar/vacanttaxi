<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" href="<?php echo $base_url."style/style2.css"; ?>" rel="stylesheet" media="all" />
<script src="<?php echo $base_url."style/js/jquery.js"; ?>"></script>
<link rel="stylesheet" href="<?php echo $base_url."style/js/jquery-ui.css"; ?>"/>
<title><?php echo $main_title; ?></title>
<script type="text/javascript">
//<![CDATA[
base_url = '<?php echo base_url();?>index.php/';
//]]>
</script>
<script>
var id2=<?php echo $this->session->userdata('user_id'); ?>;
	$(document).ready( function(){
		$("#f").click(function(){
		text=$("#mes-context").attr("value");
		$("#messages").load("<?php echo base_url();?>chat.sql.php?id="+id2+"&name=<?php echo $this->session->userdata('username'); ?>&text="+text,{'cache':false});
		$("#mes-context").attr("value","");
		});
		$("#changestat").click(function(){
    	$.post( "<?php echo base_url();?>index.php/front/change_message", {'message':$("#stat").val()});
		});
		$("#chat").mouseover( function(){
			document.getElementById("chat").style.opacity= "0.7";
		});
		$("#chat").mouseout( function(){
			document.getElementById("chat").style.opacity= "1";
		});
		
		$("#edit").mouseover( function(){
			document.getElementById("edit").style.opacity= "0.7";
		});
		$("#edit").mouseout( function(){
			document.getElementById("edit").style.opacity= "1";
		});
		
		});
		
function getBid(){
	setTimeout(function(){
	$("#messages").load("<?php echo base_url();?>chat.sql.php?id="+id2,{'cache':false});
	getBid();}, 4000);
	
}
</script>    
</head>

<body onload="getBid()">

<div id="main">
	<div id = "header"><img src="<?php echo $base_url."style/images/header2.png"; ?>" /></div>
	<div id="ChatEdit">
     		<?php echo anchor("front/driver_profile",'<img id="chat" src="'.$base_url.'style/images/chat.png" />'); ?>
        	<?php echo anchor("front/driver_edit",'<img id="chat" src="'.$base_url.'style/images/edit.png" />'); ?>
    </div>    	
</div>
<div id="status">
	<label id="status_l">Статус: </label>
        <input id="stat" type="text" size="20"/>&nbsp;&nbsp;&nbsp;<img id="changestat" src="<?php echo $base_url."style/images/dialog_ok.png"; ?>" />
</div>
<?php $this->load->view('driver/page/'.$page); ?> 
<?php echo anchor("front/logout",'<img id="logout"  src="'.$base_url.'style/images/logout.png" />'); ?>
<div id="footer">
		<img src="<?php echo $base_url."style/images/footer2.png"; ?>" />
</div>
</body>
</html>