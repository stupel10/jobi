<?php include_once "_partials/header.php" ?>


	<div class="page-header">
		<h1>JOBI HOME</h1>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<a href="index-company.php" class="btn btn-danger pull-right">COMPANY</a>
		</div>
	</div>

	<div class="row">
		<form action="_inc/registration.php" class="col-sm-6" method="post" id="reg-user">
			<h2>USER REGISTER</h2>
			<p class="form-group">
				<input type="text" name="name" id="user_reg_name" class="form-control" placeholder = "USER NAME" >
				<input type="password" name="pass" id="user_reg_pass" class="form-control" placeholder = "USER PASSWORD" >
				<input type="hidden" value="user" name="reg_type">
			</p>
			<p class="form-group">
				<input type="submit" value="REGISTER" class="btn btn-small btn-danger">
			</p>
		</form>
	</div>
	<div class="row">
		<form action="user-homepage.php" class="col-sm-6" method="post" id="login-user">
			<h2>USER LOGIN</h2>
			<p class="form-group">
				<input type="text" name="name" id="user_login_name" class="form-control" placeholder = "USER NAME" >
				<input type="password" name="pass" id="user_login_pass" class="form-control" placeholder = "USER PASSWORD" >
			</p>
			<p class="form-group">
				<input type="submit" value="LOG IN" class="btn btn-small btn-primary">
			</p>
		</form>
	</div>

<?php include_once "_partials/footer.php" ?>

