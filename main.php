<div class="page-header">
	<h1>JOBI HOME</h1>
</div>
<div class="row">
	<form action="/_inc/user/registration.php" class="col-sm-6" method="post">
		<h2>USER REGISTER</h2>
		<p class="form-group">
			<input type="email" name="email" class="form-control" placeholder = "EMAIL" >
			<input type="password" name="password" class="form-control" placeholder = "PASSWORD" >
		</p>
		<p class="form-group">
			<input type="submit" value="REGISTER" class="btn btn-small btn-danger">
		</p>
	</form>
</div>
<div class="row">
	<form action="/_inc/user/login.php" class="col-sm-6" method="post">
		<h2>USER LOGIN</h2>
		<p class="form-group">
			<input type="email" name="email" class="form-control" placeholder = "EMAIL" >
			<input type="password" name="password" class="form-control" placeholder = "PASSWORD" >
			<label for="remember-me" class="checkbox">
				<input type="checkbox" value="remember-me" name="rememberMe" checked>
				Remember me
			</label>
		</p>
		<p class="form-group">
			<input type="submit" value="LOG IN" class="btn btn-small btn-primary">
		</p>
	</form>
</div>