<?php

$user_profile = get_user_profile($user->id)[0];

$cv_id = $_GET['cv_id'];
if( !isset($cv_id) || empty($cv_id)) {
	$cv_id = 0;
}else{
	$cv = get_user_cv( $user['id'],$cv_id);
}

?>
<form action="/_inc/user/edit_cv.php" method="POST">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label for="text">TEXT</label><br>
				<textarea name="text" cols="80" rows="10"placeholder="text">
					<?php if(isset($cv) && $cv) echo $cv['text'] ?>
				</textarea>
			</div>
		</div>
		<div class="col-sm-12">
			<input type="hidden" name="cv_id" value="<?php echo $cv_id ?>">
			<input type="submit" value="submit" class="btn btn-danger">
		</div>
	</div>
</form>