<div class="page-header">
	<h1><?=$lng['jobi_home_for_user']?></h1>
</div>
<div class="row">
	<div class="col-sm-6 box">
		<div class="tab-menu row">
			<a href="javascript:void(0);" onclick="formToggle('log');" class="tab-menu-link col-sm-6 bg-primary"><h3><?=lang('login')?></h3></a>
			<a href="javascript:void(0);" onclick="formToggle('reg');" class="tab-menu-link col-sm-6 bg-danger"><h3><?=lang('registration')?></h3></a>
		</div>
		<form action="/_inc/user/registration.php" id="reg-form" method="post" style="display:none;">
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder = "<?=lang('email')?>" >
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder = "<?=lang('password')?>" >
			</div>
			<div class="form-group">
				<input type="password" name="password_repeate" class="form-control" placeholder = "<?=lang('password_repeate')?>" >
			</div>
			<div class="form-group">
				<input type="submit" value="<?=lang('register')?>" class="btn btn-small btn-danger">
			</div>
		</form>
		<form action="/_inc/user/login.php" id="log-form" method="post">
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder = "<?=lang('email')?>" >
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder = "<?=lang('password')?>" >
			</div>
			<div class="form-group">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" id="rememberMe" name="rememberMe" class="custom-control-input" checked>
					<label for="rememberMe" class="custom-control-label"><?=lang('remember_me')?></label>
				</div>
			</div>
			<p class="form-group">
				<input type="submit" value="<?=lang('login')?>" class="btn btn-small btn-primary">
			</p>
		</form>
	</div>
</div>