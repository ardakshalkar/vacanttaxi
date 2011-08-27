<?php $this->load->view('backend/head-content'); ?>
<body onload="initialize()">
<div id="wrapper">

	<?php $this->load->view('backend/header-menu'); ?>

    <div id="containerHolder">
        <div id="container">
        <?php $this->load->view('backend/left-menu'); ?>
        <?php $this->load->view('backend/'.$PAGE); ?>
        </div>
    </div>	
	
	<p id="footer">Официальные права DimondIt</p>

</div>
</body>
</html>
