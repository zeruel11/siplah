<head>
	<!-- css imports -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/leaflet.css" /> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/grid.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css"> -->

	<!-- core javascript import -->
	<!-- <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" charset="utf-8"></script> -->
	<!-- <script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script> -->
	<!-- <script src="<?php echo base_url(); ?>assets/js/popper-1.12.9.js" charset="utf-8"></script> -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
</head>
<body>
	<div class="container-fluid mt-3">
	<!-- <div class="card-body"> -->
	<?php if ($all_user!=null) {
		// var_dump($detailGedung) ?>
			<!-- <h4 class="card-text">Gedung <?php echo $detailGedung[0]['namaGedung']; ?></h4> -->
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
							<th><a class="btn btn-warning" href="<?php echo base_url('manage/updateUser/').$all_user[$u]['uid'] ?>" role="button">Update User</a>
								<a class="btn btn-danger" href="<?php echo base_url('manage/deleteUser/').$all_user[$u]['uid'] ?>" role="button">Delete User</a>
							</th>
						</tr>
					<?php $u++;
					} ?>
				</tbody>
			</table>
	<?php } else { ?>
		<!-- <h4 class="card-text">Gedung tidak ditemukan</h4> -->
	<?php } ?>
	<!-- </div> -->
	<a class="btn btn-success" href="<?php echo base_url('manage/createUser') ?>" role="button">Add User</a>
	<a class="btn btn-secondary float-right" href="<?php echo base_url('beranda') ?>" role="button">HOME</a>
	</div>
	<?php var_dump($all_user) ?>
</body>
