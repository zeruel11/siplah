<div class="container-fluid">
	<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form name="input" method="post" action="<?= base_url('gantipassword').$userLogin['uid'] ?>">
		<div class="form-group">
		<label for="sandiLewat">Password Lama</label>
		<input type="password" class="form-control<?= (form_error('sandiLewat'))?' is-invalid':(set_value('sandiLewat')?' is-valid':'')?>" id="sandiLewat" name="sandiLewat" placeholder="******"></input>
		<?= form_error('sandiLewat') ?>
	</div>
	<div class="form-group">
		<label for="sandiLewatBaru">Password Baru</label>
		<input type="password" class="form-control<?= (form_error('sandiLewatBaru'))?' is-invalid':(set_value('sandiLewatBaru')?' is-valid':'')?>" id="sandiLewatBaru" name="sandiLewatBaru" placeholder="******"></input>
		<?= form_error('sandiLewatBaru') ?>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	<a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
	</form>
</div>
<div class="col-lg-3"></div>
</div>
	</div>
