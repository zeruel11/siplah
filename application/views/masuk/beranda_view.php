<?php $this->output->enable_profiler(TRUE); ?>
<?= isset($modal)?$modal:'' ?>
<div class="col-lg-6 col-lg-offset-2 mb-5">
	<!-- <a href="#" data-target="#sidebar" data-toggle="collapse"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a> -->
	<div id="image-map"></div>
	<p class="blockquote text-success"><?php echo "-- Total luas gedung terbangun: ".$luasTotal[0]->luas." m<sup>2</sup> --"; ?></p>
</div>
<div class="col-lg-4">
	<?php if (isset($invalid)) {
		echo '<div class="alert alert-primary fade show animated fadeInDown" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
		</button>'.$invalid.'</div>';
} ?>
	<div class="card">
		<ul class="list-group list-group-flush">
			<?php $g=0; foreach ($listGedung as $row) { ?>
			<li class="list-group-item list-group-item-action">
				<a class="card-link" href="<?php echo base_url()."gedung/".$row['idGedung']; ?>">
					<?php echo $row['namaGedung']; ?>
				</a>
				<a class="btn btn-outline-primary btn-sm float-right" href="<?php echo base_url('renovasi/').$row['idGedung'] ?>">Renovasi</a>
			</li>
			<?php $g++; } ?>
		</ul>
	</div>
</div>
</div>
</div>

<?= $footer ?>

<script>
	var gedungIcon = L.icon({
		iconUrl: '<?php echo base_url(); ?>assets/img/gedung.png',
		// shadowUrl: '',

		iconSize: [30, 30],
		// shadowSize: "value",
		iconAnchor: [15, 15],
		// shadowAnchor: "value",
		popupAnchor: [-1, -1]
	});
	var map = L.map('image-map', {
		minZoom: 1,
		maxZoom: 5,
		center: [0, 0],
		zoom: 1,
		crs: L.CRS.Simple,
		zoomControl: false,
		attributionControl: false
	});
	L.control.zoom({
		position: 'bottomleft'
	}).addTo(map);
	// dimensions of the image
	var w = 2500,
		h = 3500,
		url = '<?php echo base_url(); ?>assets/img/allits.png';
	// calculate the edges of the image, in coordinate space
	var southWest = map.unproject([0, h], map.getMaxZoom() - 1);
	var northEast = map.unproject([w, 0], map.getMaxZoom() - 1);
	var bounds = new L.LatLngBounds(southWest, northEast);
	// add the image overlay, so that it covers the entire map
	var image = L.imageOverlay(url, bounds).addTo(map);
	// tell leaflet that the map is exactly as big as the image
	map.fitBounds(bounds);

	<?php $l = 0; foreach ( $listGedung as $lokasi ) {
		if ($lokasi['x']!=NULL) { ?>

	 var sol = L.latLng([ <?php echo $lokasi['x'] ?>, <?php echo $lokasi['y'] ?>]);
	 L.marker(sol, {icon: gedungIcon}).addTo(map).bindPopup("<b><?= $lokasi['namaGedung'] ?><?php if(isset($lokasi['kodeGedung'])){echo " (".$lokasi['kodeGedung'].")";} ?></b><br><b>Luas Gedung: <?= $lokasi['luasGedung'] ?>m<sup>2</sup></b><br><a href=gedung/<?= $lokasi['idGedung'] ?> target=_blank>Data Lengkap</a>");

	 <?php }
	 $l++; } ?>
</script>

</body>
