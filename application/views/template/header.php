<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php if ($this->session->userdata('logged_in')) {
		?><title>SIPLAH ITS - Pengguna: <?php echo $userLogin['namaLengkap']; ?></title><?php
	} else {
		?><title>SIPLAH ITS</title><?php
	}
	?>
	<!-- css imports -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/grid.css" />

	<!-- core javascript import -->
	<script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<style>

	#image-map {
		width: 100%;
		height: 500px;
		border: 3px solid #ccc;
		/*margin-bottom: 10px;*/
	}

</style>


</head>
