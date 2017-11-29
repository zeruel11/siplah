<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php if ($this->session->userdata('logged_in')) {
		?><title>Web SIPLAH - Selamat Datang User <?php echo $username; ?></title><?php
	} else {
		?><title>Web SIPLAH - Selamat Datang</title><?php
	}
	?>
</head>
</html>