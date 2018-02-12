<?php $this->output->enable_profiler(TRUE); ?>
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form class="needs-validation" id="input" name="input" method="post" action="<?= ($mode=="insert")?base_url('index.php/Beranda/tambahGedung'):base_url('index.php/Beranda/ubahGedung/').$dataGedung[0]['idGedung'] ?>" novalidate>
	<div class="form-group">
		<label for="namaGedungForm">Nama Gedung</label>
		<input type="text" class="form-control<?= (form_error('namaGedungForm'))?' is-invalid':(set_value('namaGedungForm')?' is-valid':'') ?>" id="namaGedungForm" name="namaGedungForm" placeholder="Masukkan judul renovasi" value="<?= ($mode=="insert")?"":(set_value('namaGedungForm')==NULL || set_value('namaGedungForm')=='')?$dataGedung[0]['namaGedung']:set_value('namaGedungForm') ?>"></input>
		<?= form_error('namaGedungForm') ?>
		<div class="valid-feedback">Nama gedung OK</div>
	</div>
	<div class="form-group">
		<label for="kodeGedungForm">Kode Gedung</label>
		<input type="text" class="form-control<?= (form_error('kodeGedungForm'))?' is-invalid':(set_value('kodeGedungForm')?' is-valid':'') ?>" id="kodeGedungForm" name="kodeGedungForm" placeholder="Masukkan judul renovasi" value="<?= ($mode=="insert")?"":(set_value('kodeGedungForm')==NULL || set_value('kodeGedungForm')=='')?$dataGedung[0]['kodeGedung']:set_value('kodeGedungForm') ?>"></input>
		<?= form_error('kodeGedungForm') ?>
		<div class="valid-feedback">Kode gedung OK</div>
	</div>
	<div class="form-group">
		<label for="luasGedungForm">Luas Bangunan</label>
		<input type="text" class="form-control<?= (form_error('luasGedungForm'))?' is-invalid':(set_value('luasGedungForm')?' is-valid':'') ?>" id="luasGedungForm" name="luasGedungForm" placeholder="Masukkan judul renovasi" value="<?= ($mode=="insert")?"":(set_value('luasGedungForm')==NULL || set_value('luasGedungForm')=='')?$dataGedung[0]['luasGedung']:set_value('luasGedungForm') ?>"></input>
		<?= form_error('luasGedungForm') ?>
		<div class="valid-feedback">Luas bangunan OK</div>
	</div>
	<div class="form-group">
		<label for="tinggiGedungForm">Tinggi Bangunan</label>
		<input type="text" class="form-control<?= (form_error('tinggiGedungForm'))?' is-invalid':(set_value('tinggiGedungForm')?' is-valid':'') ?>" id="tinggiGedungForm" name="tinggiGedungForm" placeholder="Masukkan judul renovasi" value="<?= ($mode=="insert")?"":(set_value('tinggiGedungForm')==NULL || set_value('tinggiGedungForm')=='')?$dataGedung[0]['tinggiGedung']:set_value('tinggiGedungForm') ?>"></input>
		<?= form_error('tinggiGedungForm') ?>
		<div class="valid-feedback">Tinggi bangunan OK</div>
	</div>
	<div class="form-group">
		<label for="jumlahLantaiForm">Jumlah Lantai</label>
		<input type="text" class="form-control<?= (form_error('jumlahLantaiForm'))?' is-invalid':(set_value('jumlahLantaiForm')?' is-valid':'') ?>" id="jumlahLantaiForm" name="jumlahLantaiForm" placeholder="Masukkan judul renovasi" value="<?= ($mode=="insert")?"":(set_value('jumlahLantaiForm')==NULL || set_value('jumlahLantaiForm')=='')?$dataGedung[0]['jumlahLantai']:set_value('jumlahLantaiForm') ?>"></input>
		<?= form_error('jumlahLantaiForm') ?>
		<div class="valid-feedback">Jumlah lantai OK</div>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	<a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
</form>
</div>
<div class="col-lg-3"></div>
</div>
</div>
<?= isset($footer)?$footer:NULL ?>
