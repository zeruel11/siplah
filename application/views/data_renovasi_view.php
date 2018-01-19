
	<div class="card-body">
	<?php if ($dataRenovasi!=null) {
		// var_dump($dataRenovasi) ?>
			<h4 class="card-text">Gedung <?php echo $dataRenovasi[0]['namaGedung']; ?></h4>
				<ul class="list-group">
					<?php $r=0; foreach ($dataRenovasi as $row) { ?>
						<li class="list-group-item">Renovasi: <?php echo $dataRenovasi[$r]['judulProposal']; ?></li>
					<?php $r++;
					} ?>
				  <!-- <li class="list-group-item">Jumlah lantai: <?php echo $dataRenovasi[0]['jumlahLantai']; ?></li> -->
				</ul>

	<?php } else { ?>
		<h4 class="card-text">Gedung <?php echo $dataRenovasi[0]['namaGedung']; ?> belum memiliki data renovasi</h4>
	<?php } ?>
	</div>

</body>
