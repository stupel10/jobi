<?php

	require_once '../config.php';

	if( !isset($_GET['job_id']) || empty($_GET['job_id']) ||
	    !isset($_GET['cv_id']) || empty($_GET['cv_id'])
	){
		flash()->error('wrong parameters job_id or cv_id');
		redirect('/user/scanned_jobs');
	}
	$reg = register_user_for_job($_GET['job_id'], $_GET['cv_id']);

	if(!$reg){
		flash()->error('registration not correctly send');
		redirect('/user/scanned_jobs');
	}else{
		flash()->success('registration send!');
		redirect('/user/scanned_jobs');
	}