<?php

$user_profile = get_user_profile($user->id)[0];


if( !isset($_GET['cv_id']) || empty($_GET['cv_id']) ) {
	$cv_id = 0;
}else{
	$cv_id = $_GET['cv_id'];
	$cv = get_user_cv( $user->id,$cv_id);
}

?>
<form action="/_inc/user/edit_cv.php" method="POST">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label for="title"><?=lang('person_title')?></label><br>
				<input type="text" name="title" value="<?php if(isset($cv) && $cv) echo $cv['title'] ?>"><br>
				<label for="text"><?=lang('text')?></label><br>
				<textarea name="text" id='editor1' cols="80" rows="100"><?php if(isset($cv) && $cv) echo $cv['text'] ?></textarea>
				<script>
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace( 'editor1', {
						//uiColor: '#333333',
					});
				</script>
			</div>
		</div>
		<div class="col-sm-12">
			<input type="hidden" name="cv_id" value="<?php echo $cv_id ?>">
			<input type="submit" value="submit" class="btn btn-danger">
		</div>
	</div>
</form>