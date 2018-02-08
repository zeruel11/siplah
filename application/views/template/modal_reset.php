<!-- Modal Reset -->
						<div class="modal fade" id="modalReset<?= $idModal ?>" tabindex="-1" role="dialog" aria-labelledby="modalResetTitle" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalResetTitle">Perhatian!</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										Apakah anda yakin ingin melakukan reset password user?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										<a class="btn btn-warning" href="<?= base_url('manage/resetPassword/').$idModal ?>" role="button">Reset Password</a>
									</div>
								</div>
							</div>
						</div>
