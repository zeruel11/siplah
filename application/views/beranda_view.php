<body>
<?php $this->output->enable_profiler(TRUE); ?>
<!-- <?= var_dump($listGedung) ?> -->
<?= isset($modal)?$modal:'' ?>
	<div class="container-fluid mt-2">
		<div class="row">
			<div class="col-lg-8">
				<div id="image-map" class="sidebar-map"></div></div>
			<div class="col-lg-4">
				<?php if (isset($invalid)): ?>
				<div class="alert alert-primary fade show animated fadeInDown" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
					</button><?= $invalid ?></div>
				<?php endif ?>
				<div class="card">
					<ul class="list-group list-group-flush">
						<?php $g=0;
						foreach ($listGedung as $row) { ?>
						<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGedung<?= $row['idGedung'] ?>"><?php echo $row['namaGedung']; ?></button>
						<?= isset($modalGedung)?$modalGedung[$row['idGedung']]:'' ?>
						<!-- class="btn btn-outline-info btn-sm float-right" -->
						<?php	} ?>
				</ul>
			</div>
		</div>
	</div>
</div>




<?= isset($footer)?$footer:'' ?>

<script>
$(window).on('load', function(event) {
	setTimeout(function () {
		$(".alert").alert('close')
	}, 3500);
})

$(function () {
		$('body').on('close.bs.alert', function(e){
				e.preventDefault();
				e.stopPropagation();
				$(e.target).slideUp();
		});
});
</script>

<!-- <script>
        var marker = L.marker([51.2, 7]).addTo(map);
        var sidebar = L.control.sidebar('sidebar').addTo(map);
    </script> -->

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
		position:'topright'
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
      L.marker(sol, {icon: L.icon.glyph({
      	prefix: 'mki',
      	glyph: '<?php echo $lokasi['tipeGedung'] ?>',
      	glyphSize: '18px'
      })}).addTo(map).bindPopup('<b><?= $lokasi['namaGedung'] ?><?php if(isset($lokasi['kodeGedung'])){echo " (".$lokasi['kodeGedung'].")";} ?></b><br><b>Luas Gedung: <?php echo ($lokasi['luasGedung']==0)?"N/A":$lokasi['luasGedung']."m<sup>2</sup>" ?></b><br><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalGedung<?= $lokasi['idGedung'] ?>">Data Lengkap</button>');
    <?php }
  $l++; } ?>
</script>

</body>
