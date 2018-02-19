<?php $this->output->enable_profiler(TRUE); ?>
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-5"><div id="image-map"></div></div>
	<div class="col-lg-6">
<form class="needs-validation" id="input" name="input" method="post" action="<?= ($mode=="insert")?base_url('beranda/tambahGedung'):base_url('beranda/ubahGedung/').$dataGedung[0]['idGedung'] ?>" novalidate>
	<div class="form-group">
		<label for="namaGedungForm">Nama Gedung</label>
		<input type="text" class="form-control<?= (form_error('namaGedungForm'))?' is-invalid':(set_value('namaGedungForm')?' is-valid':'') ?>" id="namaGedungForm" name="namaGedungForm" placeholder="Masukkan nama gedung" value="<?= ($mode=="insert")?"":(set_value('namaGedungForm')==NULL || set_value('namaGedungForm')=='')?$dataGedung[0]['namaGedung']:set_value('namaGedungForm') ?>"></input>
		<?= form_error('namaGedungForm') ?>
		<div class="valid-feedback">Nama gedung OK</div>
	</div>
	<div class="row">
		<div class="col-lg-8">
	<div class="form-group">
		<label for="kodeGedungForm">Kode Gedung</label>
		<input type="text" class="form-control<?= (form_error('kodeGedungForm'))?' is-invalid':(set_value('kodeGedungForm')?' is-valid':'') ?>" id="kodeGedungForm" name="kodeGedungForm" placeholder="Masukkan kode gedung (bila ada)" value="<?= ($mode=="insert")?"":(set_value('kodeGedungForm')==NULL || set_value('kodeGedungForm')=='')?$dataGedung[0]['kodeGedung']:set_value('kodeGedungForm') ?>"></input>
		<?= form_error('kodeGedungForm') ?>
		<div class="valid-feedback">Kode gedung OK</div>
	</div>
	</div>
	<div class="col-lg-4">
		<div class="form-check vertical-center ml-3">
			<label class="form-check-label" for="kategoriCheck">Gedung pendidikan</label>
  		<input class="form-check-input" type="checkbox" value="1" id="kategoriCheck" name="kategoriCheck"<?= (isset($dataGedung) && $dataGedung[0]['kategoriGedung']=='1')?' checked':'' ?>>
		</div>
	</div>
	</div>
	<div class="form-group">
		<label for="luasGedungForm">Luas Bangunan</label>
		<input type="numeric" class="form-control<?= (form_error('luasGedungForm'))?' is-invalid':(set_value('luasGedungForm')?' is-valid':'') ?>" id="luasGedungForm" name="luasGedungForm" placeholder="Masukkan luas bangunan" value="<?= ($mode=="insert")?"":(set_value('luasGedungForm')==NULL || set_value('luasGedungForm')=='')?$dataGedung[0]['luasGedung']:set_value('luasGedungForm') ?>"></input>
		<?= form_error('luasGedungForm') ?>
		<div class="valid-feedback">Luas bangunan OK</div>
	</div>
	<div class="form-group">
		<label for="tinggiGedungForm">Tinggi Bangunan</label>
		<input type="numeric" class="form-control<?= (form_error('tinggiGedungForm'))?' is-invalid':(set_value('tinggiGedungForm')?' is-valid':'') ?>" id="tinggiGedungForm" name="tinggiGedungForm" placeholder="Masukkan tinggi bangunan" value="<?= ($mode=="insert")?"":(set_value('tinggiGedungForm')==NULL || set_value('tinggiGedungForm')=='')?$dataGedung[0]['tinggiGedung']:set_value('tinggiGedungForm') ?>"></input>
		<?= form_error('tinggiGedungForm') ?>
		<div class="valid-feedback">Tinggi bangunan OK</div>
	</div>
	<div class="form-group">
		<label for="jumlahLantaiForm">Jumlah Lantai</label>
		<input type="numeric" class="form-control<?= (form_error('jumlahLantaiForm'))?' is-invalid':(set_value('jumlahLantaiForm')?' is-valid':'') ?>" id="jumlahLantaiForm" name="jumlahLantaiForm" placeholder="Masukkan jumlah lantai gedung" value="<?= ($mode=="insert")?"":(set_value('jumlahLantaiForm')==NULL || set_value('jumlahLantaiForm')=='')?$dataGedung[0]['jumlahLantai']:set_value('jumlahLantaiForm') ?>"></input>
		<?= form_error('jumlahLantaiForm') ?>
		<div class="valid-feedback">Jumlah lantai OK</div>
	</div>
	<div class="form-group">
		<label for="koordinatForm">Lokasi Gedung</label>
		<input type="text" class="form-control<?= (form_error('koordinatForm'))?' is-invalid':(set_value('koordinatForm')?' is-valid':'') ?>" id="koordinatForm" name="koordinatForm" aria-describedby="lokasiHelp" value="<?= ($mode=="insert")?"":(set_value('koordinatForm')==NULL || set_value('koordinatForm')=='')?$dataGedung[0]['x'].' , '.$dataGedung[0]['y']:set_value('koordinatForm') ?>" readonly></input>
		<small id="lokasiHelp" class="form-text text-muted">Untuk <?= ($mode=='edit')?"mengubah":"menambah" ?> lokasi gedung lakukan klik pada peta.</small>
		<?= form_error('koordinatForm') ?>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	<button type="reset" id="reset" class="btn btn-secondary" value="Reset">Reset</button>
	<a class="btn btn-dark float-right" href="<?= ($mode=='insert')?base_url():$cancel ?>" role="button">Cancel</a>
