<!-- Modal -->
				<div class="modal fade" id="modalHapus<?= $idModal ?>" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalDeleteTitle">Perhatian!</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Apakah anda yakin ingin menghapus <?= ($this->uri->segment(2)=="pekerjaan")?"pekerjaan":"renovasi" ?>?<br>
								<strong>Data akan dihapus secara permanen!!</strong>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a class="btn btn-danger" href="<?= (($this->uri->segment(2)=="pekerjaan")?base_url('beranda/hapusPekerjaan/'):base_url('renovasi/del/')).$idModal ?>" role="button">Hapus</a>
							</div>
						</div>
					</div>
				</div>
