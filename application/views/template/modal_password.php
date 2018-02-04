<div class="modal animated bounceIn fade" id="modalReminder" tabindex="-1" role="dialog" aria-labelledby="modalImportant" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalImportant">Perhatian!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Password Anda baru saja direset, harap segera melakukan <a href="">penggantian password</a>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">Cancel</button>
				<button type="button" id="passwordPopup" class="btn btn-primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(window).on('load', function(){
		$('#modalReminder').modal({
			show: true,
			focus: true,
			keyboard: false
		})
	});
	$('#modalReminder').on('hide.bs.modal', function () {
		$('.modal .modal-dialog').attr('class', 'modal-dialog zoomOut animated');
	});
</script>
