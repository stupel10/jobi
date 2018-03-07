<?php include_once "_partials/header.php" ?>


<div class="page-header">
	<h1>JOBI COMPANY HOME</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<a href="index.php" class="btn btn-primary pull-right">USER</a>
	</div>
</div>

<div class="row">
	<form action="_inc/registration.php" class="col-sm-6" method="post" id="reg-company">
		<h2>COMPANY REGISTER</h2>
		<p class="form-group">
			<input type="text" name="name" id="company_reg_name" class="form-control" placeholder = "COMPANY NAME" >
			<input type="password" name="pass" id="company_reg_pass" class="form-control" placeholder = "COMPANY PASSWORD" >
			<input type="hidden" value="company" name="reg_type">
		</p>
		<p class="form-group">
			<input type="submit" value="REGISTER" class="btn btn-small btn-danger">
		</p>
	</form>
</div>
<div class="row">
	<form action="company-homepage.php" class="col-sm-6" method="post" id="login-company">
		<h2>COMPANY LOGIN</h2>
		<p class="form-group">
			<input type="text" name="name" id="company_login_name" class="form-control" placeholder = "COMPANY NAME" >
			<input type="password" name="pass" id="company_login_pass" class="form-control" placeholder = "COMPANY PASSWORD" >
		</p>
		<p class="form-group">
			<input type="submit" value="LOG IN" class="btn btn-small btn-primary">
		</p>
	</form>
</div>

<?php include_once "_partials/footer.php" ?>

