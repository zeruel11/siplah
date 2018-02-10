<?= isset($error)?var_dump($error):'' ?>
<?php $this->output->enable_profiler(TRUE); ?>
<div class="container-fluid">
	<div class="row mt-3">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form lang="en" name="input" enctype="multipart/form-data" method="post" action="<?= base_url('excel/readExcel') ?>">
	<!-- <div class="form-group">
		<input type="file" class="form-control-file" id="excelFileForm" name="excelFileForm">
  	<label for="excelFileForm">Pilih file</label> -->
		<!-- <?= form_error('detailPekerjaanForm') ?> -->
	<!-- </div> -->
	<div class="form-group">
	<label class="custom-file" id="customFile">
        <input type="file" class="custom-file-input" id="excelFileForm" name="excelFileForm" aria-describedby="fileHelp" onchange="$(this).next().after().text($(this).val().split('\\').slice(-1)[0])">
        <span class="custom-file-control form-control-file"></span>
	</label>
	</div>
	<!-- <label class="custom-file d-block">
            <input data-toggle="custom-file" data-target="#company-logo" type="file" name="company_logo" accept="image/png" class="custom-file-input">
            <span id="company-logo" class="custom-file-control custom-file-name" data-content="Upload company logo..."></span>
          </label> -->
	<button type="submit" value="upload" class="btn btn-primary">Submit</button>
	<!-- <a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a> -->
	</form>
</div>
<div class="col-lg-3"></div>
</div>
	</div>

</div>

<!-- Modal Upload -->
	<!-- <form name="modalPassword" id="modalPassword" method="post" class="modal animated fade" tabindex="-1" role="dialog" aria-labelledby="modalImportant" action="<?= base_url('beranda/unggahPekerjaan').$userLogin['uid'] ?>">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalImportant">Ganti password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Masukkan password lama anda: <input type="password" id="sandiLewat" name="sandiLewat" placeholder="******" required oninvalid="this.setCustomValidity('Masukkan password lama')" oninput="setCustomValidity('')"></input>
			</div>
			<div class="modal-body">
				Masukkan password baru anda: <input type="password" id="sandiLewatBaru" name="sandiLewatBaru" placeholder="******" required oninvalid="this.setCustomValidity('Masukkan password baru')" oninput="setCustomValidity('')"></input>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">OK</button>
			</div>
		</div>
	</div>
</form> -->

<script type="text/javascript">
	// var fileName = document.getElementById("upload-image-input").files[0].name;

	$('.custom-file-input').on('change',function(){
  $(this).next('.form-control-file').addClass("selected");
})
	// .html($(this).val())
</script>
