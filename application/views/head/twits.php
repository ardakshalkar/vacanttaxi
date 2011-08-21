<script src="<?php echo base_url()."style/js/jquery.timeago.js"; ?>" type="text/javascript"></script>
<script>
(function() {
  function numpf(n, f, s, t) {
    // f - 1, 21, 31, ...
    // s - 2-4, 22-24, 32-34 ...
    // t - 5-20, 25-30, ...
    var n10 = n % 10;
    if ( (n10 == 1) && ( (n == 1) || (n > 20) ) ) {
      return f;
    } else if ( (n10 > 1) && (n10 < 5) && ( (n > 20) || (n < 10) ) ) {
      return s;
    } else {
      return t;
    }
  }
 
  jQuery.timeago.settings.strings = {
    prefixAgo: null,
    prefixFromNow: "через",
    suffixAgo: "назад",
    suffixFromNow: null,
    seconds: "меньше минуты",
    minute: "минуту",
    minutes: function(value) { return numpf(value, "%d минута", "%d минуты", "%d минут"); },
    hour: "час",
    hours: function(value) { return numpf(value, "%d час", "%d часа", "%d часов"); },
    day: "день",
    days: function(value) { return numpf(value, "%d день", "%d дня", "%d дней"); },
    month: "месяц",
    months: function(value) { return numpf(value, "%d месяц", "%d месяца", "%d месяцев"); },
    year: "год",
    years: function(value) { return numpf(value, "%d год", "%d года", "%d лет"); }
  };
})();
function organizeTwits(){
	$(".twit_date").timeago();
}
function addTweet(id,message){
	var twit = '<li><span class="twit_name">'+message.name+'</span><br/>';
	twit += '<span class="twit_message">'+message.message+'</span><br/>';
	twit += '<span class="twit_from">(A) '+message.from+'</span>';
	twit += '<span class="twit_to">(B) '+message.to+'</span>';
	twit += '<span class="twit_contacts">(T)'+message.contacts+'</span><br/>';
	twit += '<span class="twit_date" title='+message.date+'>'+message.date+'</span> ';
	twit += '<span class="twit_comment">0 комментарий</span><br/>';
	twit += '<div class="commentsDiv" style="display:none;">';
	twit += '<ul id="'+message.id+'">';
	twit += '<?php 
		   $nameArea = array(
			'name'  => 'nameArea',
			'id'    => 'nameArea',
			'placeholder' => 'Имя..',
			'width' => '50',
			'value' => ''
		   );
		   $comment = array(
			'name' => 'commentArea',
			'class'   => 'commentArea',
			'cols' => '25',
			'rows' => '2',
			'placeholder' => 'Текст комментария...',
			'value'=> ''
		   );
			
			$attributes = array('class' => 'leave_comment');
			echo form_open_multipart("front/ajaxComment",$attributes);
			if (!$this->session->userdata('user_id'))
				echo form_input($nameArea).br();
			echo form_textarea($comment).br();?><input type="hidden" name="id" value="'+message.id+'"/><?
			echo form_submit(array('name'=>'send_comment'),'Отправить');
			echo form_close();?></ul></div>';
	$(id).prepend(twit);
	
	$(".twit_date").timeago();
	$(".leave_comment").submit(function(){
		event.preventDefault();
		var msg_id=$(this).find("[name='id']").attr("value");
		$.post("<?php echo base_url();?>index.php/front/ajaxComment", $(this).serialize(),  function(data) {
			$("#"+msg_id).append(data);
			$(".commentArea").val("");
		}); 
	 }); 
	$(".twit_comment").unbind('click').click(function(){
		$(this).next().next().toggle("slow");  
		$(this).next().find("#nameArea").attr("value","");
  		$(this).next().find("#commentArea").attr("value","");
  				
	 });
	
}
$(document).ready(function(){
	
	 $(".leave_comment").submit(function(){
		 
		event.preventDefault();

		var msg_id=$(this).find("[name='id']").attr("value");
		$.post("<?php echo base_url();?>index.php/front/ajaxComment", $(this).serialize(),  function(data) {
			$("#"+msg_id).append(data);
			$(".twit_date").timeago();
			$(".commentArea").val("");
		}); 
	 });
	$(".twit_comment").click(function(){
		$(this).next().next().toggle("slow");  
		$(this).next().find("#nameArea").attr("value","");
  		$(this).next().find("#commentArea").attr("value","");
  				
	 });
	
	
	
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
						text:"Добавить запись",
						click: function() {
							
							var bValid = true;
							allFields.removeClass( "ui-state-error" );
							
							//bValid = bValid && checkLength( name, "Name", 2, 15 );
							//bValid = bValid && checkRegexp( contacts, /^([0-9+])+$/, "Contacts field only allow : 0-9 and '+'" );
							bValid = bValid && checkLength( from, "Откуда", 2, 50 );
							bValid = bValid && checkLength( to, "Куда", 2, 50 );
							bValid = bValid && checkLength( message, "Сообщение", 5, 50 );
							bValid = bValid && checkRegexp( name, /^([a-zA-ZА-Яа-яёЁ])+$/, "Вводе только кириллицу/латиницу" );
							if ( bValid ) {
								$.post("<?php echo base_url();?>index.php/unofficialOrder", $(document.unoffOrder).serialize(),  function(data) {});
								$( this ).dialog( "close" );
								//document.unoffOrder.submit();
								
							}
						}
				},{
					text:"Отмена",
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
		$("a.cancelOrder").click(function(){
			event.preventDefault();
			var cancelLink = this;
			
			var parent = $(this).parent();
			$.get($(cancelLink).attr("href"), function(data) {
				$(parent).fadeTo("fast",0.5);
				$(cancelLink).text("Заказ отменен");
				$(cancelLink).css("text-decoration","line-through");
			});
			return false;
		});
	});
	
</script>
