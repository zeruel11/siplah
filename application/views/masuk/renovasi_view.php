	<div class="card-body">
		<?php if ($dataRenovasi[0]['idProposal']!=null) {
		// var_dump($dataRenovasi) ?>
		<h4 class="card-text">Gedung <?php echo $dataRenovasi[0]['namaGedung']; ?></h4>
		<ul class="list-group">
			<?php $r=0; foreach ($dataRenovasi as $row) { ?>
			<li class="list-group-item">
				<?php echo $dataRenovasi[$r]['judulProposal']; ?>
				<span class="btn-group float-right ml-3" role="group">
					<a class="btn btn-outline-info" href="<?php echo base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
					<a class="btn btn-outline-warning" href="<?php echo base_url()."renovasi/ed/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Ubah Data Renovasi</a>
					<a class="btn btn-outline-danger" href="<?php echo base_url('renovasi/del/').$dataRenovasi[$r]['idProposal'] ?>" role="button">Hapus Data Renovasi</a>
				</span>
				<!-- <div class="progress">
					<div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
				</div> -->
			</li>
			<?php $r++;
		} ?>
		<!-- <li class="list-group-item">Jumlah lantai: <?php echo $dataRenovasi[0]['jumlahLantai']; ?></li> -->
	</ul>

	<?php } else { ?>
	<h4 class="card-text">Gedung <?php echo $dataRenovasi[0]['namaGedung']; ?> belum memiliki data renovasi</h4>
	<?php }
	// var_dump($hasil);
	// echo $this->output->enable_profiler(TRUE); ?>
	<a class="btn btn-outline-success mt-3" href="<?php echo base_url('ajuan'); ?>" role="button">Tambah Renovasi Baru</a>
</div>
</body>
