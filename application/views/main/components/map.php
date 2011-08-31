<?php if ($logged_in) : ?>
<div><button id="data_to_server">Отображать меня на карте</button></div>
<?php endif;?>
<div id="map" style="margin-top:10px;width:250px;height:250px;margin-left:auto;margin-right:auto;float:left;"></div>
<? echo $this->load->view('main/twits'); ?>
