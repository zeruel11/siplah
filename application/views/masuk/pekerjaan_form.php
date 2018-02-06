
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form name="input" method="post" action="<?= (($mode=="insert")?base_url('index.php/Beranda/tambahPekerjaan'):base_url('index.php/Beranda/ubahPekerjaan').'/'.$dataPekerjaan[0]['idPekerjaan']) ?>">
	<!-- <input type="hidden" value="<?php echo $idProposal; ?>" name="idProposal" /> -->
	<?php if ($mode=="edit"): ?>
		<div class="form-group">
		<label for="judulProposal">Proposal</label>
		<input type="text" class="form-control disabled" id="judulProposal" value="<?= $dataPekerjaan[0]['judulProposal'] ?>" disabled>
		</div>
	<?php endif ?>
	<div class="form-group">
		<label for="detailPekerjaanForm">Detail Pekerjaan</label>
		<textarea class="form-control<?= (form_error('detailPekerjaanForm'))?' is-invalid':''?>" id="detailPekerjaanForm" name="detailPekerjaanForm" rows="2" placeholder="Masukkan pekerjaan yang harus dilakukan"><?= ($mode=="insert")?"":(set_value('detailPekerjaanForm')==NULL)?$dataPekerjaan[0]['detailPekerjaan']:set_value('detailPekerjaanForm') ?></textarea>
		<?= form_error('detailPekerjaanForm') ?>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	<a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
	</form>
</div>
<div class="col-lg-3"></div>
</div>
	</div>

