<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8"><div id="image-map"></div></div>
			<!-- <div class="col-lg-3"></div> -->
			<div class="col-lg-4">
				<?php if (isset($message)) {
			    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
			  	'.$message.'
					</div>';
			} ?>
				<div class="card">
					<ul class="list-group list-group-flush">
						<?php $g=0;
						foreach ($listGedung as $row) { ?>
						<a href="<?php echo base_url()."gedung/".$row['idGedung'];	$g++;?>" class="list-group-item list-group-item-action" target="_blank"><?php echo $row['namaGedung']; ?></a>
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
<?php // $l = 1;
// foreach ( $listGedung as $lokasi ) {
//     	echo ($lokasi['x']).($lokasi['y']);
    	// $l++; } ?>
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

            function onMapClick(e) {

                var mapWidth=map._container.offsetWidth;
                var mapHeight=map._container.offsetHeight;
                console.log(e.latlng.lat);
                console.log(e.latlng.lng);
                console.log(e);
            }
            map.on('contextmenu', onMapClick);

            <?php $l = 0; foreach ( $listGedung as $lokasi ) {
							if ($lokasi['x']!=NULL) { ?>

             var sol = L.latLng([ <?php echo $lokasi['x'] ?>, <?php echo $lokasi['y'] ?>]);
             L.marker(sol, {icon: gedungIcon}).addTo(map).bindPopup("<b><?= $lokasi['namaGedung'] ?><?php if(isset($lokasi['kodeGedung'])){echo " (".$lokasi['kodeGedung'].")";} ?></b><br><b>Luas Gedung: <?= $lokasi['luasGedung'] ?>m<sup>2</sup></b><br><a href=gedung/<?= $lokasi['idGedung'] ?> target=_blank>Data Lengkap</a>");

             <?php }
						 $l++; } ?>

         </script>

     </body>
