<?php

// include
require_once 'config.php';

$qr_id = $_GET['job_qr_id'];
$user_id = $_GET['user_id'];

$user = $database->select('users_details',
				['id','jobs_registered'],
				[ 'id' => $user_id ]);
$user=$user[0];

if($user === null || $user ==='undefined' ){
	$message = json_encode([
		'status' => 'failed',
		'error' => 'user not defined'
	]);
	die($message);
}
if( $database->count('jobs',['id'=>$qr_id]) <1 ){
	$message = json_encode([
		'status' => 'failed',
		'error' => 'job not defined'
	]);
	die($message);
}

$all_jobs = $user['jobs_registered'];
$all_jobs = $all_jobs . ",".$qr_id;

$data = $database->update('users_details',
				[ 'jobs_registered' => $all_jobs ],
				[ 'id' => $user_id ]);

$count = $data->rowCount();

//success
if($count >0){
	$message = json_encode([
		'status' => 'success',
		'count' => $count
	]);
}else {
	$message = json_encode([
		'status' => 'failed',
		'count' => $count
	]);
}
die( $message );
//header("Location:$site_url/index.php");
//die('success');