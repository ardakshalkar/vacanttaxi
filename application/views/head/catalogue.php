<link rel="stylesheet" href="<?php echo base_url()."style/css/demo_table.css"; ?>"/>
<script type="text/javascript" src="<?php echo base_url()."style/js/jquery.dataTables.min.js"; ?>"></script>
<script>
	var tableClicked;
	function initialize(){}
$(document).ready(function(){
	table = $("#catalogue").dataTable({
		"oLanguage": {
			"sSearch": "Поиск:"
		},
		"bAutoWidth": false,
		"aoColumnDefs":[{"aTargets":[5,7],"bVisible":false}],
	});
	$("#vechicle_type").change(function(){
			table.fnFilter($(this).val());
	});
	$("#trip_type").change(function(){
			var regex = "";
			if ($(this).val()==0) regex = "5[01][01][01]";
			if ($(this).val()==1) regex = "51[01][01]";
			if ($(this).val()==2) regex = "5[01]1[01]";
			if ($(this).val()==3) regex = "5[01][01]1";
			table.fnFilter(regex,7,true);
	});
	$("#catalogue tbody").click(function(event) {
		tableClicked = true;
		$(table.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('row_selected');
		});
		$(event.target.parentNode).addClass('row_selected');
	});
	<? if ($this->config->item('authorized')) : ?>
	$("#catalogue tbody td").dblclick(function(event){
		tableClicked = true;
		var height=$(this).parent().children(":eq(1)").height();
		$(this).parent().children(":lt(6)").each(function(){
			var wid = $(this).width();
			$(this).html("<textarea prev_value='"+$(this).html()+"'>"+$(this).html()+"</textarea>"	);
			$(this).children().width(wid);$(this).children().height(height);
		});
	});
	$(document).click(function(){
		if (!tableClicked){
			$(table.fnSettings().aoData).each(function (){
				$(this.nTr).removeClass('row_selected');
			});
			var line = $("#catalogue textarea").parent().parent();
			var x = checkChangesInRow(line);
			line.children(":eq(7)").html(x);
			$("#catalogue tbody td textarea").each(function(){
				$(this).parent().html($(this).val());
			});
		}
		tableClicked = false;
	});
	$("#deleteButton").click(function(){
		var anSelected = fnGetSelected( table );
		itemid = $(anSelected).children("td:eq(6)").html();
		//alert(anSelected.length);
		if (anSelected.length==1){
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:200,
				modal: true,
				buttons: {
					"Delete all items": function() {
						$.get(base_url+"manage/catalogue_delete/"+itemid,
							function(data){
								table.fnDeleteRow(anSelected[0]);
							}
						);
						
						$(this).dialog("close");
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		else if (anSelected.length==0) $("#dialog-error").dialog();
		
		
		/**/
	});
	<? endif ?>
});
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
function fnGetSelected( oTableLocal )
{
	var aReturn = new Array();
	var aTrs = oTableLocal.fnGetNodes();
	for ( var i=0 ; i<aTrs.length ; i++ )
	{
		if ( $(aTrs[i]).hasClass('row_selected') )
		{
			aReturn.push( aTrs[i] );
		}
	}
	return aReturn;
}
</script>
