<link rel="stylesheet" href="<?php echo base_url()."style/css/demo_table.css"; ?>"/>
<script type="text/javascript" src="<?php echo base_url()."style/js/jquery.dataTables.min.js"; ?>"></script>
<script>
	var tableClicked;
	var datanames = ['name','message','contacts','date','from','to'];
	function initialize(){}
$(document).ready(function(){
	var settings = {"oLanguage": {"sSearch": "Поиск:"},"bAutoWidth": false,}
	var table_taxist = $("#driver_message").dataTable(settings);
	var table_client = $("#client_message").dataTable(settings);
	$("#driver_message").attr("datatable","taxist");
	$("#client_message").attr("datatable","client");
	$(".saveButton").click(function(){
		var line = $(this).parent().parent();
		var itemid = $(this).attr("itemid");
		var table = $(line).parent().parent();
		var datatable = $(table).attr("datatable");
		var data = new Object();
		data["table"] = datatable;
		for (x in datanames){
			data[datanames[x]] = $(line).children().eq(x).children().val();
		}
		$.post(base_url+"manage/update_unofficial_order/"+itemid,data,
			function(data){
				resetValues(line,true);
			});
	});
	for (x in datanames){
		$(".message_table tbody td:eq("+x+")").attr("dataname",datanames[x]);
	}
	$(".delButton").click(function(){
		var line = $(this).parent().parent();
		var itemid = $(this).attr("itemid");
		var table = $(line).parent().parent();
		var datatable = $(table).attr("datatable");
		$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:200,
				modal: true,
				buttons: {
					"Delete all items": function() {
						$.post(base_url+"manage/unofficial_delete/"+itemid,
						{"table":datatable},
							function(data){
								if (datatable == 'taxist') table_taxist.fnDeleteRow(line);
								else if (datatable == 'client') table_client.fnDeleteRow(line);
							}
						);
						
						$(this).dialog("close");
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
	});
	$(".saveButton").hide();
	$(".editButton").click(function(){
		
		var line = $(this).parent().parent();
		var itemid = $(this).attr("itemid");
		if ($(this).html() == "Edit"){
			$(line).children(":lt(6)").each(function(){
					var prev_width = $(this).width();
					var value = $(this).html();
					$(this).html("<textarea prev_text='"+value+"'>"+$(this).html()+"</textarea>");
					$(this).children().width(prev_width);
					$(this).children().blur(function(){
						if ($(this).attr("prev_text") != $(this).val()){
							$(line).children().children(".saveButton").show();
						}
					});
			});
			$(this).html("Cancel");
		}
		else if ($(this).html() == "Cancel"){
			resetValues(line,false);
			$(this).html("Edit");
		}
	});
	
});
function resetValues(line,change){
	$(line).children(":lt(6)").each(function(){
		if (change)
			$(this).html($(this).children().val());
		else
			$(this).html($(this).children().attr("prev_text"));
		$(line).children().children(".editButton").html("Edit");
		$(line).children().children(".saveButton").hide();
	});
}
function checkChangesInRow(element){
		var ret_val="V";
		
		$(element).children(":lt(6)").children().each(function(){
				if ($(this).attr("prev_value")!=$(this).val()){
					
					ret_val="changed";
					return;
				}
		});
		return ret_val;
}
</script>
