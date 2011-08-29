<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Мы рады видеть вас на <?php echo $site_name; ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Рады видеть вас на сайте <?php echo $site_name; ?>!</h2>
Спасибо за то что зарегистрировались на "<?php echo $site_name; ?>".<br />
Чтобы подтвердить ваш email нажмите на ссылку ниже:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">Закончите регистрацию...</a></b></big><br />
<br />
Ссылка не работает? Тогда скопируйте указанные ниже текст и вставьте его в адресную строку браузера:<br />
<nobr><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
Пожалуйста подтвердите ваш email в течение <?php echo $activation_period; ?> часов, иначе вам снова придется регистрироватся.<br />
<br />
<br />
<?php if (strlen($username) > 0) { ?>Ваше имя пользователя: <?php echo $username; ?><br /><?php } ?>
Ваш адрес: <?php echo $email; ?><br />
<?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
<br />
<br />
Удачи! По чаще заходите на сайт с нами весело!<br />
Команда сайта "<?php echo $site_name; ?>"
</td>
</tr>
</table>
</div>
</body>
</html>
