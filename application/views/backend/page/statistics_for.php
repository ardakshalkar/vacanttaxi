<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/statistics','Заказы'); ?>  &raquo; 
    <?php echo anchor('/backend/statistics_for/'.$id,'Статистика',array('class'=>'active')); ?>
</h2>

<div id="main">
<h3>Статистика заказов</h3>
<br/>
<table style="width:80%;">
<tr>
	<td><?php echo "В ожидании: ".$report[0];?></td>
</tr>
<tr>
	<td><?php echo "Аукцион: ".$report[1];?></td>
</tr>
<tr>
	<td><?php echo "Отказано: ".$report[2];?></td>
</tr>
<tr>
	<td><?php echo "Принят: ".$report[3];?></td>
</tr>
<tr>
	<td><?php echo "Выполнено: ".$report[4];?></td>
</tr>
<tr>
	<td><?php echo "Всего: ".$report[5];?></td>
</tr>
</table>
</div>

<div class="clear"></div>