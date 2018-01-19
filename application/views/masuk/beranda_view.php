<<<<<<< Updated upstream

		<div class="col-lg-6">
			<!-- <a href="#" data-target="#sidebar" data-toggle="collapse"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a> -->
			<div id="image-map"></div>
		</div>
		<div class="col-lg-4">
			<div class="card">
				<ul class="list-group list-group-flush">
					<?php $g=0;
					foreach ($listGedung as $row) { ?>
					<li class="list-group-item list-group-item-action">
						<a class="card-link" href="<?php echo base_url()."gedung/".$row['idGedung'];	$g++;?>">
							<?php echo $row['namaGedung']; ?>
						</a>
						<a class="btn btn-outline-info btn-sm float-right" href="<?php echo base_url()."renovasi/".$row['idGedung'] ?>">Renovasi</a>
					</li>
					<?php
			// echo "Luasan: ".$row['luasGedung']."<br>";
			// echo "Lantai: ".$row['jumlahLantai']."<br>";
			// echo $row['x'].$row['y'];
			// echo "".$row['label']."<br>";
			// echo $row;
				}
				// var_dump($listGedung)?>
			</ul>
		</div>
	</div>
	</div>
</div>
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
		attributionControl:false
	});
	L.control.zoom({
		position:'bottomleft'
	}).addTo(map);
	// dimensions of the image
	var w = 2500,
	h = 3500,
	url = '<?php echo base_url(); ?>assets/img/allits.png';
	// calculate the edges of the image, in coordinate space
	var southWest = map.unproject([0, h], map.getMaxZoom()-1);
	var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
	var bounds = new L.LatLngBounds(southWest, northEast);
	// add the image overlay, so that it covers the entire map
	var image = L.imageOverlay(url, bounds).addTo(map);
	// tell leaflet that the map is exactly as big as the image
	map.fitBounds(bounds);

	<?php $l = 1; foreach ( $listGedung as $lokasi ) { ?>
		var sol = L.latLng([ <?php echo $lokasi['x'] ?>, <?php echo $lokasi['y'] ?>]);
		L.marker(sol, {icon: gedungIcon}).addTo(map).bindPopup("<?php echo $lokasi['namaGedung'] ?>");

		<?php $l++; } ?>

	</script>

</body>

<!-- <script>
    var map = L.map('map', {
        crs: L.CRS.Simple
        });

var bounds = [[500,0], [0,360]];
var image = L.imageOverlay('assets/img/allits.png', bounds).addTo(map);
map.fitBounds(bounds);

</script> -->
=======
	
		<div class="col-lg-7">
			<!-- <a href="#" data-target="#sidebar" data-toggle="collapse"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a> -->
			<div id="image-map"></div>
		</div>
		<div class="col-lg-3">
			<div class="card">
				<ul class="list-group list-group-flush">
					<?php $g=0;
					foreach ($listGedung as $row) { ?>
					<a href="<?php echo base_url()."gedung/".$row['idGedung'];	$g++;?>" class="list-group-item list-group-item-action"><?php echo $row['namaGedung']; ?></a>
					<!-- class="btn btn-outline-info btn-sm float-right" -->
					<?php
			// echo "Luasan: ".$row['luasGedung']."<br>";
			// echo "Lantai: ".$row['jumlahLantai']."<br>";
			// echo $row['x'].$row['y'];
			// echo "".$row['label']."<br>";
			// echo $row;
				}
				// var_dump($listGedung)?>
			</ul>
		</div>
	</div>
	</div>
</div>
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
		attributionControl:false
	});
	L.control.zoom({
		position:'bottomleft'
	}).addTo(map);
	// dimensions of the image
	var w = 2500,
	h = 3500,
	url = '<?php echo base_url(); ?>assets/img/allits.png';
	// calculate the edges of the image, in coordinate space
	var southWest = map.unproject([0, h], map.getMaxZoom()-1);
	var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
	var bounds = new L.LatLngBounds(southWest, northEast);
	// add the image overlay, so that it covers the entire map
	var image = L.imageOverlay(url, bounds).addTo(map);
	// tell leaflet that the map is exactly as big as the image
	map.fitBounds(bounds);

	<?php $l = 1; foreach ( $listGedung as $lokasi ) { ?>
		var sol = L.latLng([ <?php echo $lokasi['x'] ?>, <?php echo $lokasi['y'] ?>]);
		L.marker(sol, {icon: gedungIcon}).addTo(map).bindPopup("<?php echo $lokasi['namaGedung'] ?>");

		<?php $l++; } ?>

	</script>

</body>

<!-- <script>
    var map = L.map('map', {
        crs: L.CRS.Simple
        });

var bounds = [[500,0], [0,360]];
var image = L.imageOverlay('assets/img/allits.png', bounds).addTo(map);
map.fitBounds(bounds);

</script> -->
>>>>>>> Stashed changes
