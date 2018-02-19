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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/leaflet.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/grid.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/animate.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/MapkeyIcons.css'); ?>" />

	<!-- core javascript import -->
	<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>" charset="utf-8"></script>
	<script src="<?php echo base_url('assets/js/leaflet.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/popper.min.js'); ?>" charset="utf-8"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/Leaflet.Icon.Glyph.js'); ?>" type="text/javascript"></script>
	<!-- <script src="<?php echo base_url('assets/js/notify.js'); ?>"></script> -->

	<link rel="shortcut icon" href="<?php echo base_url('assets/img/ITS.ico') ?>">

</head>
