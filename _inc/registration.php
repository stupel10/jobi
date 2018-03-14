<?php

// include
require_once 'config.php';

$name = $_POST['name'];
$pass = $_POST['pass'];
$reg_type = $_POST['reg_type'];

switch ($reg_type){
	case 'user':
		$database->insert('users_profiles', [
		'name' => $name,
		'password' => $pass
		]);
		break;
	case 'company':
		$database->insert('companies', [
			'name' => $name,
			'password' => $pass
		]);
		break;
	default:
		$message = json_encode([
			'status' => 'fail',
			'error' => 'Wrong registration type'
		]);
		die($message);
}

$id = $database->id();

//success
if($id){
	$message = json_encode([
		'status' => 'success',
		'reg_type' => $reg_type,
		'id' => $id
	]);
	die( $message );
}
//header("Location:$site_url/index.php");
//die('success');