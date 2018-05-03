<?php
	require_once '../config.php';

$target_dir = "../../assets/images/profile_photos/user/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//die();
$imageFileType = strtolower(pathinfo('./'.basename($_FILES["profile_photo"]["name"],PATHINFO_EXTENSION))['extension']);
$user = get_user();
$user_profile = get_user_profile($user->id)[0];
$photo_link_old = $user_profile['photo_link'];
if( $photo_link_old) {
	$photo_name_old = explode('/',$photo_link_old);
	$photo_name_old = $photo_name_old[count($photo_name_old)-1];
	$photo_name_old = explode('.',$photo_name_old);
	$photo_name_old = $photo_name_old[0];
	$photo_name_old = explode('_',$photo_name_old);
	$new_photo_number = intval($photo_name_old[count($photo_name_old)-1]);
	$new_photo_number++;
}else{
	$new_photo_number = 0;
}

$target_file = $target_dir . 'user_'.$user_profile['id'].'_photo_'.$new_photo_number.'.'.$imageFileType;
$uploadOk = 1;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
	if($check !== false) {
		//echo "File is an image - " . $check["mime"] . ".";
		flash()->error( "File is an image - " . $check["mime"] . ".");
		$uploadOk = 1;
	} else {
		//echo "File is not an image.";
		flash()->error( "File is not an image.");
		$uploadOk = 0;
	}
}
// Check if file already exists
//if (file_exists($target_file)) {
//	echo "Sorry, file already exists.";
//	$uploadOk = 0;
//}
// Check file size lower than 5 000 000B = 5MB
if ($_FILES["profile_photo"]["size"] > 5000000) {
	//echo "Sorry, your file is too large.";
	flash()->error( "Sorry, your file is too large.");
	$uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
	//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	flash()->error( "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	//echo "Sorry, your file was not uploaded.";
	flash()->error( "Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
		//echo "The file ". basename( $_FILES["profile_photo"]["name"]). " has been uploaded.";
		// save link to DB
		$target_file = substr($target_file, 5, strlen($target_file)-5);
		if(set_profile_photo($target_file)){
			flash()->success( "The file ". basename( $_FILES["profile_photo"]["name"]). " has been set as your profile picture.");
		}
	} else {
		//echo "Sorry, there was an error uploading your file.";
		flash()->error( "Sorry, there was an error uploading your file.");
	}
}
redirect('/user/homepage');