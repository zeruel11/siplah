<!-- Modal Tolak -->
<form lang="en" name="input" id="modalTolak<?= $idModal ?>" class="modal animated fade" tabindex="-1" role="dialog" aria-labelledby="modalTolak" method="post" action="<?= base_url('renovasi/tolak/').$idModal ?>">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTolak">Tolak renovasi?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			Anda dapat menyertakan alasan mengapa renovasi ditolak: <input type="text" id="alasanForm" name="alasanForm" placeholder="Alasan penolakan"></input>
			</div>
			<div class="modal-footer">
				<button type="submit" value="upload" class="btn btn-danger">Tolak</button>
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</form>
