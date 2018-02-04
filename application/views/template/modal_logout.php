<!-- Modal -->
	<div class="modal animated bounceIn fade" id="modalNoLogin" tabindex="-1" role="dialog" aria-labelledby="modalWarning" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<h5 class="modal-title" id="modalImportant">Anda belum melakukan login!<button type="button" class="btn btn-primary float-right" data-dismiss="modal">OK</button></h5>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

		$(window).on('load', function() {
			$('#modalNoLogin').modal({
				show: true,
				focus: true
			});
		});

		$('#modalNoLogin').on('hide.bs.modal', function () {
			$('.modal .modal-dialog').attr('class', 'modal-dialog zoomOut animated');
		});

	</script>
