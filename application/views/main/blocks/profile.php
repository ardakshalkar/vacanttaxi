<script>
$("#myform2").submit(function(){
	event.preventDefault(); 
    // Send the data using post and put the results in a div
    $.post( "<?= base_url();?>index.php/front/ajaxlogout", {},
      function( data ) {
          $( "#taxistDiv" ).html( data );
      }
    );
});
</script>
<p>
    <label>Таксист:</label>
    <?php 
		foreach ($user as $row)
{
   echo $row['firstname'];
   echo $row['lastname'];
   echo $row['middlename'];
}
	?>
	
	
</p>
<p>

<?php $attributes = array('id' => 'myform2'); 
	echo form_open("front/login", $attributes); ?>
<?php echo form_submit("logout","выйти"); ?>
<?php echo form_close(); ?>
</p>
