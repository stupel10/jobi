<?php

// include
require_once '../config.php';

$company_id = $_GET['company_id'];
$title = $_GET['title'];
$text = $_GET['text'];

$insertion = $database->insert('jobs',
								['company_id'=> $_GET['company_id'],
									'title'=> $_GET['title'],
								'text'=> $_GET['text']] );

//success
if( $insertion->rowCount() >0){
	$message = json_encode([
		'status' => 'success',
		'insertion' => $insertion
	]);
}else {
	$message = json_encode([
		'status' => 'failed',
		'insertion' => $insertion
	]);
}
die( $message );
//header("Location:$site_url/index.php");
//die('success');