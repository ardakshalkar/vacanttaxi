<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" href="<?php echo base_url()."style/style.css"; ?>" rel="stylesheet" media="all" />
<link type="text/css" href="<?php echo base_url()."style/table.css"; ?>" rel="stylesheet" media="all" />
<script src="<?php echo base_url()."style/js/jquery.js"; ?>"></script>
<link rel="stylesheet" href="<?php echo base_url()."style/js/jquery-ui.css"; ?>"/>
<script src="<?php echo base_url()."style/js/jquery-ui.js"; ?>"></script>
<script src="<?php echo base_url()."style/js/jquery.timeago.js"; ?>" type="text/javascript"></script>
<script>
	city = '<?=$city?>';
</script>
<?php
if ($component == "front"){ 
	$this->load->view('head/twits');
	$this->load->view('head/map'); 
}
if ($component == "map"){
	$this->load->view('head/map');
}
if ($component == "catalogue"|| $component == "catalogue_manage"){
	$this->load->view("head/catalogue");
}
if ($component == "unorder_manage"){
	$this->load->view("head/unordermanage");
}
?>
<script type="text/javascript">
	
base_url = '<?php echo base_url();?>index.php/';
</script>
<?php
if (isset($extraHeadContent)) {
	echo $extraHeadContent;
}
?>
<?php if ($component)?>
<script>
var id2,loginWidget=false,loginWidgetClicked=false;;
$(document).ready(function(){
	$("#chatDiv").hide();
	$("#taxist").click( function(){
		$("#loginPart").load("<?php echo base_url()?>index.php/auth/login");
		$("#taxistDiv").show();
	});
	$("#loginCloseButton").click(function(){
		$("#taxistDiv").hide();
	});
	$("#client").click(function(){
		loginWidget = true;
		$("#taxistDiv").hide();
		$("#clientDiv").fadeIn('normal');
	});
	$("#can").click(function(){
		$("#taxistDiv").load("<?php echo base_url();?>index.php/front/ajaxlogin2", {'cache':false});
	});
	$("#register a").click(function(){
		event.preventDefault(); 
		//$("#taxistDiv").hide();
		$("#taxistDiv").load("<?php echo base_url();?>index.php/front/ajaxreg", {'cache':false});
		$("#taxistDiv").fadeIn('slow');
	});			
	$("#showPosition").focus(function(){
		document.getElementById("address").value("");
	});
	$("#f").click(function(){
			$("#messages").load("<?php echo base_url();?>chat.sql.php?id="+id2+"&name="+$("#name").val()+"&text="+$("#mes-context").val(),{'cache':false});
			$("#mes-context").attr("value","");
	});

	$("#addressForm").submit(function(){
		var address = city+" "+document.getElementById('address').value;
		getCoordinates(address);
		return false;
	});
	
	 $(".leave_comment").submit(function(){
		event.preventDefault();

		var msg_id=$(this).find("[name='id']").attr("value");
		$.post("<?php echo base_url();?>index.php/front/ajaxComment", $(this).serialize(),  function(data) {
			$("#"+msg_id).append(data);
			$("#commentArea").empty();
		}); 
	 });
	 
	 
	$(".twit_comment").click(function(){
		$(this).next().next().toggle("slow");  
		$(this).next().find("#nameArea").attr("value","");
  		$(this).next().find("#commentArea").attr("value","");
  				
	 });
 	 
	$( "#dialog" ).dialog({
			autoOpen: false,
			height: 250,
			width: 250
			});
	
	$("#cityName").click(function(){
		$("#dialog").dialog("open");
	});

	$("#social_login").hide();
	$(".twit_date").timeago();
});
function startChat(id){
	id2=id;
	$("#content").hide();
	$("#chatDiv").show();
	getBid();
}
function getMsg(){
	$("#show_msgC").load("<?php echo base_url();?>index.php/front/get_clients_order",organizeTwits);
	$("#show_msgT").load("<?php echo base_url();?>index.php/front/get_taxists_order",organizeTwits);
}
function organizeTwits(){
	
	$(".twit_date").timeago();
	//$(this).children().children(".twit_date, .twit_contacts").hide();
	//$(this).children().hover(function(){$(this).children(".twit_date, .twit_contacts").show()},
	//function(){$(this).children(".twit_date, .twit_contacts").hide()});
}
function getCities(){
	$("#dialog").load("<?php echo base_url();?>index.php/front/getCityFromDb");
}

</script>
