<?
$menu = array(array('title'=>lang("menu_home"),'link'=>'front'),
	array('title'=>lang("menu_catalogue"),'link'=>'catalogue'),
	array('title'=>lang("menu_order"),'link'=>'order'),
	array('title'=>lang("menu_companies"),'link'=>'catalogue/companies'),
	array('title'=>lang("menu_map"),'link'=>'front/map'));
$links = array();
foreach ($menu as $mitem){
	$links[] = anchor($mitem["link"],$mitem["title"]);
}
?>

<div id = "header">
	<div>
	</div>
	<img src="<?php echo base_url()."style/images/logo.png"; ?>" />
	
	<div id="user">
		<?php if (!$logged_in) : ?>
			<div id="enter">Войти</div>
		<?php else:?>
			<?= $user->displayname; ?> <a href="<?=base_url()."index.php/auth/logout"?>">Выйти</a><br/>
			<a href="<?=base_url()?>/index.php/auth/edit_driver">В каталоге</a>|
			<a href="<?=base_url()?>/index.php/auth/edit_profile">Изменить профиль</a>
		<?php endif ?>
		<div id = "changeCity">
			<label  id="yourCity">Ваш город:</label><button id = "cityName"><?=$city?></button>
		</div>
		<?php if ($logged_in) : ?>
			<?php echo anchor("chat/start",'<img id="chat_img"  src="'.base_url().'style/images/chat.png" />','target="_blank"'); ?>
		<?php endif; ?>
	</div>
</div>


<div id = "dialog">
    <ul>
		    
    </ul>
</div>


	<?php if (!$logged_in) : ?>
        <div id="taxistDiv" title="Войдите в сайт">
			<script src="http://loginza.ru/js/widget.js" type="text/javascript"></script>
			<div style="float:left;width:48%;">
				<div id="loginzaInfo">Зайдите с помощью вашего аккаунта из социальных сетей</div>
				<iframe src="http://loginza.ru/api/widget?overlay=loginza&lang=ru&token_url=<?= base_url()."index.php/login/loginza"?>" style="width:359px;height:300px;" scrolling="no" frameborder="no">
				</iframe>
			</div>
			<div style="float:right;width:48%;position:relative;">
				<div id="registerInfo">Или создайте аккаунт на нашем сайте</div>
				<div id="loginPart">
					
				</div>
			</div>
			<div style="clear:both;"></div>
        </div>
	<?php endif;?>
<? /*
<div id="user">
	
	<? /*
	<div id="social_login">
		<a href="<?php echo base_url()."index.php/login/facebook";?>">Facebook</a>
		<div id="vk_auth"></div>
		<a href="https://accounts.google.com/o/oauth2/auth?client_id=968251785357.apps.googleusercontent.com&redirect_uri=https://localhost/VacanTaxi/index.php/login/google&scope=https://www.google.com/m8/feeds/&response_type=code">
		Google
		</a>
	</div>
	*/ ?>
