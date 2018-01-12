<body>
	<div class="card-body">
	<?php if ($detailGedung!='null') {
		// var_dump($test) ?>
			<h4 class="card-text">Gedung <?php echo $detailGedung['namaGedung']; ?></h4>
				<ul class="list-group">
				  <li class="list-group-item">Luas bangunan: <?php echo $detailGedung['luasGedung']; ?>m<sup>2</sup></li>
				  <li class="list-group-item">Jumlah lantai: <?php echo $detailGedung['jumlahLantai']; ?></li>
				</ul>

	<?php } else { ?>
		<h4 class="card-text">Gedung tidak ditemukan</h4>
	<?php } ?>
	</div>

</body>
