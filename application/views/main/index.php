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
			<div id="instant_message_box"><?php if (isset($message)) echo $message;?></div>
			<div class="errors_box">
				<?php 
					if (isset($errors)){
						foreach ($errors as $error) { 
							echo $error.br();
						}
					}
				?>
			</div>
			<?php $this->load->view('main/components/'.$component); ?>
		</div>
	</div>
	<div id="footer"><?php $this->load->view('main/footer'); ?></div>
</body>
</html>
