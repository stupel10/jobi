<?php
// TODO : redirect nejde!
if( !isset($_GET['id']) || empty($_GET['id']) ){
	flash()->error('Job id not found!');
	redirect('/company/offered_jobs');
}
$job = get_company_job($user->id,$_GET['id']);
if(!$job){
	flash()->error('Job not found!');
	redirect('/company/offered_jobs');
}
if(empty($job['users_registered'])){
	flash()->error('You have no registrants for this job!');
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
			// TODO: nelubi sa mi tento sposob ziskavania dat, resp. do tabulky 'jobs' - pole 'users registered' by sa malo zapisovat mozno aj user id, nielen cv id, napr. [12,12],[11,11] alebo podobne....
			// chcel som to spravit, ale je tu vela funkcii ktore beru getUser, a teda pri hladani 'user' pouziju 'company' a je to v pecku

			global $database;
			global $auth_config;

			for ( $i = count($job_registrants_cv_ids); $i > 0; $i-- ) {
				$cv         = get_cv( $job_registrants_cv_ids[ $i-1 ] );
				$registrant = $database->get( 'resumes', 'user_id', [ 'id' => $cv['id'] ] );
				$registrant = get_public_user_profile($registrant,'user');
				if ( $cv && $registrant ) { ?>
					<li class="list-group-item">
						<h4><?= $registrant["name"] ?> <?= $registrant["surname"] ?></h4>
						<div class="tools pull-right">
							<a href="/public/user?id=<?= $registrant['id'] ?>&cv_id=<?= $cv['id'] ?>"
							   class="btn btn-success">DETAIL</a>
							<a href="mailto:<?= $registrant['email'] ?>" class="btn btn-success">CONTACT</a>
						</div>
					</li>
				<?php } else { ?>
					<li class="list-group-item">
						<h4 class="text-danger">User or CV not found...</h4>
					</li>
				<?php }
			}
		 } ?>
		</ul>
	</div>
	<div class="col-sm-12">
		<br>
		<a href="/company/edit_job?job_id=0" class="btn btn-warning">OFFER NEW JOB</a>
	</div>
</div>
