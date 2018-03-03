<?php

// include
require_once 'config.php';

$qr_id = $_GET['job_qr_id'];
$user_id = $_GET['user_id'];

$user = $database->select('users',
				['id','jobs_registered'],
				[ 'id' => $user_id ]);
$user=$user[0];

$all_jobs = $user['jobs_registered'];
$all_jobs = $all_jobs . ",".$qr_id;

$data = $database->update('users',
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