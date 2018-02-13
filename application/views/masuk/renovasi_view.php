	<?php $this->output->enable_profiler(TRUE); ?>
	<div class="card-body col-lg-10 pt-1">
		<?php if (isset($message)) {
				echo '<div class="alert alert-primary fade show animated fadeInUp w-60" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button>'.$message.'</div>';
		} if (isset($dataRenovasi) && $dataRenovasi[0]['idProposal']!=null) {
			$r=0; foreach ($dataRenovasi as $row) {
				if ($r==0) {
					echo '<h3 class="card-title mt-3">Gedung '.$row['namaGedung'] .'</h3>';
				} elseif ($dataRenovasi[$r]['namaGedung']!=$dataRenovasi[$r-1]['namaGedung']) {
					echo '<h3 class="card-title mt-3">Gedung '.$row['namaGedung'] .'</h3>';
				} ?>
				<div class="card mt-2">
					<div class="row no-gutters">
						<div class="card-block col-lg-6 w-50">
							<h5 class="card-title"><?= $row['judulProposal']; ?></h5>

							<?php if (isset($row['dateDeleted']) && $row['dateDeleted']!=NULL) {
											echo '<p class="card-subtitle text-success"> -Renovasi telah selesai- </p>';
									} elseif ($row['deskripsiProposal']!=NULL) {
										echo '<p class="card-subtitle text-muted text-truncate">'.$row['deskripsiProposal'].'</p>';
									} else {
										echo '<p class="card-subtitle text-danger"> -proposal tidak memiliki deskripsi- </p>';
									} ?>
						</div>
						<div class="card-block col-lg-6 p-1 w-50 text-right">
							<p class="card-subtitle text-muted">Tanggal Mulai Renovasi: <?= $row['dateCreated']?></p>
							<p class="card-subtitle text-muted">Tanggal Selesai Renovasi: <?= (isset($row['dateDeleted']) && $row['dateDeleted']!=NULL)?$dataRenovasi[$r]['dateDeleted']:"-"?></p>
						</div>
					</div>
					<div class="row no-gutters pl-1">
						<div class="card-block col-lg-6 pr-3">
							<div class="progress">
								<?php if (isset($row['dateDeleted']) && $row['dateDeleted']!=NULL) {
									echo '<div class="progress-bar progress-bar-striped bg-success" style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>';
								} elseif (isset($row['progress'])) {
									if ($row['progress']==0) {
										echo '<div class="progress-bar bg-warning" style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">0%</div>';
									} elseif ($row['progress']==100) {
										echo '<div class="progress-bar bg-success" style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>';
									} else {
										echo '<div class="progress-bar" style="width: '.$row['progress'].'%" role="progressbar" aria-valuenow="'.$row['progress'].'" aria-valuemin="0" aria-valuemax="100">'.$row['progress'].'%</div>';
									}
								} else {
									echo '<div class="progress-bar progress-bar-striped bg-warning" style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Pekerjaan Kosong</div>';
								} ?>
							</div>
						</div>
						<!-- definisi button -->
						<div class="card-block col-lg-6 text-right">
						<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2) { ?>
							<div class="btn-group float-right" role="group">
								<a class="btn btn-outline-info" href="<?= base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
								<?php if ($row['status']!=6): ?>
									<a class="btn btn-outline-success" href="<?= base_url('renovasi/selesai/').$dataRenovasi[$r]['idProposal'] ?>" role="button" data-toggle="tooltip" data-placement="top" title="Tandai renovasi telah selesai">Selesai Renovasi</a>
								<?php endif; ?>
								<a class="btn btn-outline-warning" href="<?= base_url()."renovasi/ed/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Ubah Data Renovasi</a>
								<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalHapus<?= $dataRenovasi[$r]['idProposal'] ?>">Hapus</button>
							</div>
						<?php } elseif ($userLogin['userLevel']==3) { ?>
						<div class="btn-group float-right" role="group">
						<a class="btn btn-outline-info small-btn" href="<?= base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
							<?php if ($dataRenovasi[$r]['status']!=2 && $dataRenovasi[$r]['status']!=3 && $dataRenovasi[$r]['status']!=6){ ?>
								<a class="btn btn-outline-success mini-btn" href="<?= base_url()."renovasi/setuju/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Setujui renovasi</a>
								<a class="btn btn-outline-danger mini-btn" href="<?= base_url()."renovasi/tolak/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Tolak renovasi</a>
							</div>
							<?php }
						} elseif($userLogin['userLevel']==4) { ?>
							<a class="btn btn-outline-info" href="<?= base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Ceklis Pekerjaan</a>
						<?php } else { ?>
						<a class="btn btn-outline-info small-btn" href="<?= base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
							<?php } ?>
						</div>
					</div>
				</div>

				<?= isset($modal)?$modal[$row['idProposal']]:"" ?>

				<?php $r++; } ?>
		<?php } else { ?>
			<h4 class="card-text"><?= (isset($dataRenovasi)?'Gedung '.$dataRenovasi[0]['namaGedung'].' belum memiliki data renovasi':'Data renovasi tidak tersedia/belum disetujui') ?></h4>
		<?php } ?>
		<div class="row">
			<div class="col-lg-9">
		<?php if (($userLogin['userLevel']==1 || $userLogin['userLevel']==2 || $userLogin['userLevel']==5) && $this->uri->segment(2)!='ALL') { ?>
			<a class="btn btn-outline-success mt-3" href="<?= base_url('ajuan'); ?>" role="button">Tambah Renovasi Baru</a>
		<?php } ?>
			</div>
			<div class="col-lg-3">

			</div>
		</div>
	</div>
</div>
</main>
	<?= $footer ?>

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

	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
	})
	</script>
