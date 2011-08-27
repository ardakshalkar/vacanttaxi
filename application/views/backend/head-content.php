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

<link type="text/css" href="<?php echo $base_url; ?>style/css/smoothness/jquery-ui.css" rel="Stylesheet" />	
<script type="text/javascript" src="<?php echo $base_url; ?>style/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>style/js/jquery-ui-1.8.15.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>style/js/jNice.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;key=ABQIAAAACH4j3210cqhvWDAXAv4jcBSVl4AMz3hSJ7yI0QAV2YpsPNpdhhQoxPSmNKPyloFYnF64PHVdfn8ySA">
</script>
<script type="text/javascript" src="<?php echo base_url()."style/js/disMap.js"; ?>"></script>


<?php
if ($PAGE == 'page/manage_orders'){
	$this->load->view('backend/head/catalogue');
}else if($PAGE == 'page/statistics'){$this->load->view('backend/head/statisticsScript');}
?>  

<script>
$(document).ready(function(){	
		
		$("#add").click(function(event){
		$("#dialog").dialog({modal:true});
			$("#dialog").dialog('open');
		});
		
	});
</script>
</head>
