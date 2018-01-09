<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Standard Meta -->
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- Site Properties -->
	<title>SIPLAH - Login</title>

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/grid.css">
</head>
<body>
	<div class="container vertical-center">
		<!-- <div class="card card-container"> -->
			<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url().'index.php/ver_login'; ?>">
				<div class="row">
					<!-- <div class="col-md-3"></div> -->
					<!-- <div class="col-lg-6"> -->
						<h2 class='login_title text-center'>Masukkan Login Anda</h2>
						<hr>
						<!-- </div> -->
					</div>
					<div class="row">
						<!-- <div class="col-md-3"></div> -->
						<!-- <div class="col-md-6"> -->
							<div class="form-group has-danger">
								<label class="sr-only" for="username">Username</label>
								<div class="input-group">
									<div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
									<input type="text" name="username" class="form-control" id="username" required autofocus oninvalid="this.setCustomValidity('Masukkan username')" oninput="setCustomValidity('')" />
								</div>
							</div>
							<!-- </div> -->
						</div>
			                <!-- <div class="col-md-3">
			                    <div class="form-control-feedback">
			                        <span class="text-danger align-middle">
			                            <i class="fa fa-close"></i> Example error message
			                        </span>
			                    </div>
			                </div> -->
			                <div class="row">
			                	<!-- <div class="col-md-3"></div> -->
			                	<!-- <div class="col-md-6"> -->
			                		<div class="form-group">
			                			<label class="sr-only" for="password">Password</label>
			                			<div class="input-group">
			                				<div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
			                				<input type="password" name="password" class="form-control" id="password" placeholder="********" required oninvalid="this.setCustomValidity('Masukkan password')" oninput="setCustomValidity('')" />
			                			</div>
			                		</div>
			                		<!-- </div> -->
			                	</div>
			                	<!-- <div class="col-md-3"> -->
			                		<div class="form-control-feedback">
			                			<span class="text-danger align-middle">
			                				<!-- Put password error message here -->
			                				<?php if ($validLogin) { ?>
			                				<i class="fa fa-close"></i> Username atau password Anda salah, harap coba kembali
			                				<?php } ?>
			                			</span>
			                		</div>
			            <!-- <div class="row">
			                <div class="col-md-3"></div>
			                <div class="col-md-6" style="padding-top: .35rem">
			                    <div class="form-check mb-2 mr-sm-2 mb-sm-0">
			                        <label class="form-check-label">
			                            <input class="form-check-input" name="remember"
			                                   type="checkbox" >
			                            <span style="padding-bottom: .15rem">Remember me</span>
			                        </label>
			                    </div>
			                </div>
			            </div> -->
			            <div class="row">
			                <!-- <div class="col-md-3"></div>
			                	<div class="col-md-6"> -->
			                		<button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Login</button>
			                		<!-- <a class="btn btn-link" href="/password/reset">Forgot Your Password?</a> -->
			                	</div>
			                </form>
			                <!-- </div> -->
			            </div>
			        </body>
			        </html>
