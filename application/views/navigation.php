<nav class="navbar navbar-fixed-top navbar-dark" style="background-color: rgba(1, 56, 128, 0.9);">
	<?php if ($this->session->userdata('logged_in')) {
    ?>
	<span class="navbar-text">Selamat datang <?php echo $userAuth." ".$namaLengkap; ?></span>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/logout" role="button">Logout</a>
	<?php
} else {
        ?>
		<span class="navbar-brand">Selamat Datang di Website SIPLAH ITS</span>
		<a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/login" role="button">Login</a>
		<?php
    } ?>
</nav>