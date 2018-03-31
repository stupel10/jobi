<div class="page-header">
	<h1>This is home page for user.</h1>
</div>
<div class="row">
	<div class="col-sm-6">
		<h3>YOUR profile:</h3>
		<div class="form-group">
			PROFILE PHOTO
			<a href="javascript:void(0);" onclick="select_profile_photo()">
				<img src="<? echo $user_profile['photo_link'] ? $user_profile['photo_link'] : '/assets/images/profile_photos/user.png' ?>" alt="Profile photo" style="height:200px;width:auto;">
				Click to change.
			</a>
			<form name="change_profile_photo_form" id="change_profile_photo_form" action="/_inc/user/change_profile_photo.php" method="POST" enctype="multipart/form-data">
				<input type="file" id="change_profile_photo_input" name="profile_photo" accept=".png, .jpg, .jpeg" onchange="change_profile_photo(this);" style="display:none;">
				<!--<input type="submit" id="change_profile_photo_submit" style="display:none;">-->
			</form>
		</div>
		<!--<img src="--><?// echo $user_profile['photo_link'] ? $user_profile['photo_link'] : '/assets/images/profile_photos/user.jpg' ?><!--" alt="Profile photo">-->
		<br>
		NAME: <?php echo $user_profile['name'] ?>
		<br>
		SURNAME: <?php echo $user_profile['surname'] ?>
		<br>
		EMAIL: <?php echo $user_profile['email'] ?>
		<br>
		BIRTH DATE: <?php echo $user_profile['birthdate'] ?>
		<br>
		SEX: <?php echo $user_profile['sex'] ?>
		<br>
		TITLE: <?php echo $user_profile['title'] ?>
		<br>
		PHONE: <?php echo $user_profile['phone'] ?>
		<br>
		ADDRESS:
		<br>
		<?php echo $user_profile['address_street'].' '.$user_profile['address_street_number'] ?><br>
		<?php echo $user_profile['address_PSC'].' '.$user_profile['address_city'] ?><br>
		<?php echo $user_profile['address_country'] ?>
	</div>
	<div class="col-sm-6">
		<?php if ($user_profile['qr_link'] !== null){ ?>
			<!--LINK TO QR: --><?//=$user_profile['qr_link']?>
			<a href="<?=$user_profile['qr_link']?>">
				<img src="<?=$user_profile['qr_link']?>" alt="user qr" style="width:200px;">
			</a>
		<?php }?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<a href="/user/edit_profile" class="btn btn-success">EDIT MY PROFILE</a>
	</div>
</div>
