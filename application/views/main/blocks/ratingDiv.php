<script>
$('[class^=star_]').mouseenter(
        function() {
            if($(this).parent().data('selected') == undefined) {
                var selectedStar = $(this).parent().find('.hover_star').length - 1;
                $(this).parent().data('selected', selectedStar)
            }
            $(this).children().addClass('hover_star');
            $(this).prevAll().children().addClass('hover_star');
            $(this).nextAll().children().removeClass('hover_star');
        }
        );

    $('[id^=rating_]').mouseleave(
        function() {
            var selectedIndex = $(this).data('selected');
	
			if  (selectedIndex == -1)
			{
				$(this).children("[class^=star_]").children('img').removeClass("hover_star");
			}
			
            var $selected = $(this).find('img').eq(selectedIndex).addClass('hover_star').parent();		
            $selected.prevAll().children().addClass('hover_star');
            $selected.nextAll().children().removeClass('hover_star');
    });


	$("[id^=rating_]").children("[class^=star_]").click(function() 
	{
		var current_star = $(this).attr("class").split("_")[1];
		var rid = $(this).parent().attr("id").split("_")[1];
		alert('ej');
		$('#star_container_'+rid).load('<?php echo base_url() ?>index.php/front/submitRating', {rating: current_star, id: rid});

	});
</script>
<div id="rating_<?php echo $a['driver_id']; ?>">
<span class="star_1"><img src="<?php echo $base_url."style/images/star_blank.png"; ?>" alt="" <?php if($a['rating'] > 0) { echo"class='hover'"; } ?> /></span>
<span class="star_2"><img src="<?php echo $base_url."style/images/star_blank.png"; ?>" alt="" <?php if($a['rating'] > 1.5) { echo"class='hover'"; } ?> /></span>
<span class="star_3"><img src="<?php echo $base_url."style/images/star_blank.png"; ?>" alt="" <?php if($a['rating'] > 2.5) { echo"class='hover'"; } ?> /></span>
<span class="star_4"><img src="<?php echo $base_url."style/images/star_blank.png"; ?>" alt="" <?php if($a['rating'] > 3.5) { echo"class='hover'"; } ?> /></span>
<span class="star_5"><img src="<?php echo $base_url."style/images/star_blank.png"; ?>" alt="" <?php if($a['rating'] > 4.5) { echo"class='hover'"; } ?> /></span>
</div>
<div class="star_rating">
(Rated <strong><?php echo $a['rating']; ?></strong> Stars)
</div>
<div class="clearleft">&nbsp;</div>
