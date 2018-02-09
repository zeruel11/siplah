<div class="col-lg-10">
	<h4 class="card-title">Renovasi: <?= $dataPekerjaan[0]['judulProposal']; ?></h4>
	<p class="card-text"><?= $dataPekerjaan[0]['deskripsiProposal']; ?></p>
	<!-- <div class="card-block"> -->
		<!-- <ul class="list-group list-group-flush"> -->
		<form name="input" method="post" action="<?= base_url('Beranda/selesaiPekerjaan'); ?>">
			<?php $k=0; foreach ($dataPekerjaan as $row): ?>
			<li class="list-group-item">
				<label class="form-check custom-control custom-checkbox">
					<input class="form-check-input custom-control-input" type="checkbox" value="<?= $row['idPekerjaan']?>" id="pekerjaanCheck[]" name="pekerjaanCheck[]"<?= ($row['status']==0?"":" disabled")?>>
					<span class="custom-control-indicator"></span>
					<span class="form-check-label custom-control-description" for="pekerjaanCheck">
						<?= ($row['status']==1)?$row['detailPekerjaan']." - pekerjaan sudah selesai":$row['detailPekerjaan']; ?>
					</span>
				</label>
			</li>
			<!-- <label class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input">
	<span class="custom-control-indicator"></span>
	<span class="custom-control-description">Check this custom checkbox</span>
</label> -->
			<?php $k++; endforeach ?>
		<!-- </ul> -->
	<!-- </div> -->
	<button type="submit" class="btn btn-success mt-2">Cek Pekerjaan Selesai</button>
	<a type="button" class="btn btn-secondary float-right mt-2" href="<?= $back ?>">Kembali</a>
</form>
</div>
</main>
<?= (isset($footer))?$footer:'' ?>
