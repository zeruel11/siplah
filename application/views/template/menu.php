<!-- <div class="col-lg-2 float-left col-1 pl-0 pr-2 collapse width show" id="sidebar">
	<div class="list-group border-0 card text-center text-md-left">
		<a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-dashboard"></i>
			<span class="d-none d-md-inline">Ajuan Renovasi</span></a>
</div>
</div>-->
<main class="container-fluid" style="margin-top: 20px">
		<div class="row flex">
			<nav class="col-lg-2 hidden-xs-down bg-faded sidebar">
					<ul class="nav nav-pills flex-column">
						<li class="nav-item">
							<a class="nav-link<?= (($this->uri->segment(1)=='beranda'||$this->uri->segment(1)=='')?" active":($this->uri->segment(1)=='gedung')?" active":"") ?>" href="<?= base_url() ?>"><?= (($this->uri->segment(1)=='gedung')?"Data Gedung":"Overview Gedung") ?><span class="sr-only">(current)</span></a>
						</li>
						<?php if ($userLogin['userLevel']==1 || $userLogin['userLevel']==2 || $userLogin['userLevel']==5): ?>
							<li class="nav-item">
								<a class="nav-link<?= (($this->uri->segment(1)=='renovasi')?(($this->uri->segment(2)=='pekerjaan')?"":" active"):"") ?>" href="<?= (($this->uri->uri_string()=="beranda" || $this->uri->uri_string()=="")?base_url('renovasi/ALL'):(($this->uri->segment(1)=='gedung')?"":($this->uri->segment(2)=='pekerjaan')?$this->session->userdata['refered_from_renovasi']['url']:"")) ?>"><?= (($this->uri->uri_string()=='' || $this->uri->uri_string()=='beranda' || $this->uri->segment(2)=='ALL')?"Semua Renovasi":"Renovasi") ?> <span class="badge badge-dark"><?= $jumlah ?></span></a>
							</li>
						<?php elseif ($userLogin['userLevel']==4): ?>
							<li class="nav-item">
								<a class="nav-link<?= (($this->uri->segment(1)=='renovasi')?(($this->uri->segment(2)=='pekerjaan')?"":" active"):"") ?>" href="<?= base_url('renovasi/available') ?>">Prioritas Renovasi <span class="badge badge-dark"><?= $jumlahTersedia ?></span></a>
							</li>
						<?php elseif ($userLogin['userLevel']==3): ?>
							<li class="nav-item">
								<a class="nav-link<?= (($this->uri->segment(1)=='renovasi' && $this->uri->segment(2)=='proposal')?" active":"") ?>" href="<?= base_url('renovasi/proposal') ?>">Data Renovasi Belum Disetujui <span class="badge badge-dark"><?= $jumlahBelum ?></span></a>
							</li>
							<li class="nav-item">
								<a class="nav-link mt-2<?= (($this->uri->segment(1)=='renovasi' && $this->uri->segment(2)=='kerja')?" active":"") ?>" href="<?= base_url('renovasi/kerja') ?>">Data Renovasi Telah Disetujui <span class="badge badge-dark"><?= $jumlahSetuju ?></span></a>
							</li>
						<?php endif ?>
					</ul>
					<!-- <ul class="nav nav-pills flex-column">
						<li class="nav-item">
							<a class="nav-link" href="#" style="">Nav point</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" style="">One more nav</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Another nav item</a>
						</li>
					</ul> -->
		</nav>
