<!-- Modal Data Gedung -->
				<div class="modal fade" id="modalGedung<?= $idModal ?>" tabindex="-1" role="dialog" aria-labelledby="modalGedungTitle" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalGedungTitle">Data Gedung <?= $dataLuar[0]['namaGedung'].(($dataLuar[0]['kategoriGedung']==1)?" - Gedung Pendidikan":"") ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Kode gedung: <?= (($dataLuar[0]['kodeGedung']!=null)?$dataLuar[0]['kodeGedung']:"- tidak ada -") ?>
							</div>
							<div class="modal-body">
								Luas bangunan: <?= (($dataLuar[0]['luasGedung']!=null)?$dataLuar[0]['luasGedung']."m<sup>2</sup>":"-") ?>
							</div>
							<div class="modal-body">
								Tinggi gedung: <?= (($dataLuar[0]['tinggiGedung']!=null)?$dataLuar[0]['tinggiGedung']."m":"-") ?>
							</div>
							<div class="modal-body">
								Jumlah lantai: <?= $dataLuar[0]['jumlahLantai']; ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</div>
				</div>
