<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<body>
	<h1>SIPLAH login</h1>
	<h2><?php echo $namaLengkap; ?></h2>
	<h2>Anda masuk sebagai: <?php echo $userAuth; ?></h2>
	<p><a href="<?php echo base_url(); ?>index.php/beranda/keluar">Logout</a></p>
</body>