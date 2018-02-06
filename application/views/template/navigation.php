<body>
<nav class="navbar fixed-top navbar-dark" style="background-color: rgba(1, 56, 128, 0.9);">
	<?php if (isset($userLogin)) {
		if ($userLogin['userLevel']==1) {
				$userAccess = "Admin:";
		} elseif ($userLogin['userLevel']==2) {
				$userAccess = "Pegawai SIMRI:";
		} elseif ($userLogin['userLevel']==3) {
				$userAccess = "Wakil Rektor II:";
		} elseif ($userLogin['userLevel']==4) {
				$userAccess = "SARPRAS:";
		} elseif ($userLogin['userLevel']==5) {
						$userAccess = "Unit/Jurusan:";
		} else {
				$userAccess = "Pengguna Lain";
		}
}
		?>
	<a class="navbar-brand mr-auto" href="<?= base_url() ?>"><img style="margin-right: 10px" src="<?= base_url() ?>assets/img/logo-its.png" alt="" class="d-inline-block align-center" width="35" height="35"><?php if (isset($userAccess)) {
				echo "Selamat datang ".$userAccess." ".$userLogin['namaLengkap'];
		} else {
				echo " Selamat Datang di Website SIPLAH ";
		} ?></a>
	<?php if (isset($userLogin)) {
				?>
				<a type="button" class="btn btn-primary mr-2" target="_blank" href="<?= base_url('gantipassword').$userLogin['uid'] ?>">Ganti Password</a>
				<div class="btn-group">
					<a class="btn btn-primary" href="<?= base_url('logout') ?>" role="button">Logout</a>
					<?php if ($userLogin['userLevel']==1) { ?>
						<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only">Manage User</span>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<?= base_url('manage') ?>">Manage User</a>
						<a class="dropdown-item" href="<?= base_url('manage/user_baru') ?>">Tambah User</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
					<?php } ?>
				</div>
	<?php
		} else {
				?>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>login" role="button">Login</a>
	<?php
		} ?>
	<form class="form-inline" role="form" method="POST" action="<?php echo base_url(); ?>search/">
		<div class="input-group mb-2 mb-sm-0 ml-sm-2">
			<input class="form-control" type="search" id="cari_gedung" name="cari_gedung" placeholder="Cari gedung...">
			<span class="input-group-btn"><button type="submit" class="btn btn-secondary">Search</button></span>
		</div>
	</form>
</nav>
