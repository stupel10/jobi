<?php

require_once '../config.php';
$next_page = 'user/all_jobs';

	if( ! isset($_GET['job_id']) || empty($_GET['job_id']) ){
			flash()->error('Missing or invalid job id in url.');
			redirect($next_page);
		}
	$job_id     = $_GET['job_id'];

	$user         = get_user();
	$user_profile = get_user_profile( $user->id )[0];

	$job =get_job($job_id);
	if($job['company_id'] != $user_profile['id']){
		flash()->error('Deleting foreign job forbidden!');
		redirect('/');
	}

	global $database;
	global $auth_config;

	$all_jobs = $database->get($auth_config->table_user_profiles,"jobs_registered",['id'=> $user_profile['id']]);

	if(!$all_jobs){
		flash()->error('You did not have this job in your registered job.');
		redirect($next_page);
	}

	$all_jobs = array_diff(explode(',',$user_profile['jobs_registered']), [$job_id] );
	$in='';
	foreach ( $all_jobs as $one )
	{
		$in = $in.$one.',';
	}
	$in = rtrim($in,",");

	$upd = $database->update($auth_config->table_user_profiles,
					["jobs_registered" => $in],
		['id'=> $user_profile['id']]);


	if( $upd->rowCount() >0 ){
		flash()->success('JOB deleted!');
		make_log("job deleted.job id: ".$job_id);
	}else {
		flash()->error('JOB not deleted!');
	}

redirect($next_page);