</form>
</div>
</div>
</div>
<?= isset($footer)?$footer:NULL ?>

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

	var currentMarker;

  function onMapClick(e) {
  	var mapWidth=map._container.offsetWidth;
    var mapHeight=map._container.offsetHeight;
    console.log(e.latlng.lat);
    console.log(e.latlng.lng);
    console.log(e);
    $("#koordinatForm").val(e.latlng.lat+" , "+e.latlng.lng);

    if (currentMarker) {
        currentMarker._icon.style.transition = "transform 0.3s ease-out";
        // currentMarker._shadow.style.transition = "transform 0.3s ease-out";

    	currentMarker.setLatLng(e.latlng);
    	currentMarker.setOpacity(100);

        setTimeout(function () {
            currentMarker._icon.style.transition = null;
            // currentMarker._shadow.style.transition = null;
        }, 300);
        return;
    }
    currentMarker = L.marker(e.latlng, {
    	draggable: true,
    	icon: L.icon.glyph({
    		prefix: 'fa',
    		glyph: 'check',
    		glyphColor: 'red',
    		glyphSize: '9px'
    	}),
    	title: 'lokasi baru'
    }).addTo(map).on("click", function () {
    	e.originalEvent.stopPropagation();
    });

    currentMarker.on("move", function (event) {
    	$("#koordinatForm").val(event.latlng.lat+" , "+event.latlng.lng);
    });
  };

  $('#reset').on("click", function () {
  	currentMarker.setOpacity(0);
  });
  map.on('click', onMapClick);

<?php if ($mode=='edit'): ?>
	<?php $l = 0; foreach ( $dataGedung as $lokasi ) {
		if ($lokasi['x']!=NULL) { ?>
      var sol = L.latLng([ <?php echo $lokasi['x'] ?>, <?php echo $lokasi['y'] ?>]);
      L.marker(sol, {icon: L.icon.glyph({
      	prefix: 'mki',
      	glyph: '<?php echo $lokasi['tipeGedung'] ?>',
      	glyphSize: '18px'
      }), title: 'lokasi lama'}).addTo(map).bindPopup("<b><?= $lokasi['namaGedung'] ?><?php if(isset($lokasi['kodeGedung'])){echo " (".$lokasi['kodeGedung'].")";} ?></b><br><b>Luas Gedung: <?php echo ($lokasi['luasGedung']==0)?"N/A":$lokasi['luasGedung']."m<sup>2</sup>" ?></b>");
    <?php }
  $l++; } ?>
<?php endif ?>
</script>
