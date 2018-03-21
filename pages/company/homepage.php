<div class="page-header">
	<h1>HOMEPAGE FOR COMPANY</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<h3>YOUR profile:</h3>
		NAME: <?php echo $user_profile['name'] ?>
		<br>
		EMAIL: <?php echo $user_profile['email'] ?>
		<br>
		PHONE: <?php echo $user_profile['phone'] ?>
		<br>
		ADDRESS:
		<br>
		<?php echo $user_profile['address_street'].' '.$user_profile['address_street_number'] ?><br>
		<?php echo $user_profile['address_PSC'].' '.$user_profile['address_city'] ?><br>
		<?php echo $user_profile['address_country'] ?>
	</div>
	<div class="col-sm-12">
		<a href="/company/edit_profile" class="btn btn-success">EDIT MY PROFILE</a>
	</div>
</div>