	<?php $this->output->enable_profiler(TRUE); ?>
	<div class="card-body col-lg-10 pt-1">
		<?= isset($modal_warning)?$modal_warning:'' ?>
		<?php if (isset($message)): ?>
			<div class="alert alert-primary fade show animated fadeInUp w-60" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button><?= $message ?></div>
		<?php endif ?>
		<?php if (isset($dataRenovasi) && $dataRenovasi[0]['idProposal']!=null): ?>
			<?php $r=0; foreach ($dataRenovasi as $row): ?>
			<?php if ($r==0): ?>
				<h3 class="card-title mt-3">Gedung <?= $row['namaGedung'] ?>
					<?php if ($this->uri->segment(2)=='ALL'): ?>
					<a class="btn btn-sm btn-outline-primary ml-2" href="<?= base_url('gedung/').$row['idGedung'] ?>" role="button">Data Gedung</a>
					<?php endif; ?>
				</h3>
			<?php elseif ($dataRenovasi[$r]['namaGedung']!=$dataRenovasi[$r-1]['namaGedung']): ?>
				<h3 class="card-title mt-3">Gedung <?= $row['namaGedung'] ?>
					<?php if ($this->uri->segment(2)=='ALL'): ?>
					<a class="btn btn-sm btn-outline-primary ml-2" href="<?= base_url('gedung/').$row['idGedung'] ?>" role="button">Data Gedung</a>
					<?php endif ?>
				</h3>
			<?php endif ?>
				<div class="card mt-2">
					<div class="row no-gutters">
						<div class="card-block col-lg-6 w-50">
							<h5 class="card-title"><?= $row['judulProposal']; ?></h5>
							<?php if (isset($row['dateDeleted']) && $row['dateDeleted']!=NULL): ?>
								<p class="card-subtitle text-success"> -Renovasi telah selesai- </p>
							<?php elseif ($row['deskripsiProposal']!=NULL): ?>
								<p class="card-subtitle text-muted text-truncate"><?= $row['deskripsiProposal'] ?></p>
							<?php else: ?>
								<p class="card-subtitle text-danger"> -proposal tidak memiliki deskripsi- </p>
							<?php endif ?>
						</div>
						<div class="card-block col-lg-6 p-1 w-50 text-right">
							<p class="card-subtitle text-muted">Tanggal Mulai Renovasi: <?= $row['dateCreated']?></p>
							<p class="card-subtitle text-muted">Tanggal Selesai Renovasi: <?= (isset($row['dateDeleted']) && $row['dateDeleted']!=NULL)?$dataRenovasi[$r]['dateDeleted']:"-"?></p>
						</div>
					</div>
					<div class="row no-gutters pl-1">
						<div class="card-block col-lg-6 pr-3">
							<?php if ($row['status']==3): ?>
								<strong class="h5 text-danger">- Renovasi ditolak -</strong>
							<?php elseif ($row['status']==0): ?>
								<strong class="h5 text-info">- Menunggu persetujuan WR II -</strong>
							<?php else: ?>
								<div class="progress">
								<?php if (isset($row['dateDeleted']) && $row['dateDeleted']!=NULL): ?>
									<div class="progress-bar progress-bar-striped bg-success" style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
								<?php elseif(isset($row['progress'])) : ?>
									<?php if ($row['progress']==0): ?>
										<div class="progress-bar bg-warning" style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">0%</div>
									<?php elseif($row['progress']==100): ?>
										<div class="progress-bar bg-success" style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
									<?php else: ?>
										<div class="progress-bar" style="width: <?= $row['progress'] ?>%" role="progressbar" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $row['progress'] ?>%</div>
									<?php endif ?>
								<?php else: ?>
									<div class="progress-bar progress-bar-striped bg-warning" style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Pekerjaan Kosong</div>
								<?php endif ?>
							</div>
							<?php endif ?>
						</div>
						<!-- definisi button -->
						<div class="card-block col-lg-6 text-right">
							<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2): ?>
								<div class="btn-group float-right" role="group">
									<a class="btn btn-outline-info" href="<?= base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi<?= ($row['status']==6 || $row['status']==3)?'':' & Pekerjaan' ?></a>
									<?php if ($row['status']!=6 && $row['status']!=0): ?>
									<a class="btn btn-outline-success" href="<?= base_url('renovasi/selesai/').$dataRenovasi[$r]['idProposal'] ?>" role="button" data-toggle="tooltip" data-placement="top" title="Tandai renovasi telah selesai">Selesai Renovasi</a>
									<?php endif; ?>
									<a class="btn btn-outline-warning" href="<?= base_url()."renovasi/ed/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Ubah Data Renovasi</a>
									<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalHapus<?= $dataRenovasi[$r]['idProposal'] ?>">Hapus</button>
								</div>
							<?php elseif($userLogin['userLevel']==3): ?>
								<div class="btn-group float-right" role="group">
									<a class="btn btn-outline-info small-btn" href="<?= base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
									<?php if ($dataRenovasi[$r]['status']!=2 && $dataRenovasi[$r]['status']!=3 && $dataRenovasi[$r]['status']!=6): ?>
										<button class="btn btn-outline-success mini-btn" role="button" data-toggle="modal" data-target="#modalSetuju<?= $dataRenovasi[$r]['idProposal'] ?>">Setujui renovasi</button>
										<button class="btn btn-outline-danger mini-btn" role="button" data-toggle="modal" data-target="#modalTolak<?= $dataRenovasi[$r]['idProposal'] ?>">Tolak renovasi</button>
									<?php endif ?>
								</div>
							<?php elseif($userLogin['userLevel']==4): ?>
								<a class="btn btn-outline-info" href="<?= base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Ceklis Pekerjaan</a>
							<?php else: ?>
								<a class="btn btn-outline-info small-btn" href="<?= base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
							<?php endif ?>
						</div>
					</div>
				</div>

				<?= isset($modal)?$modal[$row['idProposal']]:"" ?>
				<?= isset($modalSetuju)?$modalSetuju[$row['idProposal']]:"" ?>
				<?= isset($modalTolak)?$modalTolak[$row['idProposal']]:"" ?>

				<?php $r++; endforeach ?>
			<?php else: ?>
				<h4 class="card-text"><?= (isset($dataRenovasi)?'Gedung '.$dataRenovasi[0]['namaGedung'].' belum memiliki data renovasi':'Data renovasi tidak tersedia/belum disetujui') ?></h4>
			<?php endif ?>
		<div class="row">
			<div class="col-lg-9">
					<?php if (($userLogin['userLevel']==1 || $userLogin['userLevel']==2 || $userLogin['userLevel']==5) && $this->uri->segment(2)!='ALL'): ?>
						<a class="btn btn-outline-success mt-3" href="<?= base_url('ajuan'); ?>" role="button">Tambah Renovasi Baru</a>
					<?php elseif ($this->uri->segment(2)=='ALL'): ?>
						<blockquote class="blockquote text-justify text-info">Untuk menambah/mengajukan renovasi silahkan masuk ke gedung terlebih dahulu.</blockquote>
					<?php endif ?>
			</div>
			<div class="col-lg-3">

			</div>
		</div>
	</div>
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
