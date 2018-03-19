<?php

require_once "../config.php";

	if( !isset($_GET['job_id']) || empty($_GET['job_id']) ){
		flash()->error('parameter job_id not set');
		redirect('/user/homepage');
	}
	$job_id = $_GET['job_id'];

	global $database;
	global $auth_config;

	$job_id = $database->get('jobs',"id",['id'=> $job_id]);

	if( $job_id ){
		$user         = get_user();
		$user_profile = get_user_profile( $user->id )[0];

		$new_all_jobs = $user_profile['jobs_registered'].','.$job_id;

		$upd = $database->update($auth_config->table_user_profiles,[
			"jobs_registered" => $new_all_jobs
		], [
			"id" => $user_profile['id']
		]);
		if( $upd->rowCount() ){
			flash()->success('Job added to your scanned jobs.');
		}else {
			flash()->error( "Job not added to your profile, because your profile was not found." );
		}

	}else {
		flash()->error('Job with this id does not exists.');
	}

redirect('/user/homepage');