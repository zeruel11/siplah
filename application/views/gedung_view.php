<div class="col-lg-5">
	<div class="card-body">
	<?php if ($detailGedung!=null): ?>
			<h4 class="card-title">Gedung <?= $detailGedung[0]['namaGedung'].(($detailGedung[0]['kategoriGedung']==1)?" - Gedung Pendidikan":"") ?></h4>
				<ul class="list-group">
					<li class="list-group-item">Kode gedung: <?= (($detailGedung[0]['kodeGedung']!=null)?$detailGedung[0]['kodeGedung']:"- tidak ada -") ?></li>
					<li class="list-group-item">Luas bangunan: <?= (($detailGedung[0]['luasGedung']!=null)?$detailGedung[0]['luasGedung']."m<sup>2</sup>":"-") ?></li>
					<li class="list-group-item">Tinggi gedung: <?= (($detailGedung[0]['tinggiGedung']!=null)?$detailGedung[0]['tinggiGedung']."m":"-") ?></li>
					<li class="list-group-item">Jumlah lantai: <?= $detailGedung[0]['jumlahLantai']; ?></li>
				</ul>
				<?php if (isset($userLogin)): ?>
					<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2): ?>
						<a class="btn btn-primary mt-2" href="<?= base_url('gedung/edit').$detailGedung[0]['idGedung'] ?>" role="button">Ubah Data Gedung</a>
					<?php endif ?>
					<a class="btn btn-info mt-2" href="<?= base_url('renovasi/').$detailGedung[0]['idGedung'] ?>" role="button">Data Renovasi</a>
				<?php endif ?>
	<?php else: ?>
		<h4 class="card-text">Gedung tidak ditemukan</h4>
	<?php endif ?>
	</div>
</div>
<?= $footer ?>
