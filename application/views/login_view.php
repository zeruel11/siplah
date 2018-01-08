<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login - SIPLAH</title>
</head>
<body>
	<!-- <h1>login here</h1> -->
	<section id="login">
		<div class="row">
			<div class="login-holder col-md-6 col-md-offset-3">
				<form method="POST" role="form" action="<?php echo base_url().'index.php/ver_login'; ?>" novalidate="novalidate">
					<div class="form-group">
						<input type="text" class="required form-control form-cascade-control input-small" id="username" name="username" placeholder="Username">
					</div>
					<div class="form-group">
						<input type="password" class="required form-control form-cascade-control input-small" id="password" name="password" placeholder="********">
					</div>
					<div class="form-footer">
						<button style="width: 200px;" type="submit" class="btn bg-primary text-white btn-lg">Login</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</body>
</html>