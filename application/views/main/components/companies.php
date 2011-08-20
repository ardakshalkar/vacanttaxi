<?php 
foreach ($companies as $company) {
	?>
		<div id="c<?php echo $company->id;?>" class="company_block">
			<div class="company_logo"></div>
			<h3 class="company_name"><?=$company->company_name?></h3>
			<div class="company_about"><?=$company->about?></div>
			<div class="company_contacts"><?=$company->contacts?></div>
			<a href="<?=$company->site?>">Сайт</a>
		</div>
	<?
}
?>
