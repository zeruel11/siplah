<body>

	<div class="container-fluid">
		<div class="row">
		<div class="col-lg-8"><div id="image-map"></div></div>
		<div class="col-lg-4">
			<div class="card">
			<ul class="list-group list-group-flush">
			<?php $g=0;
			foreach ($listGedung as $row) { ?>
				<a href="<?php echo base_url()."gedung/".$listGedung[$g]['idGedung'];	$g++;?>" class="list-group-item list-group-item-action"><?php echo $row['namaGedung']; ?></a>
				<!-- class="btn btn-outline-info btn-sm float-right" -->
				<?php 
				// echo "Luasan: ".$row['luasGedung']."<br>";
				// echo "Lantai: ".$row['jumlahLantai']."<br>";
				// echo "".$row['x']."<br>";
				// echo "".$row['y']."<br>";
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
			var map = L.map('image-map', {
				minZoom: 1,
				maxZoom: 5,
				center: [0, 0],
				zoom: 1,
				crs: L.CRS.Simple,
				attributionControl:false
			});
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
</script>

</body>
