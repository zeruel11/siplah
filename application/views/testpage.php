<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<body>
	<h1>Hello World</h1>
	<h1>You are now logged in</h1>
	<h2><?php echo $namaLengkap; ?></h2>
	<h2>Anda masuk sebagai: <?php echo $userAuth; ?></h2>
	<!-- <?php var_dump($testing) ?> -->
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	<p><a href="<?php echo base_url(); ?>index.php/beranda/keluar">Logout</a></p>
</body>