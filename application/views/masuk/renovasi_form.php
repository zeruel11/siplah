<?php $this->output->enable_profiler(TRUE); ?>
<?php if ($mode=="insert") { ?>
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form class="needs-validation" id="input" name="input" method="post" action="<?php echo base_url('index.php/Beranda/tambahRenovasi'); ?>" novalidate>
	<!-- <input type="hidden" value="<?php echo $idGedung; ?>" name="idGedung" /> -->
	<div class="form-group">
		<label for="judulProposalForm">Judul Ajuan Renovasi</label>
		<input type="text" class="form-control<?= (form_error('judulProposalForm'))?' is-invalid':(set_value('judulProposalForm')?' is-valid':'') ?>" id="judulProposalForm" name="judulProposalForm" placeholder="Masukkan judul renovasi" value="<?= set_value('judulProposalForm') ?>"></input>
		<?= form_error('judulProposalForm') ?>
		<div class="valid-feedback">Judul OK</div>
	</div>
	<div class="form-group">
		<label for="deskripsiProposalForm">Deskripsi Renovasi</label>
		<textarea form="input" class="form-control<?= (form_error('deskripsiProposalForm'))?' is-invalid':(set_value('deskripsiProposalForm')?' is-valid':'') ?>" id="deskripsiProposalForm" name="deskripsiProposalForm" rows="2" placeholder="Masukkan deskripsi singkat renovasi dan/atau pertimbangan dalam mengajukan renovasi"><?= set_value('deskripsiProposalForm') ?></textarea>
		<?= form_error('deskripsiProposalForm') ?>
		<div class="valid-feedback">Deskripsi renovasi OK</div>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	<a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
	</form>
</div>
<div class="col-lg-3"></div>
</div>
	</div>

<?php } elseif ($mode=="edit") { ?>
<?php var_dump($dataRenovasi) ?>
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form class="needs-validation" name="input" method="post" action="<?php echo base_url('index.php/Beranda/ubahRenovasi/').$dataRenovasi[0]['idProposal']; ?>" novalidate>
<div class="form-group">
		<label for="judulProposalForm">Judul Ajuan Renovasi</label>
		<input type="text" class="form-control <?= (form_error('judulProposalForm'))?' is-invalid':(set_value('judulProposalForm')?' is-valid':'') ?>" id="judulProposalForm" name="judulProposalForm" value="<?php if (set_value('judulProposalForm')==NULL) {
			echo $dataRenovasi[0]['judulProposal'];
		} else {
			echo set_value('judulProposalForm');
		} ?>"></input>
		<?= form_error('judulProposalForm') ?>
		<div class="valid-feedback">Judul OK</div>
	</div>
	<div class="form-group">
		<label for="deskripsiProposalForm">Deskripsi Renovasi</label>
		<textarea class="form-control <?= (form_error('deskripsiProposalForm'))?' is-invalid':(set_value('deskripsiProposalForm')?' is-valid':'') ?>" id="deskripsiProposalForm" name="deskripsiProposalForm" rows="2"><?php if (set_value('deskripsiProposalForm')==NULL) {
			echo $dataRenovasi[0]['deskripsiProposal'];
		} else {
			echo set_value('deskripsiProposalForm');
		} ?></textarea>
		<?= form_error('deskripsiProposalForm') ?>
		<div class="valid-feedback">Deskripsi OK</div>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	<a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
	</form>
</div>
<div class="col-lg-3"></div>
</div>
	</div>

<?php } ?>
