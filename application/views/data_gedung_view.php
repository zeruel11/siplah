<body>
	<div class="card-body">
	<?php if ($detailGedung!=null) {
    // var_dump($detailGedung)?>
			<h4 class="card-title">Gedung <?php echo $detailGedung[0]['namaGedung'].(($detailGedung[0]['kategoriGedung']==1)?" - Gedung Pendidikan":""); ?></h4>
				<ul class="list-group">
					<li class="list-group-item">Kode gedung: <?php echo $detailGedung[0]['kodeGedung']; ?></li>
				  <li class="list-group-item">Luas bangunan: <?php echo $detailGedung[0]['luasGedung']; ?>m<sup>2</sup></li>
				  <li class="list-group-item">Tinggi gedung: <?php echo $detailGedung[0]['tinggiGedung']; ?>m</li>
					<li class="list-group-item">Jumlah lantai: <?php echo $detailGedung[0]['jumlahLantai']; ?></li>
				</ul>

	<?php
} else {
        ?>
		<h4 class="card-text">Gedung tidak ditemukan</h4>
	<?php
    } ?>
	</div>

</body>
