<?php 	$attributes = array('class' => 'email', 'id' => 'myform'); 
	echo form_open("front/login", $attributes); ?>
<div id="log">Login:&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="login" id="login"/></div>
<div id="psw">Password: <input type="password"  name="password" id="password"/></div>
<div id="register">
<?php echo anchor("","Регистрация"); ?>
<?php echo form_submit("sign","Войти"); ?>
</div>
<?php echo form_close(); ?>
</div>
<div style="color:#FF0000;text-align:center;">
<?php echo $this->form_validation->error_string(); ?>
<?php if(isset($login_error_message)) echo $login_error_message; ?></div>

