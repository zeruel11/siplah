<nav class="navbar fixed-top navbar-dark" style="background-color: rgba(1, 56, 128, 0.9);">
	<?php if (isset($userLogin)) {
		if ($userLogin['userLevel']==1) {
			$userAccess = "Admin";
		} elseif ($userLogin['userLevel']==2) {
			$userAccess = "Pegawai";
		} else {
			$userAccess = "Pengguna Lain";
		}
	}
	?>
	<a class="navbar-brand <?php if(isset($userLogin['userLevel'])!=1) echo('mr-auto') ?>" href="<?php echo base_url(); ?>"><img style="margin-right: 10px" src="<?php echo base_url(); ?>assets/img/logo-its.png" alt="" class="d-inline-block align-center" width="35" height="35"><?php if (isset($userAccess)) {
		echo "Selamat datang ".$userAccess." ".$userLogin['namaLengkap'];
	} else {
		echo " Selamat Datang di Website SIPLAH ";
	} ?></a>
	<?php if (isset($userLogin['userLevel'])==1) {
		echo '<a class="btn btn-primary mr-auto" href="#" role="button"></a>';
	} ?>
	<?php if (isset($userLogin)) { ?>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>logout" role="button">Logout</a>
	<?php } else { ?>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>login" role="button">Login</a>
	<?php } ?>
	<form class="form-inline" role="form" method="POST" action="<?php echo base_url(); ?>search/">
		<div class="input-group mb-2 mb-sm-0 ml-sm-2">
			<input class="form-control" type="search" id="gedung" name="gedung" placeholder="Cari gedung...">
			<span class="input-group-btn"><button type="submit" class="btn btn-secondary">Search</button></span>
		</div>
	</form>
</nav>