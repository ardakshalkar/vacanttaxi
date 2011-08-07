<div class = "infowindow"><img src="http://localhost/VacanTaxi/style/uploads/<?php echo $a['photo']; ?>" style="float:left; width:80px; padding-right:5px; overflaw:hidden;" alt="driver photo"><h2><?php echo $a['lastname'].' '.$a['firstname'].' '.$a['middlename']; ?></h2><p>Опыт: <?php echo $a['experience'];?>.  Номер телефона: <?php echo $a['m_phone'];?></p><p onclick="startChat(<?php echo $a['user_id']; ?>)">Чат</p>

<div class="floatleft">
<div id="star_container_<?php echo $a['user_id']; ?>">
<?php $this->load->view('front/blocks/ratingDiv'); ?>
</div>
</div>
</div>