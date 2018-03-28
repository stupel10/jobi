<?php

// include
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$id = $_POST['job_id'];
	$title = $_POST['title'];
	$text = $_POST['text'];
	$category = $_POST['category'];
	$area = $_POST['area'];
	isset($_POST['send_email']) ?  $send_email = true : $send_email=false;


	$user         = get_user();
	$user_profile = get_user_profile( $user->id )[0];

	global $database;
	global $auth_config;

	if( $id == 0){
		$upd = $database->insert('jobs',[
			'title' => $title,
			'category' => $category,
			'area' => $area,
			'text' => $text,
			'send_email' => $send_email,
			'company_id' => $user_profile['id']
		]);
		$id = $database->id();

		// create QR
		$qr_link = createQR('job',$id);
		if( $qr_link == false ){
			flash()->error('JOB created, but QR creation failed!');
			redirect('/company/offered_jobs');
		}
		$upd2 = $database->update('jobs',
						[ 'qr_link'=> $qr_link],
						['id' => $id]);
		if( $upd2->rowCount() == 0  ){
			flash()->error('QR generated on link: '.$qr_link.', but not inserted to DB.');
		}
	}else{
		$upd = $database->update( 'jobs', [
			'title' => $title,
			'text' => $text,
			'category' => $category,
			'area' => $area,
			'send_email' => $send_email,
		],[
			'id' => $id,
			'company_id' => $user_profile['id']
		]);
	}
	if( $upd->rowCount() > 0  ){
		flash()->success('Job saved.');
	}else{
		flash()->error('Job not created/edited.');
	}
}else{
	flash()->error('no POST request');
}
redirect('/company/offered_jobs');