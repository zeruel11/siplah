<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
	<!-- <h1>SIPLAH login</h1> -->
	<h2>Anda masuk sebagai: <?php echo $userAuth." ".$namaLengkap; ?></h2>

	<!-- <img src="<?php echo base_url(); ?>assets/img/allits.png"> -->
	<p><a href="<?php echo base_url(); ?>index.php/beranda/keluar">Logout</a></p>

	<div id="image-map"></div>

	<script src="assets/js/leaflet.js"></script>

	<script>
    var map = L.map('image-map', {
      minZoom: 1,
      maxZoom: 4,
      center: [0, 0],
      zoom: 1,
      crs: L.CRS.Simple
    });
    // dimensions of the image
    var w = 2500,
        h = 3500,
        url = 'assets/img/allits.png';
    // calculate the edges of the image, in coordinate space
    var southWest = map.unproject([0, h], map.getMaxZoom()-1);
    var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
    var bounds = new L.LatLngBounds(southWest, northEast);
    // add the image overlay, 
    // so that it covers the entire map
    L.imageOverlay(url, bounds).addTo(map);
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