<div class="col-lg-10">
	<h4 class="card-title">Renovasi: <?php echo $dataPekerjaan[0]['judulProposal']; ?></h4>
	<p class="card-text"><?php echo $dataPekerjaan[0]['deskripsiProposal']; ?></p>
	<!-- <div class="card-block"> -->
		<!-- <ul class="list-group list-group-flush"> -->
		<form name="input" method="post" action="<?php echo base_url('Beranda/selesaiPekerjaan'); ?>">
			<?php $k=0; foreach ($dataPekerjaan as $row) { ?>
			<li class="list-group-item">
				<label class="form-check custom-control custom-checkbox">
					<input class="form-check-input custom-control-input" type="checkbox" value="<?= $row['idPekerjaan']?>" id="pekerjaanCheck[]" name="pekerjaanCheck[]"<?php echo ($row['status']==0?"":" disabled")?>>
					<span class="custom-control-indicator"></span>
					<span class="form-check-label custom-control-description" for="pekerjaanCheck">
						<?php echo ($row['status']==1)?$row['detailPekerjaan']." - pekerjaan sudah selesai":$row['detailPekerjaan']; ?>
					</span>
				</label>
			</li>
			<!-- <label class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input">
	<span class="custom-control-indicator"></span>
	<span class="custom-control-description">Check this custom checkbox</span>
</label> -->
			<?php $k++;
			// var_dump($dataPekerjaan);
		} ?>
		<!-- </ul> -->
	<!-- </div> -->
	<button type="submit" class="btn btn-success mt-2">Cek Pekerjaan Selesai</button>
</form>
</div>
</div>
