<?php

	if( !isset($_GET['id']) || empty($_GET['id']) ) {
		flash()->error('No id in url!');
		redirect('/'); // TODO: nefunguje redirect!
	}else{
		$user_id = $_GET['id'];
		$user_profile = get_public_user_profile( $user_id,'user' );
		if(!$user_profile) {
			flash()->error( 'User not found!' );
			redirect( '/' ); // TODO: nefunguje redirect!
		}
	}
	$cv = isset($_GET['cv_id']) ? get_cv($_GET['cv_id']) : false;
?>
<div class="page-header">
	<h1>User profile:</h1>
</div>
<div class="row">
	<div class="col-sm-6">
		<h3>YOUR profile:</h3>
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
<?php if($cv){ ?>
	<hr>
<div class="row">
	<div class="col-sm-12">
		<h1>CV:</h1>
		<h3><?=$cv['title']?></h3>
		<p><?=$cv['text']?></p>
	</div>
</div>
<?php } ?>