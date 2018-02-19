<div class="col-lg-5">
	<?php if (isset($message)): ?>
		<div class="alert alert-primary fade show animated fadeInUp w-60" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button>
				<?= $message ?>
		</div>
	<?php endif ?>
	<div class="card-body">
	<?php if ($detailGedung!=null): ?>
			<h4 class="card-title">Gedung <?= $detailGedung[0]['namaGedung'].(($detailGedung[0]['kategoriGedung']==1)?" - Gedung Pendidikan":"") ?></h4>
				<ul class="list-group">
					<li class="list-group-item">Kode gedung: <?= (($detailGedung[0]['kodeGedung']!=null)?$detailGedung[0]['kodeGedung']:"- tidak ada -") ?></li>
					<li class="list-group-item">Luas bangunan: <?= (($detailGedung[0]['luasGedung']!=null)?$detailGedung[0]['luasGedung']."m<sup>2</sup>":"-") ?></li>
					<li class="list-group-item">Tinggi gedung: <?= (($detailGedung[0]['tinggiGedung']!=null)?$detailGedung[0]['tinggiGedung']."m":"-") ?></li>
					<li class="list-group-item">Jumlah lantai: <?= $detailGedung[0]['jumlahLantai']; ?></li>
					<?php if ($renovasiLast!=NULL): ?>
						<li class="list-group-item">Renovasi terakhir: "<?= $renovasiLast[0]['judulProposal'] ?>" selesai pada tanggal: <?= $renovasiLast[0]['dateDeleted'] ?></li>
					<?php endif ?>
					<?php if ($renovasiNow!=NULL): ?>
						<li class="list-group-item">Renovasi sedang berjalan: <?= $renovasiNow[0]['judulProposal'] ?></li>
					<?php endif ?>
				</ul>
				<?php if (isset($userLogin)): ?>
					<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2): ?>
						<a class="btn btn-primary mt-2" href="<?= base_url('gedung/edit').$detailGedung[0]['idGedung'] ?>" role="button">Ubah Data Gedung</a>
					<?php endif ?>
					<a class="btn btn-info mt-2" href="<?= base_url('renovasi/').$detailGedung[0]['idGedung'] ?>" role="button">Data Renovasi<?= ($userLogin['userLevel']==1 || $userLogin['userLevel']==2)?" Lengkap":"" ?></a>
				<?php endif ?>
	<?php else: ?>
		<h4 class="card-text">Gedung tidak ditemukan</h4>
	<?php endif ?>
	</div>
</div>
<?= $footer ?>
<?php $this->output->enable_profiler(TRUE); ?>

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
