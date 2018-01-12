<nav class="navbar fixed-top navbar-dark" style="background-color: rgba(1, 56, 128, 0.9);">
	<?php if ($this->session->userdata('logged_in')) {
    ?>
	<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo-its.png" alt="" class="d-inline-block align-center" width="35" height="35">Selamat datang <?php echo $userAuth." ".$namaLengkap; ?></a>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>logout" role="button">Logout</a>
	<?php
} else {
        ?>
				<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo-its.png" alt="" class="d-inline-block align-center" width="35" height="35"> Selamat Datang di Website SIPLAH ITS</a>
		<!-- <span class="navbar-brand"></span> -->
		<a class="btn btn-primary" href="<?php echo base_url(); ?>login" role="button">Login</a>
		<?php
    } ?>
</nav>
