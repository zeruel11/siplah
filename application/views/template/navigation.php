<nav class="navbar fixed-top navbar-dark" style="background-color: rgba(1, 56, 128, 0.9);">
	<?php if (isset($userLogin)) {
		if ($userLogin['userLevel']==1) {
			$userAccess = "Admin";
		} elseif ($userLogin['userLevel']==2) {
			$userAccess = "Pegawai SIMRI";
		} elseif ($userLogin['userLevel']==3) {
			$userAccess = "Wakil Rektor II";
		} elseif ($userLogin['userLevel']==4) {
			$userAccess = "SARPRAS";
		} else {
			$userAccess = "Pengguna Lain";
		}
	}
	?>
	<a class="navbar-brand mr-auto" href="<?php echo base_url(); ?>"><img style="margin-right: 10px" src="<?php echo base_url(); ?>assets/img/logo-its.png" alt="" class="d-inline-block align-center" width="35" height="35"><?php if (isset($userAccess)) {
		echo "Selamat datang ".$userAccess." ".$userLogin['namaLengkap'];
	} else {
		echo " Selamat Datang di Website SIPLAH ";
	} ?></a>
	<?php if (isset($userLogin['userLevel'])==1) { ?>
		<div class="dropdown">
		<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage User</button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="<?php echo base_url() ?>manage">Lihat User</a>
    <a class="dropdown-item" href="#">Tambah User</a>
    <!-- <a class="dropdown-item" href="#">Hapus User</a> -->
  </div>
	<?php } ?>
	<?php if (isset($userLogin)) { ?>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>logout" role="button">Logout</a>
	<?php } else { ?>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>login" role="button">Login</a>
	<?php } ?>
</div>
	<form class="form-inline" role="form" method="POST" action="<?php echo base_url(); ?>search/">
		<div class="input-group mb-2 mb-sm-0 ml-sm-2">
			<input class="form-control" type="search" id="gedung" name="gedung" placeholder="Cari gedung...">
			<span class="input-group-btn"><button type="submit" class="btn btn-secondary">Search</button></span>
		</div>
	</form>
</nav>
