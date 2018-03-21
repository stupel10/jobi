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
				<label for="text">TEXT</label><br>
				<textarea name="text" cols="80" rows="10"placeholder="text"><?php if(isset($job) && $job) echo $job['text'] ?></textarea>
			</div>
		</div>
		<div class="col-sm-12">
			<input type="hidden" name="job_id" value="<?php echo $job_id ?>">
			<input type="submit" value="submit" class="btn btn-danger">
		</div>
	</div>
</form>