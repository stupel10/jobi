<?php

require_once '../config.php';


if( ! isset($_GET['job_id']) || empty($_GET['job_id']) ){
	flash()->error('Missing job id in url.');
	redirect('/company/offered_jobs');
}
$job_id   = $_GET['job_id'];

$user         = get_user();
$user_profile = get_user_profile( $user->id )[0];


global $database;
global $auth_config;

$job_offerer = $database->get('jobs',"company_id",['id'=> $job_id]);

if($job_offerer === $user_profile['id'] ){
	$database->delete('jobs',['id'=> $job_id]);
	flash()->success('Job deleted!');
}else {
	flash()->error('Job not deleted!');
}
redirect('/company/offered_jobs');
