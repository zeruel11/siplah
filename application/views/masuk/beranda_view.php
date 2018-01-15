<body>

	<div class="container-fluid">
		<div class="row">
		<div class="col-lg-8"><div id="image-map"></div></div>
		<div class="col-lg-4">
			<?php $g=0;
			foreach ($listGedung as $row) {
				// echo "".$row['idGedung']."<br>";
				echo $row['namaGedung'];
				// echo "Luasan: ".$row['luasGedung']."<br>";
				// echo "Lantai: ".$row['jumlahLantai']."<br>";
				// echo "".$row['x']."<br>";
				// echo "".$row['y']."<br>";
				// echo "".$row['label']."<br>";
				// echo $row;?>
				<a href="<?php echo base_url()."gedung/".$listGedung[$g]['idGedung'];	$g++;?>"> Detail data gedung </a>
				<br>
				<?php }
				// var_dump($this->session->userdata('logged_in'))?>
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

<!-- <script>
    var map = L.map('map', {
        crs: L.CRS.Simple
        });

var bounds = [[500,0], [0,360]];
var image = L.imageOverlay('assets/img/allits.png', bounds).addTo(map);
map.fitBounds(bounds);

</script> -->
