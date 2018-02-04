<div class="modal animated bounceIn fade" id="modalPopup" tabindex="-1" role="dialog" aria-labelledby="modalImportant" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalImportant">Perhatian!</h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> -->
			</div>
			<div class="modal-body">
				Password Anda baru saja direset, harap segera melakukan <a href="">penggantian password</a>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">Cancel</button>
				<button type="button" id="passwordPopup" class="btn btn-primary">OK</button>
			</div>
		</div>
	</div>
</div>

<form name="modalPassword" method="post" action="<?php echo base_url('index.php/Ver_login/changepwd/').'$userLogin'; ?>" class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="modalImportant" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalImportant">Perhatian!</h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> -->
			</div>
			<div class="modal-body">
				Masukkan password anda: <input type="password" name="sandiLewat" placeholder="******"></input>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
$('#modalPopup').on('hide.bs.modal', function () {
	$('.modal .modal-dialog').attr('class', 'modal-dialog zoomOut animated');
});

// $('#myModal').on('shown.bs.modal', function () {
// 	$('#myInput').focus()
// })
</script>
