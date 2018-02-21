	<?php $this->output->enable_profiler(TRUE); ?>
	<div class="card-body col-lg-10">
		<?php if (isset($message)): ?>
			<div class="alert alert-primary fade show animated fadeInUp w-60" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button><?= $message ?></div>
		<?php endif ?>
		<?php if ($dataPekerjaan[0]['idPekerjaan']!=NULL): ?>
			<h4 class="card-title">Renovasi: <?= $dataPekerjaan[0]['judulProposal']; ?></h4>
			<p class="card-text"><?= $dataPekerjaan[0]['deskripsiProposal']; ?></p>
			<p class="card-subtitle text-muted">Tanggal mulai renovasi: <?= $dataPekerjaan[0]['dateCreated'] ?></p>
			<p class="card-subtitle text-muted">Tanggal selesai renovasi: <?= ($dataPekerjaan[0]['dateDeleted']!=NULL)?$dataPekerjaan[0]['dateDeleted']:' - ' ?></p>
			<ul class="list-group mt-3">
				<?php $k=0; $b=0; foreach ($dataPekerjaan as $row): ?>
					<?php if ($dataPekerjaan[$k]['status']=='1') $b++ ?>
					<li class="list-group-item"><?= $dataPekerjaan[$k]['detailPekerjaan']." - ".(($dataPekerjaan[$k]['status']=='1')?"Sudah dikerjakan":"Belum dikerjakan"); ?>
						<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2): ?>
							<span class="btn-group float-right" role="group">
								<a class="btn btn-outline-warning" href="edit/<?= $dataPekerjaan[$k]['idPekerjaan'] ?>" role="button">Ubah</a>
								<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalHapus<?= $dataPekerjaan[$k]['idPekerjaan'] ?>">Hapus</button>
							</span>
						<?php endif ?>
					</li>
					<?= isset($modal)?$modal[$row['idPekerjaan']]:"" ?>
				<?php $k++; endforeach ?>
			</ul>
			<?php $bar = round($b/$k, 2)*100; ?>
			<h6>Progress:</h6>
			<div class="progress">
				<div class="progress-bar" style="width: <?=$bar?>%" role="progressbar" aria-valuenow="<?=$bar?>" aria-valuemin="0" aria-valuemax="100"><?=$bar?>%</div>
			</div>
		<?php else: ?>
			<h4 class="card-text">Proposal <?= $dataPekerjaan[0]['judulProposal'] ?> <strong style="color: red">belum memiliki daftar pekerjaan</strong></h4>
			<p class="card-text"><?= nl2br($dataPekerjaan[0]['deskripsiProposal'][0]) ?></p>
			<?php if (isset($dataPekerjaan[0]['deskripsiProposal'][1])): ?>
				<p class="card-text text-danger">Alasan penolakan: <strong><?= $dataPekerjaan[0]['deskripsiProposal'][1] ?></strong></p>
			<?php else: ?>
				<p class="card-text text-danger">Alasan penolakan tidak diberikan</p>
			<?php endif ?>
			<p class="card-subtitle text-muted">Tanggal mulai renovasi: <?= $dataPekerjaan[0]['dateCreated'] ?></p>
			<p class="card-subtitle text-muted">Tanggal selesai renovasi: <?= ($dataPekerjaan[0]['dateDeleted']!=NULL)?$dataPekerjaan[0]['dateDeleted']:' - ' ?></p>
		<?php endif ?>
		<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2): ?>
			<a class="btn btn-outline-success mt-3" href="baru" role="button">Tambah Pekerjaan</a>
			<!-- <a class="btn btn-outline-success mt-3" href="unggah" role="button">Unggah Pekerjaan</a> -->
			<span data-toggle="modal" data-target="#modalUnggah">
				<button type="button" class="btn btn-outline-success mt-3" data-toggle="tooltip" data-placement="right" title="Unggah list pekerjaan dalam bentuk excel">Unggah Pekerjaan</button>
			</span>
		<?php endif ?>
		<a class="btn btn-outline-secondary float-right mt-3" href="<?= $back ?>" role="button">Kembali</a>
	</div>
</div>
</main>
<?= isset($modalUnggah)?$modalUnggah:"" ?>
<?= $footer ?>

<script>
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
