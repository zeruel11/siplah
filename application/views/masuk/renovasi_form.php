<?php $this->output->enable_profiler(TRUE); ?>
<?php if ($mode=="insert") { ?>
<div class="container-fluid">
  <div class="row">
  <div class="col-lg-3"></div>
  <div class="col-lg-6">
<form name="input" method="post" action="<?php echo base_url('index.php/Beranda/tambahRenovasi'); ?>">
  <!-- <input type="hidden" value="<?php echo $idGedung; ?>" name="idGedung" /> -->
  <div class="form-group">
    <label for="judulProposalForm">Judul Ajuan Renovasi</label>
    <input type="text" class="form-control" id="judulProposalForm" name="judulProposalForm" placeholder="Masukkan judul renovasi"></input>
  </div>
  <div class="form-group">
    <label for="deskripsiProposalForm">Deskripsi Renovasi</label>
    <textarea class="form-control" id="deskripsiProposalForm" name="deskripsiProposalForm" rows="2" placeholder="Masukkan deskripsi singkat renovasi dan/atau pertimbangan dalam mengajukan renovasi"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
  </form>
</div>
<div class="col-lg-3"></div>
</div>
  </div>

<?php } elseif ($mode=="edit") { ?>
<?php var_dump($dataRenovasi) ?>
<div class="container-fluid">
  <div class="row">
  <div class="col-lg-3"></div>
  <div class="col-lg-6">
<form name="input" method="post" action="<?php echo base_url('index.php/Beranda/ubahRenovasi/').$dataRenovasi[0]['idProposal']; ?>">
<div class="form-group">
    <label for="judulProposalForm">Judul Ajuan Renovasi</label>
    <input type="text" class="form-control" id="judulProposalForm" name="judulProposalForm" value="<?php echo $dataRenovasi[0]['judulProposal'] ?>"></input>
  </div>
  <div class="form-group">
    <label for="deskripsiProposalForm">Deskripsi Renovasi</label>
    <textarea class="form-control" id="deskripsiProposalForm" name="deskripsiProposalForm" rows="2"><?php echo $dataRenovasi[0]['deskripsiProposal'] ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
  </form>
</div>
<div class="col-lg-3"></div>
</div>
  </div>

<?php } ?>
