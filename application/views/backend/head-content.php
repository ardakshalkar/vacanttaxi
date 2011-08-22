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
<?php
if ($PAGE == 'page/manage_orders'){
	$this->load->view('backend/head/catalogue');
}
?>  

<?php
if (isset($beaconpush)){
$beaconpush->add_channel($company);
echo $beaconpush->embed(array('log' => TRUE, 'user' => $this->session->userdata['admin_id']	));
}
?>
<script>

	

/* Formating function for row details */
function fnFormatDetails ( oTable, nTr )
{
	var aData = oTable.fnGetData( nTr );
	var sOut = '<table cellspacing="0" border="0" style="padding-left:50px;">';
	sOut += '<tr><td>Время выпонения заказа:</td><td>'+aData[5]+'</td></tr>';
	sOut += '<tr><td>Был сделан:</td><td>'+aData[7]+'</td></tr>';
	sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
	sOut += '</table>';
	
	return sOut;
}
$(document).ready(function(){
	
	/*
	 * Insert a 'details' column to the table
	 */
	var nCloneTh = document.createElement( 'th' );
	var nCloneTd = document.createElement( 'td' );
	nCloneTd.innerHTML = '<img src="http://www.datatables.net/release-datatables/examples/api/../examples_support/details_open.png">';
	nCloneTd.className = "center";
	
	$('#catalogue thead tr').each( function () {
		this.insertBefore( nCloneTh, this.childNodes[0] );
	} );
	
	$('#catalogue tbody tr').each( function () {
		this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
	} );
	
	/*
	 * Initialse DataTables, with no sorting on the 'details' column
	 */
	var oTable = $('#catalogue').dataTable( {
		"aoColumnDefs": [
			{ "bSortable": false, "aTargets": [ 0 ] },
			{ "bVisible": false, "aTargets": [ 5 ] },
			{ "bVisible": false, "aTargets": [ 7 ] },
		],
		"aaSorting": [[1, 'asc']],
		"oLanguage": {
			"sSearch": "Search all columns:"
		},
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
	});
	
	/*Add toolbar*/
	
	$("div.top").prepend('<p>Дата Заказа с: <input type="text" id="date_from"> по: <input type="text" id="date_to"></p>');
	$('#date_from,#date_to').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('#date_from,#date_to').change(function(){ 
		$.fn.dataTableExt.afnFiltering.push(
 		function( oSettings, aData, iDataIndex ) {
 		// "date-range" is the id for my input
 		dateMin =  $.datepicker.formatDate('yymmdd', $('#date_from').datepicker("getDate"));
 		dateMax =  $.datepicker.formatDate('yymmdd', $('#date_to').datepicker("getDate"));
 		
		// 4 here is the column where my dates are.
 		var date = aData[7];
 		date = date.substring(0,10);
 		date = date.substring(0,4) + date.substring(5,7) + date.substring( 8,10 )

 		if ( dateMin == "" && date <= dateMax){
 			return true;
 		}
 		else if ( dateMin =="" && date <= dateMax ){
 			return true;
 		}
 		else if ( dateMin <= date && "" == dateMax ){
 			return true;
 		}
 		else if ( dateMin <= date && date <= dateMax ){
 			return true;
 		}
 		return false;
 		});
		oTable.fnDraw(); 
		});
	
	
	/* Add event listener for opening and closing details
	 * Note that the indicator for showing which row is open is not controlled by DataTables,
	 * rather it is done here
	 */
	$('#catalogue tbody td img').live('click', function () {
		var nTr = this.parentNode.parentNode;
		if ( this.src.match('details_close') )
		{
			/* This row is already open - close it */
			this.src = "http://www.datatables.net/release-datatables/examples/api/../examples_support/details_open.png";
			oTable.fnClose( nTr );
		}
		else
		{
			/* Open this row */
			this.src = "http://www.datatables.net/release-datatables/examples/api/../examples_support/details_close.png";
			oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
		}
	} );
	
	
	
	
		
		
		$("#sidebar .sideNav li a:eq(0)").click(function(event) {
 		 event.preventDefault();
 		 
  		alert('hello');
  		});
  		$("#sidebar .sideNav li a:eq(1)").click(function(event) {
 		 event.preventDefault(); 		 
  		oTable.fnFilter('1115', 6 );
  		});
  		$("#sidebar .sideNav li a:eq(2)").click(function(event) {
 		 event.preventDefault();
  		oTable.fnFilter('',6);
  		oTable.fnFilter('',6);
  		});
  		
		
		$("#add").click(function(event){
		$("#dialog").dialog({modal:true});
			$("#dialog").dialog('open');
		});
		
	});
</script>
</head>