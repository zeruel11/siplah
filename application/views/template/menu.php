<<<<<<< Updated upstream
<!-- <div class="col-lg-2 float-left col-1 pl-0 pr-2 collapse width show" id="sidebar">
	<div class="list-group border-0 card text-center text-md-left">
		<a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-dashboard"></i>
			<span class="d-none d-md-inline">Ajuan Renovasi</span></a>
</div>
</div>-->
<body>
<div class="container-fluid">
		<div class="row flex">
			<div class="col-lg-2 hidden-xs-down bg-faded">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <?php echo '<a class="nav-link'.(($this->uri->segment(1)=='beranda')?" active":"").'" href="'.base_url().'">Data Seluruh Gedung<span class="sr-only">(current)</span></a>'; ?>
            </li>
            <li class="nav-item">
              <?php // echo '<a class="nav-link'.(($this->uri->segment(1)=='renovasi')?" active":"").'" href="'.base_url().'renovasi/ALL">Data Renovasi</a>' ?>
							<?php echo '<a class="nav-link'.(($this->uri->segment(1)=='renovasi')?" active":"").'" href="'.(($this->uri->segment(1)!='renovasi')?base_url()."renovasi/ALL":"").'">Data Renovasi</a>' ?>
            </li>
            </li>
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
        </div>
=======
<!-- <div class="col-lg-2 float-left col-1 pl-0 pr-2 collapse width show" id="sidebar">
	<div class="list-group border-0 card text-center text-md-left">
		<a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-dashboard"></i>
			<span class="d-none d-md-inline">Ajuan Renovasi</span></a>
</div>
</div>-->
<body>
<div class="container-fluid">
		<div class="row flex">
			<div class="col-lg-2 hidden-xs-down bg-faded">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="<?php echo base_url(); ?>">Data Seluruh Gedung<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()."renovasi/ALL" ?>">Data Renovasi</a>
            </li>
            </li>
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
        </div>
>>>>>>> Stashed changes
