<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php if ($this->session->userdata('logged_in')) {
		?><title>Web SIPLAH - Selamat Datang <?php echo $namaLengkap; ?></title><?php
	} else {
		?><title>Web SIPLAH - Selamat Datang</title><?php
	}
	?>
	<link rel="stylesheet" href="assets/css/leaflet.css">
    <style>
    #image-map {
      width: 50%;
      height: 300px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }
    </style>

    
</head>