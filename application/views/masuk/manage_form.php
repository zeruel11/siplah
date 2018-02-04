<?php if ($mode=="insert") { ?>
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
<form name="input" method="post" action="<?php echo base_url('index.php/Manage/createUser'); ?>">
	<!-- <input type="hidden" value="<?php echo $idProposal; ?>" name="idProposal" /> -->
<!-- <div class="form-group">
		<label for="judulProposal">Proposal</label>
		<input type="text" class="form-control disabled" id="judulProposal" placeholder="" disabled />
	</div> -->
	<div class="form-group">
		<label for="usernameForm">Username:</label>
		<input type="text" class="form-control" id="usernameForm" name="usernameForm" placeholder="Username"></input>
	</div>
	<div class="form-group">
		<label for="passwordForm">Password:</label>
		<input type="password" class="form-control" id="passwordForm" name="passwordForm" placeholder="Password"></input>
	</div>
	<div class="form-group">
		<label for="namaLengkapForm">Nama Lengkap:</label>
		<input type="text" class="form-control" id="namaLengkapForm" name="namaLengkapForm" placeholder="Nama Lengkap"></input>
	</div>
	<div class="form-group">
		<label for="user_levelForm">User Level:</label>
		<select class="form-control" id="user_levelForm" name="user_levelForm">
      <option value="1">Admin</option>
      <option value="2">Pegawai SIMRI</option>
      <option value="3">WR II</option>
      <option value="4">SARPRAS</option>
      <option value="5">Unit Fakultas/Jurusan</option>
    </select>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
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
<form name="input" method="post" action="<?php echo base_url('index.php/Manage/updateUser/').$all_user[0]['uid'] ?>">
	<div class="form-group">
		<label for="userID">ID:</label>
		<input type="text" class="form-control" id="userID" name="userID" value="<?php echo $all_user[0]['uid'] ?>" disabled></input>
	</div>
	<div class="form-group">
		<label for="usernameForm">Username:</label>
		<input type="text" class="form-control" id="usernameForm" name="usernameForm" value="<?php echo $all_user[0]['username'] ?>"></input>
	</div>
	<!-- <div class="form-group">
		<label for="passwordForm">Password:</label>
		<input type="text" class="form-control" id="passwordForm" name="passwordForm" value="Password"></input>
	</div> -->
	<div class="form-group">
		<label for="namaLengkapForm">Nama Lengkap:</label>
		<input type="text" class="form-control" id="namaLengkapForm" name="namaLengkapForm" value="<?php echo $all_user[0]['namaLengkap'] ?>"></input>
	</div>
	<div class="form-group">
		<label for="user_levelForm">User Level:</label>
		<input type="text" class="form-control" id="user_levelForm" name="user_levelForm" value="<?php echo $all_user[0]['user_level'] ?>"></input>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
<div class="col-lg-3"></div>
</div>
	</div>

<?php } ?>
