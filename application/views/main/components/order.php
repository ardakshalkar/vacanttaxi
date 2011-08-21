<script>

</script>
<?php

	echo form_open("order");
	$surname = array(
		'name'  => 'surname',
		'id'    => 'surname',
		'class' => 'orderLabels',
		'value' => set_value('surname')
	);
	$name = array(
		'name'  => 'name',
		'id'    => 'name',
		'class' => 'orderLabels',
		'value' => set_value('name')
	);
	$contacts = array(
		'name'  => 'contacts',
		'id'    => 'contacts',
		'class' => 'orderLabels',
		'value' => ''
	);
	$date = array(
		'name'  => 'date',
		'id'    => 'dateoforder',
		'class' => 'orderLabels',
		'value' => set_value('date')
	);
	$hours = array(
		'00' => '00','01' => '01','02' => '02',
		'03' => '03','04' => '04','05' => '05',
		'06' => '06','07' => '07','08' => '08',
		'09' => '09','10' => '10','11' => '11',
		'12' => '12','13' => '13','14' => '14',
		'15' => '15','16' => '16','17' => '17',
		'18' => '18','19' => '19','20' => '20',
		'21' => '21','22' => '22','23' => '23'
	);
	$mins = array(
		'00' => '00',
		'15' => '15',
		'30' => '30',
		'45' => '45'
	);
	$otkuda = array(
		'name'  => 'otkuda',
		'id'    => 'otkuda',
		'class' => 'orderLabels',
		'value' => set_value('otkuda')
	);
	$kuda = array(
		'name'  => 'kuda',
		'id'    => 'kuda',
		'class' => 'orderLabels',
		'value' => set_value('kuda')
	);
?>
		<div>
		<?php echo validation_errors();?>
        </div>
		<div>
			<label for="otkuda" id="otlabel">Откуда:</label>
        	<?php echo form_input($otkuda);?>
        </div>
        <div>
        	<label for="kuda" id="klabel">Куда:</label>
        	<?php echo form_input($kuda);?>
        </div>
        <div>
        	<label for="date" id="dlabel">На какой день:</label>
        	<?php echo form_input($date);?>
        </div>
        <div>
        	<label for="time" id="tlabel">Время:</label>
        	<?php echo form_dropdown('hours',$hours,'00');?>
            <?php echo form_dropdown('mins',$mins,'00');?>
        </div>
        <div>
			<label for="surname" id="slabel">Фамилия:</label>
        	<?php echo form_input($surname);?>
        </div>
        <div>
			<label for="name" id="nlabel">Имя:</label>
        	<?php echo form_input($name);?>
        </div>
        <div>
        	<label for="contacts" id="conlabel">Номер Тел:</label>
        	<?php echo form_input($contacts);?>
        </div>
        <div>
        	<label for="contacts" id="conlabel">Такси Компания:</label>
        	<?php echo form_dropdown('company',$companies); ?>
        </div>
        <div>
        	<label for="contacts" id="conlabel">Ваш город:</label>
        	<?php echo form_dropdown('city',$cities,$this->session->userdata['city_id']); ?>
        </div>
        <div>
        	<?php echo form_submit(array('name'=>'order_button'),'Order');?>
        </div>
        <?php echo form_close();?>        
</div>