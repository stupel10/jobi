<?php

$jobs = get_company_jobs($user_profile['id']);

?>
<div class="page-header">
	<h1>
		THESE ARE ALL JOBS, YOU OFFER
	</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php
		if( $jobs == false) {
			echo "<br><h3 style='color:red;'>You dont offer any Jobs yet! Go offer it!";
		}else {
		?>
		<ul class="list-group">
			<?php
			foreach ( $jobs AS $job ) {
				?>
			<li class="list-group-item">
				<h4><?=$job["title"]?></h4>
				<div class="tools pull-right">
					<a href="/public/job?id=<?=$job['id']?>" class="btn btn-success">DETAIL</a>
					<?php if($job['users_registered']) {?>
						<a href="/company/job_users_registered?id=<?=$job['id']?>" class="btn btn-success">USERS REGISTERED</a>
					<?php } ?>
					<a href="/_inc/company/create_job_pdf.php?job_id=<?=$job['id']?>" class="btn btn-primary">CREATE PDF</a>
					<a href="/company/edit_job?job_id=<?=$job['id']?>" class="btn btn-warning">EDIT</a>
					<a href="javascript:void(0)" onclick="deleteJob(<?=$job['id']?>)" class="btn btn-danger delete">DELETE</a>
				</div>
			</li>
		<?php }
		} ?>
		</ul>
	</div>
	<div class="col-sm-12">
		<br>
		<a href="/company/edit_job?job_id=0" class="btn btn-warning">OFFER NEW JOB</a>
	</div>
</div>
