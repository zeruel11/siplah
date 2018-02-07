<head>
	<!-- core css imports -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>

	<!-- core javascript import -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>assets/js/popper-1.12.9.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

</head>
<body>
	<main class="container-fluid mt-3">
	<!-- <div class="card-body"> -->
	<?php if (isset($message)) {
		echo '<div class="alert alert-primary fade show animated fadeInUp w-60" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>'.$message.'</div>'; }
		if ($all_user!=null) { ?>
			<table class="table table-bordered table-hover">
				<thead class="thead-inverse">
					<tr>
						<th>#</th>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>User Level</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $u=0; foreach ($all_user as $row) { ?>
						<tr>
							<th><?php echo $all_user[$u]['uid']; ?></th>
							<th><?php echo $all_user[$u]['username']; ?></th>
							<th><?php echo $all_user[$u]['namaLengkap']; ?></th>
							<th><?php echo $all_user[$u]['userLevel']; ?></th>
							<th><div class="btn-group" role="group" aria-label="Basic example">
								<a class="btn btn-primary" href="<?php echo base_url('manage/updateUser/').$all_user[$u]['uid'] ?>" role="button">Update User</a>
								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalReset<?php echo $all_user[$u]['uid'] ?>">Reset Password</button>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?php echo $all_user[$u]['uid'] ?>">Delete User</button>
							</div></th>
						</tr>
						<?= isset($modal)?$modal:NULL ?>

						<!-- Modal Reset -->
						<div class="modal fade" id="modalReset<?php echo $all_user[$u]['uid'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalResetTitle" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalResetTitle">Perhatian!</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										Apakah anda yakin ingin melakukan reset password user?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										<a class="btn btn-warning" href="<?php echo base_url('manage/resetPassword/').$all_user[$u]['uid'] ?>" role="button">Reset Password</a>
									</div>
								</div>
							</div>
						</div>
					<?php $u++;
					} ?>
				</tbody>
			</table>
	<?php } ?>

	<a class="btn btn-success" href="<?php echo base_url('manage/user_baru') ?>" role="button">Add User</a>
	<a class="btn btn-secondary float-right" href="<?php echo base_url('beranda') ?>" role="button">HOME</a>
</main>
</body>

<script>
// $('.alert').addClass('animated fadeInUp');
setTimeout(function () {
	$(".alert").alert('close')
}, 3500);

$(function () {
		$('body').on('close.bs.alert', function(e){
				e.preventDefault();
				e.stopPropagation();
				$(e.target).slideUp();
		});
});
</script>
