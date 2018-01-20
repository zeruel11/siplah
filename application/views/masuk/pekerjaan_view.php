	<div class="card-body">
	<?php if ($dataPekerjaan[0]['idPekerjaan']!=null) {
		// var_dump($dataPekerjaan) ?>
			<h4 class="card-text">Renovasi: <?php echo $dataPekerjaan[0]['judulProposal']; ?></h4>
				<ul class="list-group">
					<?php $k=0; foreach ($dataPekerjaan as $row) { ?>
						<li class="list-group-item"><?php echo $dataPekerjaan[$k]['detailPekerjaan']; ?>
							<span class="btn-group float-right" role="group">
							<a class="btn btn-outline-warning" href="<?php echo base_url()."beranda/ubahPekerjaan/".$dataPekerjaan[$k]['idPekerjaan'] ?>" role="button">Ubah</a>
							<a class="btn btn-outline-danger" href="<?php echo base_url()."beranda/hapusPekerjaan/".$dataPekerjaan[$k]['idPekerjaan'] ?>" role="button">Hapus</a>
						</span>
						</li>
					<?php $k++;
					} ?>
				  <!-- <li class="list-group-item">Jumlah lantai: <?php echo $dataPekerjaan[0]['jumlahLantai']; ?></li> -->
				</ul>

	<?php } else { ?>
		<h4 class="card-text">Proposal <?php echo $dataPekerjaan[0]['judulProposal']; ?> belum memiliki daftar pekerjaan</h4>
	<?php }
	// var_dump($dataPekerjaan);
	// echo $this->output->enable_profiler(TRUE); ?>
	<a class="btn btn-outline-success mt-3" href="<?php echo base_url() ?>ajuan" role="button">Tambah Pekerjaan</a>
	</div>
</body>