<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Главная'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_orders','Заказы',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
<?= $orders;?>

<br/>
<button id="8" name="submit" type="submit" class="pro_order"><span>Принять</span></button>
</div>
<div id="dialog-form" title="Оформить заказ">
<?php 	$id = $this->session->userdata('admin_id');
			
			echo form_open("backend/process_order",array('name' => 'pro_order', 'id' => 'pro_order'));
			
			$js = 'id="shirts" onChange="some_function();"';
			$options = array(
                  '1111'  => 'Неизвестно',
                  '1112'    => 'Аукцион',
                  '1113'   => 'Отказано',
                  '1114' => 'Принято',
                  '1115' => 'Выполнено'
                );
			
			$messages = array(
				'name'  => 'message',
				'id'    => 'message',
				'rows'  => '3',
				'cols' =>'30',
				'class' => 'text ui-widget-content ui-corner-all',
				'value' => ''		
			);
			
		?>
        <p class="validateTips"></p>
        <fieldset>
            <label for="status" id="clabel">Статус:</label>
			<?php echo form_dropdown('status',$options);?>
			</br>
           	<label for="message">Причина отказа:</label>
            <?php echo form_textarea($messages);?>
        </fieldset>
        <?php echo form_hidden('order_id','0');?>
        <?php echo form_hidden('prev_stat','1111');?>
        <?php echo form_close();?>        
    </div>

<div class="clear"></div>

