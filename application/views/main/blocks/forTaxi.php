<div class = "infowindow">
<? if (isset($a['user_profile'])) : ?>
<?php foreach($a['user_profile'] as $profile){?>
<img src="<?php echo $profile->photo;?>" style="float:left; width:75px; height:70px; padding-right:5px; overflaw:hidden;" alt="company photo">
<?}?>
<h2><?php echo $a['c_name']; ?></h2>
<p>Опыт: <?php echo $a['experience'];?>. тел.: <?php echo $a['m_phone'];?></p>
<p><?php echo $a['about'];?></p>
<? endif; ?>
</div>
