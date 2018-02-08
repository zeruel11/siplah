<?php $this->output->enable_profiler(TRUE); ?>
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form class="needs-validation" id="input" name="input" method="post" action="<?= ($mode=="insert")?base_url('index.php/Beranda/tambahRenovasi'):base_url('index.php/Beranda/ubahRenovasi/').$dataRenovasi[0]['idProposal'] ?>" novalidate>
	<div class="form-group">
		<label for="judulProposalForm">Judul Ajuan Renovasi</label>
		<input type="text" class="form-control<?= (form_error('judulProposalForm'))?' is-invalid':(set_value('judulProposalForm')?' is-valid':'') ?>" id="judulProposalForm" name="judulProposalForm" placeholder="Masukkan judul renovasi" value="<?= ($mode=="insert")?"":(set_value('judulProposalForm')==NULL || set_value('judulProposalForm')=='')?$dataRenovasi[0]['judulProposal']:set_value('judulProposalForm') ?>"></input>
		<?= form_error('judulProposalForm') ?>
		<div class="valid-feedback">Judul OK</div>
	</div>
	<div class="form-group">
		<label for="deskripsiProposalForm">Deskripsi Renovasi</label>
		<textarea form="input" class="form-control<?= (form_error('deskripsiProposalForm'))?' is-invalid':(set_value('deskripsiProposalForm')?' is-valid':'') ?>" id="deskripsiProposalForm" name="deskripsiProposalForm" rows="2" placeholder="Masukkan deskripsi singkat renovasi dan/atau pertimbangan dalam mengajukan renovasi"><?= ($mode=="insert")?"":((set_value('deskripsiProposalForm')==NULL)?$dataRenovasi[0]['deskripsiProposal']:set_value('deskripsiProposalForm')) ?></textarea>
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
