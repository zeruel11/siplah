<?= // isset($error)?var_dump($error):'' ?>
<?php // $this->output->enable_profiler(TRUE); ?>
<!-- <div class="container-fluid">
	<div class="row mt-3">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form lang="en" name="input" enctype="multipart/form-data" method="post" action="<?= base_url('excel/readExcel') ?>">
	<div class="form-group">
	<label class="custom-file" id="customFile">
        <input type="file" class="custom-file-input" id="excelFileForm" name="excelFileForm" aria-describedby="fileHelp" onchange="$(this).next().after().text($(this).val().split('\\').slice(-1)[0])">
        <span class="custom-file-control form-control-file"></span>
	</label>
	</div>
	<button type="submit" value="upload" class="btn btn-primary">Submit</button>
	<a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
	</form>
</div>
<div class="col-lg-3"></div>
</div>
	</div>
</div> -->

<!-- Modal Upload -->
<form lang="en" name="input" id="modalUnggah" enctype="multipart/form-data" class="modal animated fade" tabindex="-1" role="dialog" aria-labelledby="modalUpload" method="post" action="<?= base_url('excel/readExcel') ?>">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalUpload">Unggah list pekerjaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label class="custom-file col-lg-6" id="customFile">
					<input type="file" class="custom-file-input" id="excelFileForm" name="excelFileForm" aria-describedby="fileHelp" onchange="$(this).next().after().text($(this).val().split('\\').slice(-1)[0])">
					<span class="custom-file-control form-control-file"></span>
				</label>
			</div>
			<div class="modal-footer">
				<button type="submit" value="upload" class="btn btn-primary">Submit</button>
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$('.custom-file-input').on('change',function(){
  $(this).next('.form-control-file').addClass("selected");
})
</script>
