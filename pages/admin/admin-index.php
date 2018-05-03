<div class="page-header">
	<h1>JOBI HOME FOR ADMIN</h1>
</div>
<div class="row">
	<div class="col-sm-6 box">
		<div class="tab-menu row">
			<a href="javascript:void(0);" onclick="formToggle('log');" class="tab-menu-link col-sm-6 bg-primary"><h3>LOGIN</h3></a>
		</div>
		<form action="/_inc/admin/login.php" id="log-form" method="post">
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder = "EMAIL" >
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder = "PASSWORD" >
			</div>
			<div class="form-group">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" id="rememberMe" name="rememberMe" class="custom-control-input" checked>
					<label for="rememberMe" class="custom-control-label">Remember me</label>
				</div>
			</div>
			<p class="form-group">
				<input type="submit" value="LOG IN" class="btn btn-small btn-primary">
			</p>
		</form>
	</div>
</div>