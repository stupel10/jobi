<div class="page-header">
	<h1><?=lang('your_profile')?></h1><?=$lng['your_profile']?>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group profile-photo-change">
			<a href="javascript:void(0);" onclick="select_profile_photo()">
				<img src="<? echo $user_profile['photo_link'] ? $user_profile['photo_link'] : '/assets/images/profile_photos/user.png' ?>" alt="Profile photo" style="height:200px;width:auto;">
				<div class="overlay">
					<span class="change-me">Click to change.</span>
				</div>
			</a>
			<form name="change_profile_photo_form" id="change_profile_photo_form" action="/_inc/user/change_profile_photo.php" method="POST" enctype="multipart/form-data">
				<input type="file" id="change_profile_photo_input" name="profile_photo" accept=".png, .jpg, .jpeg" onchange="change_profile_photo(this);" style="display:none;">
				<!--<input type="submit" id="change_profile_photo_submit" style="display:none;">-->
			</form>
		</div>
		<!--<img src="--><?// echo $user_profile['photo_link'] ? $user_profile['photo_link'] : '/assets/images/profile_photos/user.jpg' ?><!--" alt="Profile photo">-->
		<h3><?php echo $user_profile['title'].' '.$user_profile['name'].' '.$user_profile['surname'] ?></h3>
		<div><?php echo $user_profile['birthdate'] ?></div>
		<div><?php echo $user_profile['sex'] ?></div>
		<div><?php echo $user_profile['phone'] ?></div>
		<div><?php echo $user_profile['email'] ?></div>
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
		<a href="/user/edit_profile" class="btn btn-success"><?=lang('edit')?></a>
	</div>
</div>
