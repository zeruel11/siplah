<body>

	<div class="wrapper">
		<div class="peta" id="image-map"></div>
		<div class="list">
			<?php for ($g=0; $g < count($listGedung); $g++) {
				echo $listGedung[$g]['namaGedung'];	?>
				<a href="<?php echo "beranda/".$listGedung[$g]['idGedung'];?>"> Ubah data gedung </a>
				<br>
				<?php
			} ?>

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
    // add the image overlay,
    // so that it covers the entire map
    var image = L.imageOverlay(url, bounds).addTo(map);
    // tell leaflet that the map is exactly as big as the image
    map.fitBounds(bounds);
</script>

</body>
