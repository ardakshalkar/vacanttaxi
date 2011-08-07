<div id="sidebar">
<ul class="sideNav">
	<?php if($SIDE_ITEMS > 0): ?>
		<?php foreach($SIDE_ITEMS as $href=>$name): ?>
        <li><?php echo anchor($href,$name); ?></li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
</div>    
