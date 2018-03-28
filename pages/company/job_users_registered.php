<?php

if( !isset($_GET['id']) || empty($_GET['id']) ){
	flash()->error('Job id not found!');
	redirect('/company/offered_jobs');
}
$job = get_company_job($user->id,$_GET['id']);
if(!$job){
	flash()->error('Job not found!');
	redirect('/company/offered_jobs');
}
$job_registrants_cv_ids = explode(',',$job['users_registered']);
$job_registrants_cv_ids = array_unique($job_registrants_cv_ids);
?>
<div class="page-header">
	<h1>
		THESE ARE USERS THAT REGISTER FOR JOB ID <?=$job['id']?>
	</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<ul class="list-group">
		<?php
		if( !count($job_registrants_cv_ids) ) {
			echo "<br><h3 style='color:red;'>There are no registrants for this job";
		}else {
			global $database;
			global $auth_config;
			$all_registrants_cvs = $database->get('resumes','user_id',['id'=>$job_registrants_cv_ids]);
			$all_registrants = $database->select($auth_config->table_user_profiles,'*',['id'=>$all_registrants_cvs]);
			if(count($all_registrants) != count($job_registrants_cv_ids)){
				echo 'Not all registrants found in DB. Please contact support center.';
			}
			for ( $i = 0; $i < count($all_registrants); $i++ )
			{
				$registrant = get_public_user_profile($all_registrants[$i]['id'],'user');
				?>
				<li class="list-group-item">
					<h4><?=$registrant["name"]?> <?=$registrant["surname"]?></h4>
					<div class="tools pull-right">
						<a href="/public/user?id=<?=$registrant['id']?>" class="btn btn-success">DETAIL</a>
						<a href="mailto:<?=$registrant['email']?>" class="btn btn-success">CONTACT</a>
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
