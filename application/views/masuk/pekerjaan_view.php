	<div class="card-body col-lg-10">
		<?php if (array_key_exists("idPekerjaan", $dataPekerjaan[0])) {
		// var_dump($dataPekerjaan) ?>
		<h4 class="card-title">Renovasi: <?php echo $dataPekerjaan[0]['judulProposal']; ?></h4>
		<p class="card-text"><?php echo $dataPekerjaan[0]['deskripsiProposal']; ?></p>
		<p class="card-subtitle text-muted">Tanggal mulai renovasi: <?= $dataPekerjaan[0]['dateCreated'] ?></p>
		<p class="card-subtitle text-muted">Tanggal selesai renovasi: <?= $dataPekerjaan[0]['dateDeleted'] ?></p>
		<ul class="list-group mt-3">
			<?php $k=0; $b=0; foreach ($dataPekerjaan as $row) {
				if ($dataPekerjaan[$k]['status']=='1') {
					$b++;
				} ?>
				<li class="list-group-item"><?php echo $dataPekerjaan[$k]['detailPekerjaan']." - ".(($dataPekerjaan[$k]['status']=='1')?"Sudah dikerjakan":"Belum dikerjakan"); ?>
					<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2) { ?>
						<span class="btn-group float-right" role="group">
							<?php //if ($dataPekerjaan[$k]['status']=='0') { ?>
							<a class="btn btn-outline-warning" href="edit/<?php echo $dataPekerjaan[$k]['idPekerjaan'] ?>" role="button">Ubah</a>
							<?php //} ?>
							<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalHapus<?php echo $dataPekerjaan[$k]['idPekerjaan'] ?>">Hapus</button>
						</span>
					<?php } ?>
				</li>
				<!-- Modal -->
				<div class="modal fade" id="modalHapus<?php echo $dataPekerjaan[$k]['idPekerjaan'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalDeleteTitle">Perhatian!</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Apakah anda yakin ingin menghapus pekerjaan?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a class="btn btn-danger" href="<?php echo base_url('beranda/hapusPekerjaan/').$dataPekerjaan[$k]['idPekerjaan'] ?>" role="button">Hapus</a>
							</div>
						</div>
					</div>
				</div>
				<?php $k++;

			} ?>
		</ul>
		<?php $bar = round($b/$k, 2)*100; ?>
	<h6>Progress:</h6>
	<div class="progress">
		<?php echo '<div class="progress-bar" style="width: '.$bar.'%" role="progressbar" aria-valuenow="'.$bar.'" aria-valuemin="0" aria-valuemax="100">'.$bar.'%</div>'; ?>
	</div>
		<?php } else { ?>
		<h4 class="card-text">Proposal <?php echo $dataPekerjaan[0]['judulProposal']; ?> belum memiliki daftar pekerjaan</h4>
		<p class="card-text"><?php echo $dataPekerjaan[0]['deskripsiProposal']; ?></p>
		<?php }
	// var_dump($this->session->flashdata('proposal'));
	// echo $this->output->enable_profiler(TRUE);
	if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2) { ?>
		<a class="btn btn-outline-success mt-3" href="baru" role="button">Tambah Pekerjaan</a>
	<?php } ?>
</div>
</body>
