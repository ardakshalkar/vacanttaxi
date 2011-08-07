<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="<?php echo base_url()."style/js/jquery.js"; ?>"></script>
<script>
$(document).ready(function(){
id_rep="";
$("#f").click(function(){
			$("#messages").prepend('<li id='+<?php echo $user_id?>+'><label class="name">'+$("#name").val()+'</label></br><a class="reply">Ответить</a></br>'+$("#mes-context").val()+'</li>');
			$.get("http://localhost/VacanTaxi/index.php/chat/send_mes/"+id_rep+"/"+$("#name").val()+"/"+$("#mes-context").val(), {},function(data){});
			$("#mes-context").attr("value","");
			
	});
	$(".ii").click(function(){alert()});
});

</script>
<style>
#messages{list-style-type: none;
-webkit-padding-start: 10px;
}
#messages li{
background-color:white;
border-top: 1px solid #EDEDED;
font-family: Stencil;
margin-top:2px;
padding:10px 5px 5px 10px;
}
#messages li a{
color:blue;
cursor: pointer;
padding-left: 120px;
font-size:0.8em;
}
body div{
	display:block;
	width:500px;
}
.name{
	color: #2B587A;
	size:1.1em;
}
</style>


</head>
<script>

function getMsg(){
	$("#messages").load("<?php echo base_url();?>index.php/chat/get/", {'cache':false},function(){
$(".reply").click(function(){
	id_rep=$(this).parent().attr("id"); 			
	});});}
</script>
<body onload="getMsg();">
<?php
$beaconpush->add_channel('taxi_chat');
echo $beaconpush->embed(array('log' => TRUE, 'user' => $user_id));
?>
<div>
<ul id="messages">
<li id="1"><label class="name">Riteprofi</label><a href="#" class="reply">Ответить</a></br> some text </li>
</ul>
</div>
<div>
<label>Name:</label> 
<input type="text" id="name" maxlength='25' id="t" value="<?php if(isset($this->session->userdata['username'])){echo $this->session->userdata['username'];}else echo "Unknown"; ?>"/>
</br>
<label>Message:</label>
<textarea align="left" name="textarea" id="mes-context" cols="20" rows="2"></textarea>
<button id="f">Send</button>
</div>
</body>
</html>