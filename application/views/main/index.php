<?php $this->load->view('main/begin'); ?>
<title><?php echo $main_title; ?></title>
</head>
<body onload="initialize();getCities();">
	<div id="wrapper">
		<div id="top">
			<?php $this->load->view('main/header'); ?>
		</div>
		<div id="present">
			<div id="message_box"><?php echo $this->session->flashdata('message'); ?></div>
			<?php if (isset($message)) :?>
				<div id="instant_message_box"><? echo $message;?></div>
			<?php endif;?>
			<?php 
				if (isset($errors)) :
			?>
					<div class="errors_box">
					<? foreach ($errors as $error) { 
							echo $error.br();
					}?>
					</div>
			<?php endif; ?>
			<?php $this->load->view('main/components/'.$component); ?>
		</div>
	</div>
	<div id="footer"><?php $this->load->view('main/footer'); ?></div>
	<div id="catalogue_flying_box"><?php if (isset($drivers)) echo $this->load->view('main/driver_list');?></div>
	<?php $this->load->view('main/finish'); ?>
</body>
</html>
