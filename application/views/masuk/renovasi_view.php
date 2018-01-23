	<div class="card-body">
		<?php if ($dataRenovasi[0]['idProposal']!=null) {
    // var_dump($dataRenovasi)?>
		<h3 class="card-title">Gedung <?php echo $dataRenovasi[0]['namaGedung']; ?></h3>
		<!-- <ul class="list-group"> -->
			<?php $r=0;
    foreach ($dataRenovasi as $row) {
        ?>
			<div class="card mt-1">
				<div class="card-block w-50">
				<h5 class="card-title"><?php echo $dataRenovasi[$r]['judulProposal']; ?></h5>

					<?php if ($dataRenovasi[$r]['deskripsiProposal']!=null) {
            echo '<p class="card-subtitle text-muted text-truncate">'.$dataRenovasi[$r]['deskripsiProposal'];
        } else {
            echo '<p class="card-subtitle text-danger">'."-proposal tidak memiliki deskripsi-";
        } ?>
				</p>
				</div>
				<div class="card-block text-right">
					<div class="btn-group float-right" role="group">
						<a class="btn btn-outline-info" href="<?php echo base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
						<a class="btn btn-outline-warning" href="<?php echo base_url()."renovasi/ed/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Ubah Data Renovasi</a>
						<a class="btn btn-outline-danger" href="<?php echo base_url('renovasi/del/').$dataRenovasi[$r]['idProposal'] ?>" role="button">Hapus Data Renovasi</a>
					</div>
				</div>
				<!-- <div class="progress">
					<div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
				</div> -->
			</div>
			<?php $r++;
    } ?>
		<!-- <li class="list-group-item">Jumlah lantai: <?php echo $dataRenovasi[0]['jumlahLantai']; ?></li> -->
	<!-- </ul> -->

	<?php
} else {
        ?>
	<h4 class="card-text">Gedung <?php echo $dataRenovasi[0]['namaGedung']; ?> belum memiliki data renovasi</h4>
	<?php
    }
    // var_dump($hasil);
    // echo $this->output->enable_profiler(TRUE);?>
	<a class="btn btn-outline-success mt-3" href="<?php echo base_url('ajuan'); ?>" role="button">Tambah Renovasi Baru</a>
</div>
</div>
</div>
</body>
