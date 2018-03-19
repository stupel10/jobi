<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	require_once '../config.php';

	$user         = get_user();
	$user_profile = get_user_profile( $user->id )[0];

	$cv_id = $_POST['cv_id'];
	$text = $_POST['text'];
	$title = $_POST['title'];

	global $database;
	global $auth_config;

	if( $cv_id == 0){
		$upd = $database->insert('resumes',[
						'title' => $title,
						'text' => $text,
						'user_id' => $user_profile['id']
			]);
	}else{
		$upd = $database->update( 'resumes', [
						'title' => $title,
						'text' => $text
					],[
						'id' => $cv_id
			]);
	}
	if( $upd->rowCount() > 0  ){
		flash()->success('CV created');
	}else{
		flash()->error('cv not created');
	}
}else{
	flash()->error('no POST request');
}
redirect('/user/cvs');
