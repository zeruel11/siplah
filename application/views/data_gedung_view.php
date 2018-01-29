<body>
	<div class="card-body" style="margin-top: 51px">
	<?php if ($detailGedung!=null) {
    // var_dump($detailGedung)?>
			<h4 class="card-title">Gedung <?php echo $detailGedung[0]['namaGedung'].(($detailGedung[0]['kategoriGedung']==1)?" - Gedung Pendidikan":""); ?></h4>
				<ul class="list-group">
					<li class="list-group-item">Kode gedung: <?php echo (($detailGedung[0]['kodeGedung']!=null)?$detailGedung[0]['kodeGedung']:"- tidak ada -"); ?></li>
				  <li class="list-group-item">Luas bangunan: <?php echo (($detailGedung[0]['luasGedung']!=null)?$detailGedung[0]['luasGedung']."m<sup>2</sup>":"-"); ?></li>
				  <li class="list-group-item">Tinggi gedung: <?php echo (($detailGedung[0]['tinggiGedung']!=null)?$detailGedung[0]['tinggiGedung']."m":"-"); ?></li>
					<li class="list-group-item">Jumlah lantai: <?php echo $detailGedung[0]['jumlahLantai']; ?></li>
				</ul>
				<?php if (isset($userLogin)) {
        ?>
					<a class="btn btn-primary mt-2" href="<?php echo base_url()."renovasi/".$detailGedung[0]['idGedung']; ?>" role="button">Data Renovasi</a>
				<?php
    }
		// var_dump($detailGedung);
} else {
    ?>
		<h4 class="card-text">Gedung tidak ditemukan</h4>
	<?php
} ?>
	</div>

</body>
