<script src="<?php echo base_url()."style/js/jquery.timeago.js"; ?>" type="text/javascript"></script>
<script>

function organizeTwits(){
	$(".twit_date").timeago();
}
$(document).ready(function(){
	$( "#dialog:ui-dialog" ).dialog( "destroy" );

				var name = $( "#name" ),
				contacts = $( "#contacts" ),
				from = $( "#from" ),
				to = $( "#to" ),
				message = $( "#destination" ),
				allFields = $( [] ).add( name ).add( contacts ).add( from ).add( to ).add( message ),
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
			height: 500,
			width: 280,
			modal: true,
			buttons: [{
						id:"s_button",
						name:"s_button",
						text:"Submit",
						click: function() {
							
							var bValid = true;
							allFields.removeClass( "ui-state-error" );
							
							//bValid = bValid && checkLength( name, "Name", 2, 15 );
							//bValid = bValid && checkRegexp( contacts, /^([0-9+])+$/, "Contacts field only allow : 0-9 and '+'" );
							bValid = bValid && checkLength( from, "From", 2, 50 );
							bValid = bValid && checkLength( to, "To", 2, 50 );
							bValid = bValid && checkLength( message, "Message", 5, 50 );
							bValid = bValid && checkRegexp( name, /^([a-zA-ZА-Яа-яёЁ])+$/, "Name field only allow : a-z" );
							if ( bValid ) {
								document.unoffOrder.submit();
								$( this ).dialog( "close" );
							}
						}
				},{
					text:"Cancel",
					click: function() {
					allFields.val( "" );
					$( this ).dialog( "close" );
				}
			}],
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
				$(".validateTips").html("");
			}
		});

		$( ".msgButton" ).button().click(function() {
				$('input[name="type"]').val($(this).attr("type_value"));
				$( "#dialog-form" ).dialog( "open" );
		});

	});
	
</script>
