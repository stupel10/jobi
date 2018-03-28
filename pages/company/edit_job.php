<?php

if( !isset($_GET['job_id']) || empty($_GET['job_id']) ) {
	$job_id = 0;
}else{
	$job_id = $_GET['job_id'];
	$job = get_company_job( $user->id,$job_id);
}

?>
<form action="/_inc/company/edit_job.php" method="POST">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label for="title">TITLE</label><br>
				<input type="text" name="title" value="<?php if(isset($job) && $job) echo $job['title'] ?>"><br>
				<label for="category">CATEGORY:</label><br>
				<? include_once 'edit_job_categories.php' ?><br>
				<label for="area">AREA:</label><br>
				<? include_once 'edit_job_area.php' ?><br>
				<label for="text">TEXT</label><br>
				<textarea name="text" id="editor1" cols="80" rows="100"><?php if(isset($job) && $job) echo $job['text'] ?></textarea><br>
				<script>
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace( 'editor1', {
						//uiColor: '#333333',
					});
				</script>
				<label for="send_email">
					<input type="checkbox" name="send_email" <? if(isset($job) && $job) {if($job['send_email']) echo 'checked';}?>>
					Send me email when user sends CV.
				</label>
			</div>
		</div>
		<div class="col-sm-12">
			<input type="hidden" name="job_id" value="<?php echo $job_id ?>">
			<input type="submit" value="submit" class="btn btn-danger">
		</div>
	</div>
</form>