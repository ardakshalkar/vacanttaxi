<?php $this->load->view('main/begin'); ?>
<title><?php echo $main_title; ?></title>
</head>
<body onload="initialize();getCities();">
	<div id="wrapper">
		<div id="top">
			<?php $this->load->view('main/header'); ?>
		</div>
		<div id="present">
			<?php $this->load->view('main/components/'.$component); ?>
		</div>
		<div id="footer"><?php $this->load->view('main/footer'); ?></div>
	</div>
</body>
</html>
