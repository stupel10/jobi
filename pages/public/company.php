<?php

	if( !isset($_GET['id']) || empty($_GET['id']) ) {
		flash()->error('No id in url!');
		redirect('/'); // TODO: nefunguje redirect!
	}else{
		$user_id = $_GET['id'];
		$company_profile = get_public_user_profile( $user_id,'company' );
		if(!$company_profile) {
			flash()->error( 'User not found!' );
			redirect( '/' ); // TODO: nefunguje redirect!
		}
	}
?>
<div class="page-header">
	<h1>User profile:</h1>
</div>
<div class="row">
	<div class="col-sm-6">
		<h3>YOUR profile:</h3>
		NAME: <?php echo $company_profile['name'] ?>
		<br>
		EMAIL: <?php echo $company_profile['email'] ?>
		<br>
		PHONE: <?php echo $company_profile['phone'] ?>
		<br>
		ADDRESS:
		<br>
		<?php echo $company_profile['address_street'].' '.$company_profile['address_street_number'] ?><br>
		<?php echo $company_profile['address_PSC'].' '.$company_profile['address_city'] ?><br>
		<?php echo $company_profile['address_country'] ?>
	</div>
	<div class="col-sm-6">
		<?php if ($company_profile['qr_link'] !== null){ ?>
			<a href="<?=$company_profile['qr_link']?>">
				<img src="<?=$company_profile['qr_link']?>" alt="user qr" style="width:200px;">
			</a>
		<?php }?>
	</div>
</div>
