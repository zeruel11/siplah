<!-- Modal Setuju -->
<form lang="en" name="input" id="modalSetuju<?= $idModal ?>" class="modal animated fade" tabindex="-1" role="dialog" aria-labelledby="modalSetuju" method="post" action="<?= base_url('renovasi/setuju/').$idModal ?>">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalSetuju">Lakukan persetujuan renovasi?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			Masukkan alokasi dana: Rp<input type="number" id="danaForm" name="danaForm" placeholder="1000000" required oninvalid="this.setCustomValidity('Anda perlu memasukkan alokasi dana untuk menyetujui proposal renovasi')" oninput="setCustomValidity('')"></input>
			</div>
			<div class="modal-footer">
				<button type="submit" value="upload" class="btn btn-success">Setuju</button>
				<button type="button" class="btn btn-secondary" id="cancelModal" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</form>
