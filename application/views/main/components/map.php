<?php if ($logged_in) : ?>
<div><button id="data_to_server">Отображать меня на карте</button></div>
<?php endif;?>

<div id="map" style="margin-top:10px;width:375px;height:375px;margin-left:auto;margin-right:auto;float:left;"></div>
<div id="cars_on_map_info">На карте <span id="car_amount">0</span> машин</div>
<? echo $this->load->view('main/twits'); ?>
