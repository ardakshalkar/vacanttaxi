<?php if (count($drivers)>0) : ?>
<ul>
<?php foreach ($drivers as $driver) { ?>
	<li><b><?= $driver->c_name ?></b>(<small><i><?= $driver->address ?></i></small>) : <?= $driver->about ?><br/>(T)<?= $driver->m_phone ?>, <?= $driver->h_phone ?></li>
<?php }?>
</ul>
<?php endif;?>
