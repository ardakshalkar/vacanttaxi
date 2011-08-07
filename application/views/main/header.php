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
	<img src="<?php echo base_url()."style/images/logo.png"; ?>" />
	<div id="user">
		<?php if (!$logged_in) : ?>
			<span id="taxist">Войти</span>
		<?php else:?>
			<?= $username; ?> <a href="<?=base_url()."index.php/auth/logout"?>">Выйти</a><br/>
			<a href="<?=base_url()?>/index.php/auth/edit_driver">Edit driver info</a>|
			<a href="<?=base_url()?>/index.php/auth/edit_profile">Edit profile info</a>
		<?php endif ?>
		<div id = "changeCity">
			<label  id="yourCity">Your city:</label><button id = "cityName"><?=$city?></button>
		</div>
		<?php echo anchor("chat/start",'<img id="chat_img"  src="'.base_url().'style/images/chat.png" />','target="_blank"'); ?>

	</div>
	<div id="menu">
		<? echo ul($links); ?><div class="clear"></div>
	</div>
</div>




        <div id="taxistDiv">
			<script src="http://loginza.ru/js/widget.js" type="text/javascript"></script>
			<div style="float:left;width:48%;"><iframe src="http://loginza.ru/api/widget?overlay=loginza&token_url=<?= base_url()."index.php/login/loginza"?>" 
			style="width:359px;height:300px;" scrolling="no" frameborder="no"></iframe></div>
			<div style="float:right;width:48%;position:relative;">
				<div id="loginPart"></div>
				<div id="loginCloseButton">X</div>
			</div>
			
        </div>
<div id = "dialog">
    <ul>
		    
    </ul>
</div>

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
