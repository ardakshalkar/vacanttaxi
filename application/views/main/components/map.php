<?php if ($logged_in) : ?>
<div><button id="data_to_server">Отображать меня на карте</button></div>
<?php endif;?>

<div id="map" style="margin-top:10px;width:375px;height:375px;margin-left:auto;margin-right:auto;float:left;"></div>
<div id="cars_on_map_info">
	<div id="cars_on_map_amount_info">На карте <span id="car_amount">0</span> машин</div>
	<ul id="cars_on_map_list"></ul>
</div>
<? //echo $this->load->view('main/twits'); ?>
<div>
	<h2  style="clear:both;">Заказ такси онлайн</h2>
	<div style="clear:both;">
		<? echo anchor('order','Заказать');?>
	</div>
	<?php 
		foreach ($companies as $company){
			?>
			<div class="company_list">
				<img src="<?= $company->logo?>" width="150px" height="100px"/>
				<h3><?= $company->company_name ?></h3>
			</div>
				
			<?
		}
	?>
	<h2 style="clear:both;">Предложения</h2>
	<div style="clear:both;"><? echo anchor('front/twits','Перейти');?></div>
</div>
