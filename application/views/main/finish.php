<script src="<?php echo base_url()."style/js/jquery.js"; ?>"></script>
<script type="text/javascript" src="<?php echo base_url()."style/js/jquery-ui-1.8.15.custom.min.js";?>" ></script>
<script src="<?php echo base_url()."style/js/jquery.timeago.js"; ?>" type="text/javascript"></script>
<script>
	base_url = '<?php echo base_url();?>';
	city = '<?=$city?>';
</script>
<?php
if ($component == "front"){ 
	$this->load->view('head/twits');
	echo "<script>function initialize(){}</script>";
	//$this->load->view('head/map'); 
}
if ($component == "map"){
	$this->load->view('head/twits');
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
	
	$( "#taxistDiv" ).dialog({
			autoOpen: false,
			width:"750px"
			});
	$("#dateoforder").datepicker({dateFormat: 'yy-mm-dd'});
	$("#chatDiv").hide();
	$("#enter").click( function(){
		$("#loginPart").load("<?php echo base_url()?>index.php/auth/login2?ajax=true");
		$("#taxistDiv").dialog("open");
		//$("#taxistDiv").show();
	});
	$("#client").click(function(){
		loginWidget = true;
		$("#taxistDiv").hide();
		$("#clientDiv").fadeIn('normal');
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
	
 	 
	$( "#dialog" ).dialog({
			autoOpen: false,
			height: 250,
			width: 250
			});
	
	$("#cityName").click(function(){
		$("#dialog").load('<?php echo base_url();?>index.php/front/getCityFromDb');
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
<script>
	
var _ues = {
host:'vtaxi.userecho.com',
forum:'6248',
lang:'ru',
tab_icon_show:false,
tab_corner_radius:0,
tab_font_size:16,
tab_image_hash:'0J7RgdGC0LDQstC40YLRjCDQvtGC0LfRi9Cy',
tab_alignment:'right',
tab_text_color:'#FFFFFF',
tab_bg_color:'#FF9000',
tab_hover_color:'#F45C5C'
};

(function() {
    var _ue = document.createElement('script'); _ue.type = 'text/javascript'; _ue.async = true;
    _ue.src = ('https:' == document.location.protocol ? 'https://s3.amazonaws.com/' : 'http://') + 'cdn.userecho.com/js/widget-1.4.gz.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(_ue, s);
  })();

</script>
