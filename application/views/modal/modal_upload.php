<!-- Modal Upload -->
<form lang="en" name="input" id="modalUnggah" enctype="multipart/form-data" class="modal animated fade" tabindex="-1" role="dialog" aria-labelledby="modalUpload" method="post" action="<?= base_url('excel/readExcel') ?>" novalidate>
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
					<input type="file" class="form-control custom-file-input" id="excelFileForm" name="excelFileForm" onchange="$(this).next().after().text($(this).val().split('\\').slice(-1)[0])">
					<span class="custom-file-control form-control-file"></span>
				</label>
			</div>
			<div class="modal-body text-info">
				<p>FIle excel harus memiliki kolom berjudul "deskripsi pekerjaan" atau hanya berisi 1 kolom berisi list pekerjaan tanpa judul</p>
			</div>
			<div class="modal-footer">
				<button type="submit" value="upload" class="btn btn-primary">Submit</button>
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</form>

<script src="<?= base_url('assets/js/additional-methods.min.js') ?>"></script>
<script type="text/javascript">
	$( document ).ready( function () {
			$( "#modalUnggah" ).validate( {
				rules: {
					excelFileForm: {
						required: true,
						extension: "xls|xlsx|csv"
					}
				},
				messages: {
					excelFileForm: {
						required: 'Anda perlu memilih file excel',
						extension: 'Harap upload file dengan format xls, xlsx, atau csv'
					}
				},
				errorElement: "div",
				errorPlacement: function ( error, element ) {
					// Add the `invalid-feedback` class to the error element
					error.addClass( "invalid-feedback" );
					error.insertAfter( element.parent( "label" ) );
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
				}
			} );
		});

	$('.custom-file-input').on('change',function(){
  	$(this).next('.form-control-file').addClass("selected");
	});
</script>
