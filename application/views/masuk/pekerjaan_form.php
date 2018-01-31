<?php if ($mode=="insert") { ?>
<div class="container-fluid">
  <div class="row">
  <div class="col-lg-3"></div>
  <div class="col-lg-6">
<form name="input" method="post" action="<?php echo base_url('index.php/Beranda/tambahPekerjaan'); ?>">
  <!-- <input type="hidden" value="<?php echo $idProposal; ?>" name="idProposal" /> -->
<!-- <div class="form-group">
    <label for="judulProposal">Proposal</label>
    <input type="text" class="form-control disabled" id="judulProposal" placeholder="" disabled />
  </div> -->
  <div class="form-group">
    <label for="detailPekerjaanForm">Detail Pekerjaan</label>
    <textarea class="form-control" id="detailPekerjaanForm" name="detailPekerjaanForm" rows="2" placeholder="Masukkan pekerjaan yang harus dilakukan"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
  </form>
</div>
<div class="col-lg-3"></div>
</div>
  </div>

<?php } elseif ($mode=="edit") { ?>

<div class="container-fluid">
  <div class="row">
  <div class="col-lg-3"></div>
  <div class="col-lg-6">
<form name="input" method="post" action="<?php echo base_url('index.php/Beranda/ubahPekerjaan').'/'.$dataPekerjaan[0]['idPekerjaan']; ?>">
  <!-- <div class="form-group">
  <label for="judulProposal"></label>
    <p class="form-control-static" id="judulProposal">#<?php echo $dataPekerjaan[0]['idPekerjaan']; ?></p>
</div> -->
<div class="form-group">
    <label for="judulProposal">Proposal</label>
    <input type="text" class="form-control disabled" id="judulProposal" value="<?php echo $dataPekerjaan[0]['judulProposal']; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="detailPekerjaanForm">Detail Pekerjaan</label>
    <textarea class="form-control" id="detailPekerjaanForm" name="detailPekerjaanForm" rows="2"><?php echo $dataPekerjaan[0]['detailPekerjaan']; ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a class="btn btn-secondary float-right" href="<?= $cancel ?>" role="button">Cancel</a>
  </form>
</div>
<div class="col-lg-3"></div>
</div>
  </div>

<?php } ?>
