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



<script>
(function($) {
/*
 * Function: fnGetColumnData
 * Purpose:  Return an array of table values from a particular column.
 * Returns:  array string: 1d data array 
 * Inputs:   object:oSettings - dataTable settings object. This is always the last argument past to the function
 *           int:iColumn - the id of the column to extract the data from
 *           bool:bUnique - optional - if set to false duplicated values are not filtered out
 *           bool:bFiltered - optional - if set to false all the table data is used (not only the filtered)
 *           bool:bIgnoreEmpty - optional - if set to false empty values are not filtered from the result array
 * Author:   Benedikt Forchhammer <b.forchhammer /AT\ mind2.de>
 */
$.fn.dataTableExt.oApi.fnGetColumnData = function ( oSettings, iColumn, bUnique, bFiltered, bIgnoreEmpty ) {
	// check that we have a column id
	if ( typeof iColumn == "undefined" ) return new Array();
	
	// by default we only wany unique data
	if ( typeof bUnique == "undefined" ) bUnique = true;
	
	// by default we do want to only look at filtered data
	if ( typeof bFiltered == "undefined" ) bFiltered = true;
	
	// by default we do not wany to include empty values
	if ( typeof bIgnoreEmpty == "undefined" ) bIgnoreEmpty = true;
	
	// list of rows which we're going to loop through
	var aiRows;
	
	// use only filtered rows
	if (bFiltered == true) aiRows = oSettings.aiDisplay; 
	// use all rows
	else aiRows = oSettings.aiDisplayMaster; // all row numbers

	// set up data array	
	var asResultData = new Array();
	
	for (var i=0,c=aiRows.length; i<c; i++) {
		iRow = aiRows[i];
		var aData = this.fnGetData(iRow);
		var sValue = aData[iColumn];
		
		// ignore empty values?
		if (bIgnoreEmpty == true && sValue.length == 0) continue;

		// ignore unique values?
		else if (bUnique == true && jQuery.inArray(sValue, asResultData) > -1) continue;
		
		// else push the value onto the result data array
		else asResultData.push(sValue);
	}
	
	return asResultData;
}}(jQuery));
function fnCreateSelect( aData )
{
	var r='<select><option value=""></option>', i, iLen=aData.length;
	for ( i=0 ; i<iLen ; i++ )
	{
		r += '<option value="'+aData[i]+'">'+aData[i]+'</option>';
	}
	return r+'</select>';
}
	$(document).ready(function(){
		var oTable=$('#catalogue').dataTable({
		"oLanguage": {
			"sSearch": "Search all columns:"
		},
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"aoColumnDefs": [ 
			{
				"fnRender": function ( oObj ) {
					return oObj.aData[0] +' T:'+ oObj.aData[3];
				},
				"aTargets": [ 0 ]
			},
			{
				"fnRender": function ( oObj ) {
					return oObj.aData[1] +' ->'+ oObj.aData[2];
				},
				"aTargets": [ 1 ]
			},
			{ "bVisible": false,  "aTargets": [ 3 ] },
			{ "bVisible": false,  "aTargets": [ 2 ] },
			{ "sClass": "center", "aTargets": [ 4 ] }
		]});
		oTable.append('<tfoot><tr><th rowspan="1" colspan="1"></th><th  rowspan="1" colspan="1"></th><th  rowspan="1" colspan="1"></th><th  rowspan="1" colspan="1"></th><th  rowspan="1" colspan="1"></th><th  rowspan="1" colspan="1"></th></tr></tfoot>');
		
		$("tfoot th").each( function ( i ) {
		this.innerHTML = fnCreateSelect( oTable.fnGetColumnData(i) );
		$('select', this).change( function () {
			oTable.fnFilter( $(this).val(), i );
		} );
		} );
		
		$("#add").click(function(event){
		$("#dialog").dialog({modal:true});
			$("#dialog").dialog('open');
		});
		
	});
</script>
</head>