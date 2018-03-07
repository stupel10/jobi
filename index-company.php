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
	<form action="_inc/company/registration.php" class="col-sm-6" method="post" id="reg-company">
		<h2>COMPANY REGISTER</h2>
		<p class="form-group">
			<input type="email" name="email" class="form-control" placeholder = "EMAIL" >
			<input type="password" name="password" class="form-control" placeholder = "PASSWORD" >
			<!--<input type="hidden" value="company" name="reg_type">-->
		</p>
		<p class="form-group">
			<input type="submit" value="REGISTER" class="btn btn-small btn-danger">
		</p>
	</form>
</div>
<div class="row">
	<form action="_inc/company/login.php" class="col-sm-6" method="post" id="login-company">
		<h2>COMPANY LOGIN</h2>
		<p class="form-group">
			<input type="email" name="email" class="form-control" placeholder = "COMPANY EMAIL" >
			<input type="password" name="password" class="form-control" placeholder = "COMPANY PASSWORD" >
		</p>
		<p class="form-group">
			<input type="submit" value="LOG IN" class="btn btn-small btn-primary">
		</p>
	</form>
</div>

<?php include_once "_partials/footer.php" ?>

