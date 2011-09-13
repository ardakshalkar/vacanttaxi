
<div id="msgs">
	<div id="taxist_msg">
		<h3>Водитель</h3>

		<?php 
			$data['messages']=$taxist_msg;
			$data['ulid'] = 'show_msgT';
			echo $this->load->view('main/twit_map',$data);
		?>
		
		<div id="leaveMsg" class="leaveMsg">
			<input type="submit" value="Оставить сообщение" type_value='1' class="msgButton"/>
		</div>
	</div>
    <div id="client_msg">
		<h3>Пассажир</h3>
        <?php 
			$data['messages']=$client_msg;
			$data['ulid'] = 'show_msgC';
			echo $this->load->view('main/twit_map',$data);
		?>
		<div id="leaveMsg" class="leaveMsg">
			<input type="submit" value="Оставить сообщение" type_value='0' class="msgButton"/>
		</div>

    </div>
    <div id="dialog-form" title="Оставить сообщение">
       	<?php 
			$id = $this->session->userdata('user_id');
			if($logged_in){
				$contact = $user->contacts;
//				print_r($user);
				echo $contact;
			}
			else{
				$name = '';$contact = '';
				$name = array(
					'name'  => 'name',
					'id'    => 'name',
					'class' => 'text ui-widget-content ui-corner-all', 
					'value' => $name
				);
			}
			echo form_open("unofficialOrder",array('name' => 'unoffOrder', 'id' => 'unoffOrder'));
			
			
			$contacts = array(
				'name'  => 'contacts',
				'id'    => 'contacts',
				'class' => 'text ui-widget-content ui-corner-all',
				'value' => $contact
			);
			$from = array(
				'name' => 'from',
				'id'   => 'from',
				'class' => 'text ui-widget-content ui-corner-all',
				'value'=> ''
			);
			$to = array(
				'name' => 'to',
				'id'   => 'to',
				'class' => 'text ui-widget-content ui-corner-all',
				'value'=> ''
			);
			$messages = array(
				'name'  => 'messages',
				'id'    => 'destination',
				'rows'  => '3',
				'class' => 'text ui-widget-content ui-corner-all',
				'value' => ''		
			);
			$radiobox1 = array(
				'name' => 'type',
				'id'   => 'taxistbox',
				'value'=> '1',
				'checked'=>false
			);
			$radiobox2 = array(
				'name' => 'type',
				'id'   => 'clientbox',
				'value'=> '0',
				'checked'=>false
			);
		?>
        <p class="validateTips"></p>
        <fieldset>
            <? if (!$id) : ?>
				<label for="name" id="nlabel">Имя:</label>
				<?php echo form_input($name);?>
				
            <? endif; ?>
            <label for="contacts" id="clabel">Контакты:</label>
			<?php echo form_input($contacts);?>
            <label for="from" id="flabel">Откуда:</label>
            <?php echo form_input($from);?>
            <label for="to" id="tlabel">Куда:</label>
            <?php echo form_input($to);?>
           	<label for="destination">Описание (время, цена, требования):</label>
            <?php echo form_textarea($messages);?>
        </fieldset>
        <?php echo form_hidden('type','0');?>
        <?php echo form_close();?>        
    </div>
</div>
<?php
$beaconpush->add_channel('taxi'); 
echo $beaconpush->embed();
?>     
