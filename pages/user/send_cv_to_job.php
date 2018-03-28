<?php
	if( !isset($_GET['id']) || empty($_GET['id']) ){
		flash()->error('wrong parameter id');
		redirect('/user/scanned_jobs');
	}
	$job_id = $_GET['id'];
	$job = get_job($job_id);
	if(!$job){
		flash()->error('Job not found');
		redirect('/user/scanned_jobs');
	}
	$resumes = get_user_CVs($user->id);
?>
<div class="page-header">
	<h1>
		Select your CV to send.
	</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php
		if( $resumes == false) {
			echo "<br><h3 style='color:red;'>You dont have any CV yet! Go make it!";
		}else {
			?>
			<ul class="list-group">
				<?php

				foreach ( $resumes AS $cv ) {
					?>
					<li class="list-group-item">
						<h4><?=$cv["title"]?></h4>
						<div class="tools pull-right">
							<a href="/_inc/user/send_cv_to_job.php?job_id=<?=$job_id?>&cv_id=<?=$cv["id"]?>" class="btn btn-success">SEND</a>
						</div>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
	<div class="col-sm-12">
		<br>
		<a href="/user/edit_cv" class="btn btn-warning">CREATE NEW CV</a>
	</div>
</div>


