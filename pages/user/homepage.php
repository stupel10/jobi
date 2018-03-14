<div class="page-header">
	<h1>This is home page for user.</h1>
</div>
<div class="row">
	<div class="col-sm-12">
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
	<div class="col-sm-12">
		<a href="/user/edit_profile" class="btn btn-success">EDIT MY PROFILE</a>
		<a href="/user/jobs" class="btn btn-success">SCANED JOBS</a>
	</div>
</div>
