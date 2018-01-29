	<div class="card-body col-lg-10 pt-1">
		<?php $this->output->enable_profiler(TRUE); ?>
		<?php if ($dataRenovasi[0]['idProposal']!=null) { ?>
		<!-- <ul class="list-group"> -->
			<?php $r=0;
    foreach ($dataRenovasi as $row) { ?>
			<?php if ($r==0) {
				echo '<h3 class="card-title mt-3">Gedung '.$row['namaGedung'] .'</h3>';
			} elseif ($dataRenovasi[$r]['namaGedung']!=$dataRenovasi[$r-1]['namaGedung']) {
				echo '<h3 class="card-title mt-3">Gedung '.$row['namaGedung'] .'</h3>';
			} ?>
			<div class="card mt-2">
				<div class="row no-gutters">
				<div class="card-block col-lg-6 w-50">
				<h5 class="card-title"><?php echo $row['judulProposal']; ?></h5>
				<!-- .$dataRenovasi[$r]['status'] -->

					<?php if ($row['dateDeleted']!=NULL) {
            echo '<p class="card-subtitle text-success"> -Renovasi telah selesai- </p>';
        } elseif ($row['deskripsiProposal']!=NULL) {
        	echo '<p class="card-subtitle text-muted text-truncate">'.$row['deskripsiProposal'].'</p>';
        } else {
        	echo '<p class="card-subtitle text-danger"> -proposal tidak memiliki deskripsi- </p>';
        } ?>
				</p>
				</div>
				<div class="card-block col-lg-6 p-1 w-50 text-right">
					<p class="card-subtitle">Tanggal Mulai Renovasi: <?= $row['dateCreated']?></p>
					<p class="card-subtitle">Tanggal Selesai Renovasi: <?= ($row['dateDeleted']!=NULL)?$dataRenovasi[$r]['dateDeleted']:"-"?></p>
				</div>
				</div>
				<div class="row no-gutters pl-1">
					<div class="card-block col-lg-6 pr-3">
					<div class="progress">
						<div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="card-block col-lg-6 text-right">
				<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2) {
            ?>
						<div class="btn-group float-right" role="group">
							<a class="btn btn-outline-info" href="<?php echo base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
							<a class="btn btn-outline-success" href="<?php echo base_url('renovasi/selesai/').$dataRenovasi[$r]['idProposal'] ?>" role="button">Renovasi Selesai</a>
							<a class="btn btn-outline-warning" href="<?php echo base_url()."renovasi/ed/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Ubah Data Renovasi</a>
							<a class="btn btn-outline-danger" href="<?php echo base_url('renovasi/del/').$dataRenovasi[$r]['idProposal'] ?>" role="button">Hapus Data Renovasi</a>
						</div>
				<?php
			} elseif ($userLogin['userLevel']==3) { ?>
					<a class="btn btn-outline-info small-btn mr-3" href="<?php echo base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
				<?php if ($dataRenovasi[$r]['status']!=2 && $dataRenovasi[$r]['status']!=3){ ?>
						<div class="btn-group float-right" role="group">
					<a class="btn btn-outline-success mini-btn" href="<?php echo base_url()."renovasi/setuju/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Setujui renovasi</a>
					<a class="btn btn-outline-danger mini-btn" href="<?php echo base_url()."renovasi/tolak/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Tolak renovasi</a>
				</div>
			<?php }
		 } else {
            ?>
					<a class="btn btn-outline-info small-btn" href="<?php echo base_url()."renovasi/pekerjaan/".$dataRenovasi[$r]['idProposal'] ?>" role="button">Info Renovasi & Pekerjaan</a>
				<?php
        } ?>
			</div>
		</div>
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
		<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2 || $userLogin['userLevel']==5) { ?>
			<a class="btn btn-outline-success mt-3" href="<?php echo base_url('ajuan'); ?>" role="button">Tambah Renovasi Baru</a>
		<?php } ?>
</div>
<?php // echo $this->output->enable_profiler(TRUE); ?>
</div>
</main>
