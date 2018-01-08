<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php if ($this->session->userdata('logged_in')) {
		?><title>SIPLAH ITS - Selamat Datang <?php echo $namaLengkap; ?></title><?php
	} else {
		?><title>SIPLAH ITS</title><?php
	}
	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/grid.css" />

	<script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	<style>
	#image-map {
		width: 100%;
		height: 500px;
		border: 3px solid #ccc;
		/*margin-bottom: 10px;*/
	}

	.divTable{
		display: table;
		width: 100%;
	}
	.divTableRow {
		display: table-row;
	}
	.divTableHeading {
		background-color: #00ffffff;
		display: table-header-group;
	}
	.divTableCell, .divTableHead {
		/*border: 1px solid #999999;*/
		display: table-cell;
		padding: 3px 10px;
	}
	.divTableHeading {
		background-color: #00ffffff;
		display: table-header-group;
		font-weight: bold;
	}
	.divTableFoot {
		background-color: #00ffffff;
		display: table-footer-group;
		font-weight: bold;
	}
	.divTableBody {
		display: table-row-group;
	}
</style>


</head>