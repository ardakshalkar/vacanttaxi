<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $TITLE; ?></title>

<!-- CSS -->
<link href="<?php echo $base_url; ?>style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url; ?>style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url; ?>style/css/ie7.css" /><![endif]-->

<!-- JavaScripts-->
<script type="text/javascript" src="<?php echo $base_url; ?>style/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>style/js/jNice.js"></script>
<link rel="stylesheet" href="<?php echo $base_url."style/js/jquery-ui.css"; ?>"/>
<script src="<?php echo $base_url."style/js/jquery-ui.js"; ?>"></script>
<script>
	$(document).ready(function(){
		$("#add").click(function(event){
			alert("jjj");
		$("#dialog").dialog({modal:true});
			$("#dialog").dialog('open');
		});
		
	});
</script>
</head>