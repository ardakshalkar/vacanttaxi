<link rel="stylesheet" href="<?php echo base_url()."style/css/demo_table.css"; ?>"/>
<script type="text/javascript" src="<?php echo base_url()."style/js/jquery.dataTables.min.js"; ?>"></script>
<?php
if (isset($beaconpush)){
$beaconpush->add_channel('company'.$company_id);
echo $beaconpush->embed(array('log' => TRUE, 'user' => $this->session->userdata['admin_id']	));
}
?>
<script>


var base_url="<?php echo base_url();?>";
<?php echo 'var comList = '.json_encode($company_list).';';?>
<?php echo 'var cityList = '.json_encode($city_list).';';?>
function addRow(id,message){
	var btn='button#'+message.id;
	var classb;
	if(message.status=='1111'){classb='ui-icon ui-icon-help';}else if(message.status=='1112'){classb='ui-icon ui-icon-radio-on';}
	else if(message.status=='1113'){classb='ui-icon ui-icon-minus';}else if(message.status=='1114'){classb='ui-icon ui-icon-plus';}else {classb='ui-icon ui-icon-check';}
	if($(btn).length == 0)/*no element found, add data*/
	{
	$(id).dataTable().fnAddData( ['<img src="'+base_url+'style/images/details_open.png">',
			message.oname+' '+message.surname,
			message.from,message.to,message.contacts,message.when+' '+message.time,
			'<button id="'+message.id+'" class="pro_order ui-icon ui-icon-help ui-button ui-widget ui-state-default ui-corner-all" aria-disabled="false" role="button"><span class="ui-button">'+message.status+'</span></button>',
			message.order_date,message.session_id,message.company_id,message.city
			] );	
	}
	else /*update data*/
	{
		var index=Math.floor($(btn).parent().parent().index());
		//var aData = $(id).dataTable().fnGetData( index );
		/* Update the data array and return the value */
		$(btn).html('<button id="'+message.id+'" class="pro_order '+classb+' ui-button ui-widget ui-state-default ui-corner-all" aria-disabled="false" role="button"><span class="ui-button">'+message.status+'</span></button>');
		//var status=$(id).dataTable().fnUpdate( '<button id="'+message.id+'" class="pro_order '+classb+' ui-button ui-widget ui-state-default ui-corner-all" aria-disabled="false" role="button"><span class="ui-button">'+message.status+'</span></button>', aPos[0], 6 );
	}
	
	$( ".pro_order" ).button().click(function() {
				$('input[name="order_id"]').val($(this).attr("id"));
				$('input[name="prev_stat"]').val($(this).find('span').val());
				$( "#dialog-form" ).dialog( "open" );
		});
	$(".pro_order span").attr('class','ui-button');
	$(btn).parent().parent().effect("pulsate", { times:3 }, 2000);
		
}	

/* Formating function for row details */
function fnFormatDetails ( oTable, nTr )
{
	var aData = oTable.fnGetData( nTr );
	var sOut = '<table cellspacing="0" border="0" style="padding-left:50px;">';
	sOut += '<tr><td>Заказ на:</td><td>'+aData[5]+'</td><td>Компания:</td><td>'+comList[aData[9]]+'</td></tr>';
	sOut += '<tr><td>Был сделан:</td><td>'+aData[7]+'</td><td>Город:</td><td>'+cityList[aData[10]]+'</td></tr>';
	
	sOut += '</table>';
	
	return sOut;
}

$(document).ready(function(){

	
	$( "#dialog:ui-dialog" ).dialog( "destroy" );

				//status = $( "#status" ),
				message = $( "#message" ),
				allFields = $( [] ).add( message ),
				tips = $( ".validateTips" );
		
		function updateTips( t ) {
			tips.text( t ).addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}
	
		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		};
		
	$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 200,
			width: 280,
			modal: true,
			buttons: [{
					text:"Отмена",
					click: function() {
					allFields.val( "" );
					$( this ).dialog( "close" );
										}
					},{
						id:"s_button",
						name:"s_button",
						text:"Принять",
						click: function() {
							var bValid = true;
							allFields.removeClass( "ui-state-error" );
							
							//bValid = bValid && checkLength( message, "Сообщение", 5, 50 );
							if ( bValid ) {
								$.post(base_url+"index.php/backend/edit_order", $(document.pro_order).serialize(),  function(data) {
								alert(data);
								});
								$( this ).dialog( "close" );
								}
							}
						}],
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
				$(".validateTips").html("");
			}
		});
		
		
		
		$( ".pro_order" ).button().click(function() {
				$('input[name="order_id"]').val($(this).attr("id"));
				$('input[name="prev_stat"]').val($(this).find('span').text());
				$( "#dialog-form" ).dialog( "open" );
		});
		$("a.cancelOrder").click(function(){
			event.preventDefault();
			var cancelLink = this;
			
			var parent = $(this).parent();
			$.get($(cancelLink).attr("href"), function(data) {
				$(parent).fadeTo("fast",0.5);
				$(cancelLink).text("Заказ не пройден");
				$(cancelLink).css("text-decoration","line-through");
			});
			return false;
		});
	
	
	/*
	 * Insert a 'details' column to the table
	 */
	var nCloneTh = document.createElement( 'th' );
	var nCloneTd = document.createElement( 'td' );
	nCloneTd.innerHTML = '<img src="'+base_url+'style/images/details_open.png">';
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
			{ "bVisible": false, "aTargets": [ 5,7,8,9,10] },
		],
		"aaSorting": [[7, 'desc']],
		"oLanguage": {
			"sSearch": "Search all columns:"
		},
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
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
			this.src = base_url+"style/images/details_open.png";
			oTable.fnClose( nTr );
		}
		else
		{
			/* Open this row */
			this.src = base_url+"style/images/details_close.png";
			oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
		}
	} );
	
	
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
	
	$(".pro_order span").attr('class','ui-button');
	
			
		$("#sidebar .sideNav li a:eq(0)").click(function(event) {
 		 event.preventDefault();
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
  	});

</script>