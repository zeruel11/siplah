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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/leaflet.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/grid.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">

	<!-- core javascript import -->
	<script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" charset="utf-8"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
