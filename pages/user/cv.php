<?php

$user_profile = get_user_profile($user->id)[0];


if( !isset($_GET['cv_id']) || empty($_GET['cv_id']) ) {
	$cv_id = 0;
}else{
	$cv_id = $_GET['cv_id'];
	$cv = get_user_cv( $user->id,$cv_id);
}

?>
<div class="row">
	<div class="col-sm-12">
		<h1><?=lang('basic_data')?></h1>
		<div class="row">
			<div class="col-sm-6">
				<h3><?=lang('your_profile')?>:</h3>
				<?=lang('name')?>: <?php echo $user_profile['name'] ?>
				<br>
				<?=lang('surname')?>: <?php echo $user_profile['surname'] ?>
				<br>
				<?=lang('email')?>: <?php echo $user_profile['email'] ?>
				<br>
				<?=lang('birth_date')?>: <?php echo $user_profile['birthdate'] ?>
				<br>
				<?=lang('sex')?>: <?php echo $user_profile['sex'] ?>
				<br>
				<?=lang('person_title')?>: <?php echo $user_profile['title'] ?>
				<br>
				<?=lang('phone')?>: <?php echo $user_profile['phone'] ?>
				<br>
				<?=lang('address')?>:
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
		<hr>
		<h1><?=lang('cv')?>:</h1>
		<h3><?=$cv['title']?></h3>
		<p><?=$cv['text']?></p>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<a href="/user/cvs" class="btn btn-danger"><?=lang('back')?></a>
	</div>
</div>